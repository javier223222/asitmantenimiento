<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Cliente;
use App\Models\Img;
use App\Models\ImgProducto;
use App\Models\Maintenance;
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
    public function showallTecnicoManteince($id,$finish=null,$all=null){
        if($finish){
           $mantenimientos=Maintenance::where("id_admin",$id)->where("is_finish",1)->orderBy("created_at","DESC")->paginate(20);
           return view("admin.superadmin.tecnicoEquipos.index",[
            "admin"=>$id,
            "mantenimientos"=>$mantenimientos,
            "totalpages"=>$mantenimientos->lastPage(),
            "currentpage"=>$mantenimientos->currentPage(),
            "isSearch"=>false
        ]);



        }

        if($all){
            $mantenimientos=Maintenance::where("id_admin",$id)->orderBy("created_at","DESC")->paginate(20);
        return view("admin.superadmin.tecnicoEquipos.index",[
            "admin"=>$id,
            "mantenimientos"=>$mantenimientos,
            "totalpages"=>$mantenimientos->lastPage(),
            "currentpage"=>$mantenimientos->currentPage(),
            "isSearch"=>false
        ]);
        }

        $mantenimientos=Maintenance::where("id_admin",$id)->where("is_finish",0)->orderBy("created_at","DESC")->paginate(20);
        return view("admin.superadmin.tecnicoEquipos.index",[
            "admin"=>$id,
            "mantenimientos"=>$mantenimientos,
            "totalpages"=>$mantenimientos->lastPage(),
            "currentpage"=>$mantenimientos->currentPage(),
            "isSearch"=>false
        ]);





    }



    public function serachForSpecificTecnico(Request $request){
        $input=mb_convert_case($request->input("search"),MB_CASE_LOWER,"UTF-8");
        $option=$request->input("option");
        $id=$request->input("id");

        switch($option){
            case "1":
                // $cliente=Cliente::where("name","like","%".$input."%")->orWhere("last_name","like","%".$input."%")->orWhere("mother_last_name","like","%".$input."%")->get();
                $mantenimientos=Maintenance::whereHas("cliente",function($query) use($input){
                    $query->where("name","like","%".$input."%");
                })->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();

                return response()->json([
                    "result"=>$mantenimientos
                ]);
                break;
            case "2":
                $mantenimientos=Maintenance::where("foliId","like","%".$input."%")->where("id_admin",$id)->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
                return response()->json([
                    "result"=>$mantenimientos
                ]);

                break;
            case "3":


                $mantenimientos=Maintenance::whereHas("admin",function($query) use($input){
                    $query->where("name","like","%".$input."%")->orWhere("last_name","like","%".$input."%")->orWhere("mother_last_name","like","%".$input."%");
                })->where("id_admin",$id)->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
                return response()->json([
                    "result"=>$mantenimientos
                ]);

                break;
        }

    }

    public function allEquiposMantenimiento($finish=null,$all=null){

        if($finish){
            $mantenimientos=Maintenance::where("is_finish",1)->orderBy("created_at","DESC")->paginate(20);
            return view("admin.superadmin.allequipos.index",[
             "admin"=>"superadmin",
             "mantenimientos"=>$mantenimientos,
             "totalpages"=>$mantenimientos->lastPage(),
             "currentpage"=>$mantenimientos->currentPage(),
             "isSearch"=>false
         ]);



         }

         if($all){
             $mantenimientos=Maintenance::orderBy("created_at","DESC")->paginate(20);
         return view("admin.superadmin.allequipos.index",[
             "admin"=>"superadmin",
             "mantenimientos"=>$mantenimientos,
             "totalpages"=>$mantenimientos->lastPage(),
             "currentpage"=>$mantenimientos->currentPage(),
             "isSearch"=>false
         ]);
         }

         $mantenimientos=Maintenance::where("is_finish",0)->orderBy("created_at","DESC")->paginate(20);
         return view("admin.superadmin.allequipos.index",[
             "admin"=>"admin",
             "mantenimientos"=>$mantenimientos,
             "totalpages"=>$mantenimientos->lastPage(),
             "currentpage"=>$mantenimientos->currentPage(),
             "isSearch"=>false
         ]);
    }


    public function search(Request $request){
        $input=mb_convert_case($request->input("search"),MB_CASE_LOWER,"UTF-8");
        $option=$request->input("option");
        switch($option){
            case "1":
            $mantenimientos = Maintenance::whereHas("admin", function($query) use($input) {
                $query->where("name", "like", $input . "%");

            })->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
            return response()->json([
                "result" => $mantenimientos
            ]);


                break;
            case "2":
                $mantenimientos=Maintenance::where("foliId","like","%".$input."%")->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
                return response()->json([
                    "result"=>$mantenimientos
                ]);

                break;
            case "3":


                $mantenimientos=Maintenance::whereHas("admin",function($query) use($input){
                    $query->where("name","like","%".$input."%")->orWhere("last_name","like","%".$input."%")->orWhere("mother_last_name","like","%".$input."%");
                })->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
                return response()->json([
                    "result"=>$mantenimientos
                ]);

                break;
        }



    }


    public function mantenimentoview(){
        $tecnicos=Admin::where("id_role",3)->get();
        return view("admin.superadmin.addequipo.index",[
            "tecnicos"=>$tecnicos
        ]);
    }

    public function store(Request $request){
        $inputimg=$request->file("fileproducto");
        $folioproducto=$request->input("folioproducto");
        $tecnicocargo=$request->input("tecnico");
        $clunimg=new UpdateImgController();
        $obj=$clunimg->updateImg($inputimg);
        echo $obj["public_id"];
        $admindata=Session::get("superAdmin");
        $nameequipo=$request->input("nombreproducto");
        $descripcionequi=$request->input("descripcionequi");
        $descripcionproblema=$request->input("descripcionproblema");
        $marcaequipo=$request->input("marcaequipo");
        $categoria=$request->input("categoria");
        $nombrecliente=$request->input("nombrecliente");
        $apellidopcli=$request->input("apellidopcli");
        $apellidomcli=$request->input("apellidomcli");
        $emailclien=$request->input("emailclien");
        $telefonoclien=$request->input("telefonoclien");

        $nameclient_lower=mb_convert_case($nombrecliente,MB_CASE_LOWER,"UTF-8");
        $apellidopcli_lower=mb_convert_case($apellidopcli,MB_CASE_LOWER,"UTF-8");
        $apellidomcli_lower=mb_convert_case($apellidomcli,MB_CASE_LOWER,"UTF-8");
        $productocontroller=new EquipoController();

        $name_brandLower=mb_convert_case($marcaequipo,MB_CASE_LOWER,"UTF-8");
        $brandcontroller=new BrandController();

        $brand=Brand::where('name_brand',$name_brandLower)->first();
        $idproducto=null;
        if($brand){

             $idproducto=$productocontroller->AddProducto($nameequipo,$categoria,$brand->id_brand,$descripcionequi);
        }else{
            $newbrand=$brandcontroller->addBrand($name_brandLower);
            $idproducto=$productocontroller->AddProducto($nameequipo,$categoria,$newbrand->id,$descripcionequi);
        }
        $findclient=Cliente::where("name",$nameclient_lower)->where("last_name",$apellidopcli_lower)->where("mother_last_name",$apellidomcli_lower)->first();
        if($findclient){
            if($findclient->email!=$emailclien){
                $findclient->email=$emailclien;
                $findclient->save();
            }
            if($findclient->telefono!=$telefonoclien){
                $findclient->telefono=$telefonoclien;
                $findclient->save();
            }
            $image_id=Img::create([
                "url_imag"=>$obj["public_id"],
                "url_public"=>$obj["url"],
            ]);
            $imageproduct=ImgProducto::create([
                "id_productMai"=>$idproducto->id,
                "id_img"=>$image_id->id,
            ]);

            if($tecnicocargo=="-1"){
                $mentenimineto=Maintenance::create([
                    "foliId"=>$folioproducto,
                    "id_productMai"=>$idproducto->id,
                    "id_cliente"=>$findclient->id_cliente,
                    "status"=>"En fila",
                    "is_finish"=>0,
                    "descripcionproblema"=>$descripcionproblema,
                    "id_admin"=>$admindata->id,

                ]);
            }else{
                $mentenimineto=Maintenance::create([
                    "foliId"=>$folioproducto,
                    "id_productMai"=>$idproducto->id,
                    "id_cliente"=>$findclient->id_cliente,
                    "status"=>"En fila",
                    "is_finish"=>0,
                    "descripcionproblema"=>$descripcionproblema,
                    "id_admin"=>$tecnicocargo,

                ]);
            }












        }else{
            $clientecontroller=new ClienteController();
           $nuevocliente= $clientecontroller->addCliente($nameclient_lower,$apellidopcli_lower,$apellidomcli_lower,$emailclien,$telefonoclien);
            $image_id=Img::create([
                "url_imag"=>$obj["public_id"],
                "url_public"=>$obj["url"],
            ]);
            $imageproduct=ImgProducto::create([
                "id_productMai"=>$idproducto->id,
                "id_img"=>$image_id->id,
            ]);

            if($tecnicocargo=="-1"){
                $mentenimineto=Maintenance::create([
                    "foliId"=>$folioproducto,
                    "id_productMai"=>$idproducto->id,
                    "id_cliente"=>$nuevocliente->id,
                    "status"=>"En fila",
                    "is_finish"=>0,
                    "descripcionproblema"=>$descripcionproblema,
                    "id_admin"=>$admindata->id,
                ]);

            }else{

                $mentenimineto=Maintenance::create([
                    "foliId"=>$folioproducto,
                    "id_productMai"=>$idproducto->id,
                    "id_cliente"=>$nuevocliente->id,
                    "status"=>"En fila",
                    "is_finish"=>0,
                    "descripcionproblema"=>$descripcionproblema,
                    "id_admin"=>$tecnicocargo,
                ]);

            }






        }












      return redirect()->route("allEquiposMantenimiento");

    }


}
