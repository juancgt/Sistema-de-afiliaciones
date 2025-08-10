<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Area_Aporte;
class Area_AporteController extends Controller
{
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'aporte' => 'required|numeric',
            //'descripcion' => 'nullable|max:1000'
        ],
        ['required'   => 'El campo :attribute es obligatorio. ',
        'different'  => 'El campo ubicacion y traslado deben ser diferente. ',
        'date'       => 'La fecha es invalida. ',
        'numeric'       => 'El campo :attribute debe contener datos numericos. ',
        'unique'       => 'El :attribute ya existe. ',
        'alpha_dash' => ' El campo :attribute solo puede contener caracteres alfanuméricos, así como guiones altos y bajos. ',
        'max' => 'El :attribute no debe ser mayor a :max caracteres. ',
        'alpha'=> 'El :attribute debe contener únicamente caracteres alfabéticos. ',
        'regex' => 'El :attribute contiene caracteres que no corresponden a un :attribute. ',
        'min' => 'El :attribute debe tener al menos :min caracteres. ',
        'digits_between' => 'El :attribute debe tener entre :min y :max dígitos. ',
        'email'=>'El correo electrónico debe ser una dirección de correo electrónico válida. ',
        'confirmed' => 'La confirmación de la :attribute no coincide. ']
        );

        \DB::beginTransaction();
        try {
            
            $id_usuario=\Auth::user()->id;

            $area_aporte=new Area_Aporte();
            $area_aporte->id_area=$request->id_area;
            $area_aporte->id_aporte=$request->aporte;
            $area_aporte->id_usuario=$id_usuario;
            $area_aporte->save();


            /*$actividad=Actividad::find($request->actividad);

            \Mail::send('mail.contact',['actividad'=>$actividad],function($msj){
                $msj->subject("Actividad");
                $msj->to('juan.jose.cgt@gmail.com');
            });*/


            \DB::commit();
            //return redirect($this->path_controller);
            return redirect('especialidad/'.$request->id_area);
            //return redirect('role/'.$request->id_rol);
            
        } 
        catch (\Exception $e) 
        {
            $success = false;
            $error = $e->getMessage();
            \DB::rollback();
            return $error;
        }
    }
    public function destroy($id)
    {
        $array=explode("-",$id);

        $area_aporte =area_aporte::where('id_area',$array[1])->where('id_aporte',$array[0])->delete();

        return redirect('especialidad/'.$array[1]);


    }
}
