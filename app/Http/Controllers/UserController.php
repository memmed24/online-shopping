<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
  public function create(Request $req){
    $req = $req->json();
    if($req->has('email') && $req->has('name') && $req->has('surname') && $req->has('password')){
      if(User::where('email', $req->get('email'))->exists()){
        $result = ['status' => 402];
      }else{
        $user = new User();
        $user->name = $req->get('name');
        $user->email = $req->get('email');
        $user->surname = $req->get('surname');
        $user->password = app('hash')->make($req->get('password'));
        $user->api_token = md5(microtime());
        $user->photo_id = null;
        $user->save();
        $result = ['status' => 200, 'data' => $user];
      }
    }else{
      $result = ['status' => 401];
    }
    return response($result);
  }

  public function login(Request $request){
    $request = $request->json();
    if($request->has('email') && $request->has('password')){
      $user = User::where('email', $request->get('email'))->first();
      if($user && Hash::check($request->get('password'), $user->password)){
        $user->api_token = md5(microtime());
        $user->save();
        $user = $user->makeVisible(['api_token']);
        $result = ['status' => 200, 'data' => $user];
      }else{
       $result = ['status' => 403];
      }
    }else{
      $result = ['status' => 401];
    }
    return response($result);
  }

  public function logout(){
    $user = Auth::user();
    $user->api_token = null;
    $user->save();
    $result = ['status' => 200];
    return response($result);
  }

  public function get($id){
    $user = User::find($id);
    $result = ['status' => 200, 'data' => $user];
    return response($result);
  }

  public function update(Request $req){
    $req = $req->json();
    $user = Auth::user();
    if($user){
      if($req->has('email')){
        $user->email = $req->get('email');
      }
      if($req->has('password')){
        $user->password = app('hash')->make($req->get('password'));
      }
      if($req->has('name')){
        $user->name = $req->get('name');
      }
      if($req->has('password')){
        $user->surname = $req->surname('surname');
      }
      $user->save();
      $result = ['status' => 200];      
    }
    return response($result);
  }

  public function orders(){
    $user = Auth::user();
    $orders = DB::table('orders')->where('user_id', $user->id)->get();
    $result = ['status' => 200, 'data' => $orders];
    return response($result);
  }

  public function makeOrder($id){
    $user = Auth::user();

    DB::table('orders')->insert([
      'user_id' => $user->id,
      'stuff_id' => $id
    ]);

    $result = ['status' => 200];
    return response($result);
  }

  public function cancelOrder($id){
    $user = Auth::user();

    DB::table('orders')->where('stuff_id', $id)->where('user_id', $user->id)->delete();
    $result = ['status' => 200];
    return response($result);
  }

}
