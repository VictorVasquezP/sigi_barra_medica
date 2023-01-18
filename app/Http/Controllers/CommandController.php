<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Product;
use App\Models\ProductCommand;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;

class CommandController extends VoyagerBaseController
{
    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'commands.create';

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'commands.edit';
        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function saveInsumos(Request $request, $id){
        $array = [];
        DB::beginTransaction();
        try {
            $command = Command::find($id);
            foreach ($request->products as $product) {
                if($command->insumos->contains('product_id','=',$product["id"])){ // si ya esta registrado solo actualizamos
                    $insumo = ProductCommand::where('command_id','=',$id)
                                ->where('product_id','=',$product["id"])
                                ->first();
                    $insumo->quantity = $product["quantity"];
                    $insumo->total = $product["total"];
                    $insumo->update();
                }else{
                    $insumo = new ProductCommand();
                    $insumo->command_id = $id;
                    $insumo->product_id = $product["id"];
                    $insumo->price = $product["price"];
                    $insumo->quantity = $product["quantity"];
                    $insumo->total = $product["total"];
                    $insumo->save();
                    $prod = Product::find($insumo->product_id);
                    $prod->amount -= $insumo->quantity;
                    $prod->update();
                }
            }
            DB::commit();
            $array = ['status' => 200, 'message' => 'Se actualizó la lista de insumos', 'data' => $id]; 
        } catch (Exception $ex) {
            DB::rollBack();
            $array = ['status' => 500, 'message' => 'No se pudo actualizar la lista de insumos',  'data' => $ex->getMessage()];
        }finally{
            return $array;
        }
    }
}
