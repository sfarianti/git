<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SyncService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class SyncController extends Controller
{
    public function sync(){
        DB::beginTransaction();
        try{
            $_sync = (new SyncService);
            $_response = $_sync->getSession();
            if(!$_response['success']){
                DB::rollBack();
                $response = $_response['message'];
                return response()->json($response, 500);
            }
            $_token = $_response['token'];
            $_response = $_sync->syncData($_token);
            
            if(!$_response['success']){
                DB::rollBack();
                $response = $_response['message'];
                return response()->json($response, 500);
            }
            
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            $response = $e->getMessage();
            return response()->json($response, 500);
        }

    }
}
