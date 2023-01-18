<?php

namespace App\Http\Controllers;

use App\Models\Command;
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

    public function storeCommand(Request $request)
    {
        $array = [];
        DB::beginTransaction();
        try {
            $command = new Command();
            $command->patient = $request->patient;
            $command->address = $request->address;
            $command->date_admission = date('Y-m-d H:i:s',strtotime($request->date_admission));
            $command->diagnostic = $request->diagnostic;
            $command->doctor = $request->doctor;
            $command->nurse = $request->nurse;
            $command->doctor_shift = $request->doctor_shift;
            $command->type = $request->type;
            $command->status_id = 3;
            $command->save();
            DB::commit();
            $array = ['status' => 200, 'message' => 'Se registró el registro', 'data' => $command]; 
        } catch (Exception $ex) {
            DB::rollBack();
            $array = ['status' => 500, 'message' => 'No se pudo registrar el registro',  'data' => $ex];
        }finally{
            return $array;
        }
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
        $data = 5;
        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','data'));
    }
}
