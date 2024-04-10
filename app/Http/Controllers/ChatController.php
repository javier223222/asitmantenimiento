<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $id = $request->get('id');

        $chat = Chat::where('foliId', $id)->orderBy("created_at","ASC")->with("cliente")->with("admin")->get();
        return response()->json([
            "result"=>$chat
        ]);
    }
}
