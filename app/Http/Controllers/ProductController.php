<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){
        $array = [];
        try{
            $products = Product::all();
            if(count($products) > 0){
                $array = ['status' => 200, 'message' => 'Se encontraron resultados', 'data'=> $products];
            }else{
                $array = ['status'=>204, 'message' => 'No se encontraron resultados', 'data'=>$products];
            }
        }catch(\Exception $e){
            $array = ['status'=>500, 'message' => 'No se pudo realizar la consulta', 'data'=>$products];
        }finally{
            return $array;
        }
    }
}
