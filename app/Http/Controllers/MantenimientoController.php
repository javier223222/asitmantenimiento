<?php

namespace App\Http\Controllers;

use App\Events\EstatusEvento;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MantenimientoController extends Controller
{
    public function update($id){

        $mantenimiento=Maintenance::where("foliId",$id)->first();

        return view('admin.normaladmin.equipo.updateequipo.index' , ['mantenimiento'=>$mantenimiento]);
    }

    public function updateMaintenance(Request $request)
    {
        $id=$request->input('id');
        $newstatus=$request->input('exampleRadios');
        $newimage=$request->file('newimage');
        $admin=Session::get("admin");
        $superadmin=Session::get("superAdmin");
        $otrostatus=$request->input('otrostatus');
        $urlimg=null;


        if($newimage){
            $clunimg=new UpdateImgController();
            $obj=$clunimg->updateImg($newimage);
            $urlimg=$obj["url"];
            $mantenimiento=Maintenance::where("foliId",$id)->first();
            $mantenimiento->product->imagePrduct[0]->img->update([
                "url_imag"=>$urlimg,
                "url_public"=>$urlimg,
            ]);


        }
        if($newstatus){
            $mantenimiento=Maintenance::where("foliId",$id)->first();
            if($newstatus=="Listo"){
                $mantenimiento->update([
                    "status"=>$newstatus,
                    "is_finish"=>1,

                ]);
            }else if($newstatus=="otro"){
                $mantenimiento->update([
                    "status"=>$otrostatus,
                    "is_finish"=>0,

                ]);

            }else{

                $mantenimiento->update([
                    "status"=>$newstatus,
                    "is_finish"=>0,

                ]);
            }




        }

        if($newstatus=="otro"){
            broadcast(new EstatusEvento($otrostatus,$id,$urlimg))->toOthers();

        }else{
            broadcast(new EstatusEvento($newstatus,$id,$urlimg))->toOthers();
        }


        if($admin){
            return redirect()->route("admin");
        }
        if($superadmin){
            return redirect()->route("allEquiposMantenimiento",[
                "finish"=>0,
                "all"=>1
            ]);
        }






    }

    function searchspecificcliente(Request $request){
        $input=mb_convert_case($request->input("search"),MB_CASE_LOWER,"UTF-8");
        $option=$request->input("option");
        $id=$request->input("id");

        switch($option){

            case "2":
                $mantenimientos=Maintenance::where("foliId","like",$input."%")->where("id_cliente",$id)->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
                return view("admin.normaladmin.search",compact("mantenimientos"));

                break;
            case "3":


                $mantenimientos=Maintenance::whereHas("admin",function($query) use($input){
                    $query->where("completname","like",$input."%");
                })->where("id_cliente",$id)->with("cliente")->with("admin")->with("product.imagePrduct.img")->get();
                return view("admin.normaladmin.search",compact("mantenimientos"));

                break;
        }


    }
    function allmantenimientos($id,$finish=null,$all=null){

        if($finish){
            $mantenimientos=Maintenance::where("id_cliente",$id)->where("is_finish",1)->paginate(20);
            return view('admin.superadmin.allclientes.allclientemantenimientos.index',
            [
                "id"=>$id,
                "mantenimientos"=>$mantenimientos->items(),
               "totalpages"=>$mantenimientos->lastPage(),
                "currentpage"=>$mantenimientos->currentPage(),
                "isSearch"=>false
        ]);
    }
    if($all){
        $mantenimientos=Maintenance::where("id_cliente",$id)->where("is_finish",0)->paginate(20);
        return view('admin.superadmin.allclientes.allclientemantenimientos.index',
        [
            "id"=>$id,
            "mantenimientos"=>$mantenimientos->items(),
           "totalpages"=>$mantenimientos->lastPage(),
            "currentpage"=>$mantenimientos->currentPage(),
            "isSearch"=>false
    ]);
    }

        $mantenimientos=Maintenance::where("id_cliente",$id)->paginate(20);
        return view('admin.superadmin.allclientes.allclientemantenimientos.index',
        [
            "id"=>$id,
            "mantenimientos"=>$mantenimientos->items(),
           "totalpages"=>$mantenimientos->lastPage(),
            "currentpage"=>$mantenimientos->currentPage(),
            "isSearch"=>false
    ]);
    }







}
