<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index (){
        return view('admin.login');
    }

    public function logoutAdmin(){
        if(Session::has("superAdmin")){
            Session::forget("superAdmin");
            return redirect()->route("loginA");
        }
        Session::forget("admin");
        return redirect()->route("loginA");

    }

    public function loginAdmin(Request $request){
        $usernameinput=$request->input('username');
        $passwordinput=$request->input('password');
        $ss=Admin::where('username',$usernameinput)->first();
        if(!$ss){
            Session::flash("error","Userio o contrasenia incorrecta");
            return redirect()->back();
        }
        if(Hash::check($passwordinput,$ss->password)){
             if($ss->id_role==1||$ss->id_role==2){
                 Session::put("superAdmin",$ss);
                 return redirect()->route("superadmin");
             }
            Session::put("admin",$ss);
            return redirect()->route("admin");
        }
        Session::flash("error","Userio o contrasenia incorrecta");
        return redirect()->back();




    }
}
