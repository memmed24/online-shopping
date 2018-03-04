<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function test(){
        $response = ['status' => 200, 'data' => [
            'news' => [
                'id' => 1
            ]
        ]];
        return response($response);
    }

    public function anyway(Request $request){
        $results = DB::table('users')->pluck('name', 'id');
        echo json_encode($results);
        // print_r($request->input());
    }

    //
}
