<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cliente;
use App\Models\Img;
use App\Models\ImgProducto;
use App\Models\Maintenance;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeAdminController extends Controller
{
    public function index($finish=null,$all=null){
       if($finish){
        $admin= Session::get("admin");
        $allMantenimientos=Maintenance::where("id_admin",$admin->id)->where("is_finish",1)->orderBy("created_at","DESC")->paginate(20);
         return view("admin.normaladmin.index",[
             "admin"=>$admin,
             "mantenimientos"=>$allMantenimientos,
             "totalpages"=>$allMantenimientos->lastPage(),
             "currentpage"=>$allMantenimientos->currentPage(),
             "isSearch"=>false
         ]);
       }
       if($all){
        $admin= Session::get("admin");
        $allMantenimientos=Maintenance::where("id_admin",$admin->id)->orderBy("created_at","DESC")->paginate(20);
         return view("admin.normaladmin.index",[
             "admin"=>$admin,
             "mantenimientos"=>$allMantenimientos,
             "totalpages"=>$allMantenimientos->lastPage(),
             "currentpage"=>$allMantenimientos->currentPage(),
             "isSearch"=>false
         ]);
       }

       $admin= Session::get("admin");
       $allMantenimientos=Maintenance::where("id_admin",$admin->id)->where("is_finish",0)->orderBy("created_at","DESC")->paginate(20);
        return view("admin.normaladmin.index",[
            "admin"=>$admin,
            "mantenimientos"=>$allMantenimientos,
            "totalpages"=>$allMantenimientos->lastPage(),
            "currentpage"=>$allMantenimientos->currentPage(),
            "isSearch"=>false
        ]);

    }
    public function equipo(){
        return view("admin.normaladmin.equipo.addequipo.index");
    }
    public function update($id){
        return view("admin.normaladmin.equipo.updateequipo.index",["id"=>$id]);
    }

    public function search(Request $request){
        $input=mb_convert_case($request->input("search"),MB_CASE_LOWER,"UTF-8");
        $option=$request->input("option");
        $id=$request->input("id");
        switch($option){
            case "1":
                // $cliente=Cliente::where("name","like","%".$input."%")->orWhere("last_name","like","%".$input."%")->orWhere("mother_last_name","like","%".$input."%")->get();
                $mantenimientos=Maintenance::whereHas("cliente",function($query) use($input){
                    $query->where("name","like","%".$input."%")->orWhere("last_name","like","%".$input."%")->orWhere("mother_last_name","like","%".$input."%");
                })->where("id_admin",$id)->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();

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

    public function store(Request $request){
        $inputimg=$request->file("fileproducto");
        $folioproducto=$request->input("folioproducto");
        $clunimg=new UpdateImgController();
        $obj=$clunimg->updateImg($inputimg);
        echo $obj["public_id"];
        $admindata=Session::get("admin");
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

            $mentenimineto=Maintenance::create([
                "foliId"=>$folioproducto,
                "id_productMai"=>$idproducto->id,
                "id_cliente"=>$nuevocliente->id,
                "status"=>"En fila",
                "is_finish"=>0,
                "descripcionproblema"=>$descripcionproblema,
                "id_admin"=>$admindata->id,
            ]);


        }












      return redirect()->route("admin");

    }

}
