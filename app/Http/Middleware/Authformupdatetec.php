<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Authformupdatetec
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $id=$request->route("id");
        $admin=Admin::find($id);
        $name=$request->input("nameup");
        $lastName=$request->input("last_nameup");
        $motherLastName=$request->input("mother_last_nameup");

        $username=$request->input("usernameup");
        $password=$request->input("passwordup");

        if($admin->name==$name && $admin->last_name==$lastName && $admin->mother_last_name==$motherLastName && $admin->username==$username && $admin->password_text==$password){
            Session::flash("erroformup","No se ha modificado ningun campo");
            return redirect()->back();
        }

        return $next($request);
    }
}
