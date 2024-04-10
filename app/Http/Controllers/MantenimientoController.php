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




}
