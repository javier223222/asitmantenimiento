<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PusherController extends Controller
{
    public function index($id)
    {

        return view('admin.superadmin.chat.index',["id"=>$id]
    );
    }

    public function broadcast(Request $request)
    {
        $message = $request->get('message');
        $id = $request->get('id');
        $admin=Session::get("admin");
        $superAdmin=Session::get("superAdmin");
        $client=Session::get("client");
        $time=date("H:i:s");
        if($admin){

            broadcast(new PusherBroadcast($message,$id,[
                "message"=>$message,
                "id_chat"=>$id,
                "id_cliente"=>null,
                 "id"=>$admin->id,
                 "created_at"=>$time,
                 "admin"=>$admin,
                 "cliente"=>null,
                 "foliId"=>$id,

            ],$time))->toOthers();
            Chat::create([
                "id"=>$admin->id,
                "id_cliente"=>null,
                "foliId"=>$id,
                "message"=>$message,
            ]);
           return redirect()->back();

        }else
        if($superAdmin){
            broadcast(new PusherBroadcast($message,$id,[
                "message"=>$message,
                "id_chat"=>$id,
                "id_cliente"=>null,
                 "id"=>$superAdmin->id,
                 "created_at"=>$time,
                 "admin"=>$superAdmin,
                 "cliente"=>null,
                 "foliId"=>$id,

            ],$time))->toOthers();

            Chat::create([
                "id"=>$superAdmin->id,
                "id_cliente"=>null,
                "foliId"=>$id,
                "message"=>$message
            ]);

            return redirect()->back();

        }else if($client){

                broadcast(new PusherBroadcast($message,$id,[
                    "message"=>$message,
                    "id_chat"=>$id,
                    "id_cliente"=>$client->id_cliente,
                     "id"=>null,
                     "created_at"=>$time,
                     "admin"=>null,
                     "cliente"=>$client,
                     "foliId"=>$id,

                ],$time))->toOthers();



            Chat::create([
                "id"=>null,
                "id_cliente"=>$client->id_cliente,
                "foliId"=>$id,
                "message"=>$message
            ]);

            return redirect()->back();



        }






    }

    public function receive(Request $request)
    {
        return view('admin.superadmin.chat.receive', ['message' => $request->get('message')]);
    }
}
