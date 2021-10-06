<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class TestRedisController extends Controller
{
    public function index()
    {
        // $response = Redis::get('user_details');
        
        // $users = json_decode($response);

        // return view('users.index',compact('users'));
        try
        {
            $users = Cache::remember('users', now()->addMinutes(150), function () {
                $data[] = array();
                $dataDbs = DB::connection('mysql')->table('users')->get(); 

                foreach($dataDbs as $dataDb)
                {
                    $data[] = array(
                        'id' => $dataDb->id,
                        'name' => $dataDb->name,
                        'email' => $dataDb->email
                    );
                }
                return $data;
            });

            if($users)
            {
                return response()->json([
                    'message' => 'Success',
                    'content' => [
                        'users' => $users
                    ],
                    'code' =>  200
                ]);
            }
            else 
            {
                return response()->json([
                    'message' => 'No Data Found',
                    'code' =>  401
                ]);
            }
        }
        catch(\Throwable $th)
        {
            return response()->json([
                'message' => $th,
                'code' =>  501
            ]);
        }
    }

    public function show()
    {
        $response = Redis::get('user_details');
        
        $users = json_decode($response);
        dd($users);
    }

    public function saveUser()
    {
        $name = "testName";
        $phone = "testPhone";
        Redis::set('user_details', json_encode(
            [
                [
                    'name' => 'raju',
                    'phone' => '01716215794'
                ],
                [
                    'name' => 'Habib',
                    'phone' => '01716215794'
                ],
                [
                    'name' => $name,
                    'phone' => $phone
                ]
            ])
        );
        return "Data Save Successfully";
    }
    public function create(){
        return view('users.create');
    }
    
    public function store(Request $request)
    {
        Redis::set('user_details', json_encode(
            [
                [
                    'name' => $request->name,
                    'phone' => $request->phone
                ]
            ])
        );
        return "Data Save Successfully";
    }
}
