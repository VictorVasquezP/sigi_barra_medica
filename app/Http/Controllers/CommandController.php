<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\ProductCommand;
use App\Models\Role;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
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

        $role_id = Auth::user()->role_id;
        $role = Role::find($role_id);
        $display_name=$role->display_name;

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','display_name'));
    }

    public function storeCommand(Request $request)
        {
            $array = [];
            DB::beginTransaction();
            try {
                $command = new Command();
                $command->patient = $request->patient;
                $command->address = $request->address;
                $command->date_admission = date('Y-m-d H:i:s', strtotime($request->date_admission));
                $command->diagnostic = $request->diagnostic;
                $command->doctor = $request->doctor;
                $command->nurse = $request->nurse;
                $command->doctor_shift = $request->doctor_shift;
                $command->type = $request->type;
                $command->status_id = 3;
                $command->room_id = $request->room_id;
                $command->weight = $request->weight;
                $command->year_old = $request->year_old;
                $command->phone = $request->phone;
                $command->allergies = $request->allergies;
                $command->save();
                $room = Room::find($request->room_id);
                $room->status_id = 2;
                $room->update();
                DB::commit();
                $array = ['status' => 200, 'message' => 'Se registró el registro', 'data' => $command];
            } catch (Exception $ex) {
                DB::rollBack();
                $array = ['status' => 500, 'message' => 'No se pudo registrar el registro',  'data' => $ex];
            } finally {
                return $array;
            }
        }

        public function editCommand(Request $request)
        {
            $array = [];
            DB::beginTransaction();
            try {
                $command = Command::find($request->id);
                $command->patient = $request->patient;
                $command->address = $request->address;
                $command->diagnostic = $request->diagnostic;
                $command->date_admission = date('Y-m-d H:i:s', strtotime($request->date_admission));
                $command->doctor = $request->doctor;
                $command->nurse = $request->nurse;
                $command->doctor_shift = $request->doctor_shift;
                $command->type = $request->type;
                $command->weight = $request->weight;
                $command->year_old = $request->year_old;
                $command->phone = $request->phone;
                $command->allergies = $request->allergies;
                $room = Room::find($command->room_id);
                $room->status_id = 1;
                $room->update();
                $command->room_id = $request->room_id;
                $room = Room::find($request->room_id);
                $room->status_id = 2;
                $room->update();
                $command->save();
                DB::commit();
                $command->room_name=$command->room->name;
                $command->date_admission= Carbon::parse($command->date_admission)->format('Y-m-d');
                $array = ['status' => 200, 'message' => 'Se actualizo el registro', 'data' => $command]; 
            } catch (Exception $ex) {
                DB::rollBack();
                $array = ['status' => 500, 'message' => 'No se pudo actualizar el registro',  'data' => $ex->getMessage()];
            }finally{
                return $array;
            }
        }

    public function updateStatusCommand(Request $request)
    {
        $array = [];
        DB::beginTransaction();
        try {
            $command = Command::find($request->id);

            switch($request->type){
                case 1:
                    $status=4;
                    $room = Room::find($request->room_id);
                    $room->status_id=1;
                    $room->save();
                    break;
                case 2:
                    $status=3;
                    break;
                case 3:
                    $status=5;
                    $command->date_agress = date_create()->format('Y-m-d H:i:s');
                    break;
            }
            $command->status_id=$status;
            $command->update();
            DB::commit();
            $array = ['status' => 200, 'message' => 'Se actualizo el estatus del registro', 'data' => $command]; 
        } catch (Exception $ex) {
            DB::rollBack();
            $array = ['status' => 500, 'message' => 'No se pudo actualizar el estatus del registro',  'data' => $ex];
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
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
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

        $role_id = Auth::user()->role_id;
        
        $command= Command::find($id);

        $command->room_name=$command->room->name;

        $command->date_admission= Carbon::parse($command->date_admission)->format('Y-m-d');
        
        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','role_id','command'));
    }

    public function saveInsumos(Request $request, $id)
    {
        $array = [];
        $role_id = Auth::user()->role_id;
        $permission = $role_id <= 2; // si es soporte o admin
        DB::beginTransaction();
        try {
            $command = Command::find($id);
            $insumos = $command->insumos;
            /** Actualizamos los productos */
            /** Bucle para agregar o actualizar los datos del insumo en el registro */
            foreach ($request->products as $product) {
                if ($insumos->contains('id', '=', $product["id"])) { // si contiene el insumo es que no es nuevo
                    $insumo = ProductCommand::find($product["id"]);
                    $insumo->quantity = $product["quantity"];
                    $insumo->name = $product["name"];
                    $insumo->total = $product["total"];
                    if($permission){
                        $insumo->price = $product["price"];
                    }
                    $insumo->update();
                }
            }

            /** Registramos los nuevos productos */
            foreach ($request->newproducts as $product) {
                    $insumo = new ProductCommand();
                    $insumo->command_id = $id;
                    $insumo->price = $product["price"];
                    $insumo->quantity = $product["quantity"];
                    $insumo->total = $product["total"];
                    $insumo->name = $product["name"];
                    $insumo->description = $product["description"];
                    $insumo->save();
            }

            /** Bucle para quitar los insumos que eliminaron */
            foreach ($insumos as $insumo) {
                $bandera = false;
                foreach ($request->products as $product) {
                    if ($product["id"] == $insumo->id) { //Si está
                        $bandera = true;
                        break;
                    }
                }
                if (!$bandera) {
                    $insumo->delete();
                }
            }
            DB::commit();
            $array = ['status' => 200, 'message' => 'Se actualizó la lista de insumos', 'data' => $id];
        } catch (Exception $ex) {
            DB::rollBack();
            $array = ['status' => 500, 'message' => 'No se pudo actualizar la lista de insumos',  'data' => $ex->getMessage()];
        } finally {
            return $array;
        }
    }

    public function insumos($id)
    {
        $array = [];
        try {
            $command = Command::find($id);
            $insumos = $command->insumos;
            if (count($insumos) > 0) {
                $array = ['status' => 200, 'message' => 'Se encontraron resultados', 'data' => $insumos];
                return $array;
            } else {
                $array = ['status' => 204, 'message' => 'No se encontraron resultados', 'data' => $insumos];
            }
        } catch (\Exception $e) {
            $array = ['status' => 500, 'message' => 'No se pudo realizar la consulta', 'data' => $insumos];
        } finally {
            return $array;
        }
    }
}
