<?php
/**
 * Created by PhpStorm.
 * User: Lenova
 * Date: 2/27/2018
 * Time: 10:48
 */

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
  public function getWarehouse(){
    $warehouse = Warehouse::all();
    $result = ['status' => 200, 'data' => $warehouse];
    return response($result);
  }

  public function create(Request $request){
    $request = $request->json();
    $user = Auth::user();
    if($request->has('name') && $request->has('price')){

      $warehouse = new Warehouse();
      $warehouse->name = $request->get('name');
      $warehouse->user_id = $user->id;
      $warehouse->price = $request->get('price');
      $warehouse->photo_id = null;
      $warehouse->save();
      $result = ['status' => 200, 'data' => $warehouse];

    }else{
      $result = ['status' => 401];
    }
    return response($result);
  }

  public function update(Request $request){
    $warehouse = Warehouse::find($request->get('id'));
    if($warehouse){
      if($request->has('name')){
        $warehouse->name = $request->get('name');
      }
      if($request->has('price')){
        $warehouse->price = $request->get('price');
      }
      $warehouse->save();
      $result = ['status' => 200, 'data' => $warehouse];
    }else{
      $result = ['status' => 408];
    }
    return response($result);
  }

  public function get($id){
    $warehouse = Warehouse::find($id);
    $result = ['status' => 200, 'data' => $warehouse];
    return response($result);
  }

  public function delete($id){
    $warehouse = Warehouse::find($id);
    if($warehouse){
      $warehouse->delete();
      $response = ['status' => 200];
    }else{
      $response = ['status' => 405];
    }
    return response($response);
  }

}