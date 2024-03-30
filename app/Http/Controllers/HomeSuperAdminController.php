<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeSuperAdminController extends Controller
{
    public function index(){

        $admins=Admin::where("id_role",3)->orderBy("created_at")->paginate(20);


        return view("admin.superadmin.index",
        [
            "admins"=>$admins->items(),
            "totalpages"=>$admins->lastPage(),
            "currentpage"=>$admins->currentPage(),
            "isSearch"=>false
        ]);
    }
    public function addTecnico(){

        return view("admin.superadmin.addtecnico.index");
    }

    public function storeTecnico(Request $request){
        $name=$request->input("name");
        $lastName=$request->input("last_name");
        $motherLastName=$request->input("mother_last_name");

        $username=$request->input("username");
        $password=$request->input("password");

        try{
         $admin=Admin::create([
            "name"=>$name,
            "last_name"=>$lastName,
            "mother_last_name"=>$motherLastName,
            "username"=>$username,
            "password"=>bcrypt($password),
            "password_text"=>$password,
            "id_role"=>3
         ]);
         return redirect()->route("superadmin");
        }catch(\Exception $e){

            Session::flash("erroform","Error al guardar el tecnico");
            return redirect()->back();
        }
        return redirect()->route("superadmin");
    }

    public function deleteTecnico($id){
        $admin=Admin::find($id);
        $admin->delete();
        return redirect()->route("superadmin",[
            "admins"=>Admin::where("id_role",3)->orderBy("created_at")->get()
        ]);
    }

    public function updateTecnico($id){
        $admin=Admin::find($id);
        return view("admin.superadmin.updatetecnico.index",[
            "admin"=>$admin
        ]);
    }

    public function actualizarTecnico(Request $request,$id){
        $name=$request->input("nameup");
        $lastName=$request->input("last_nameup");
        $motherLastName=$request->input("mother_last_nameup");

        $username=$request->input("usernameup");
        $password=$request->input("passwordup");

        $admin=Admin::find($id);
        $admin->name=$name;
        $admin->last_name=$lastName;
        $admin->mother_last_name=$motherLastName;
        $admin->username=$username;
        $admin->password=bcrypt($password);
        $admin->password_text=$password;
        $admin->updated_at=date("Y-m-d H:i:s");
        $admin->save();
        return redirect()->route("superadmin",[
            "admins"=>Admin::where("id_role",3)->orderBy("created_at")->get()
        ]);
    }
    public function searchTecnico(Request $request){
        $search=$request->input("search");
        $admins=Admin::where("id_role",3)->where("name","like","%$search%")->orderBy("created_at")->paginate(20);
         return view("admin.superadmin.index",[
            "admins"=>$admins,
            "totalpages"=>1,
            "currentpage"=>1,
            "isSearch"=>true
         ]);
    }
}
