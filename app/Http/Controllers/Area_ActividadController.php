<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Area_Actividad;
use Dist\Models\Actividad;
use Dist\Models\Afiliado;
class Area_ActividadController extends Controller
{
    public function store(Request $request)
    {

        
        //return $afiliado;
        
        $this->validate($request,[
            'actividad' => 'required|numeric',
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

            $area_actividad=new Area_Actividad();
            $area_actividad->id_area=$request->id_area;
            $area_actividad->id_actividad=$request->actividad;
            $area_actividad->id_usuario=$id_usuario;
            $area_actividad->save();


            $actividad=Actividad::find($request->actividad);
            //return var_dump((array)$actividad);
            //return var_dump($request->all());
            $afiliado=Afiliado::select('correo')->where('estado','habilitado')->where('id_area',$request->id_area)->get();
            //return $afiliado;
        
            foreach($afiliado as $item)
            {
                \Mail::send('mail.contact',['actividad'=>$actividad],function($msj) use ($item){
                    $msj->subject("Actividad");
                    //$msj->to('juan.jose.cgt@gmail.com');
                    if($item->correo!=null)
                    $msj->to($item->correo);
                });
            }
            


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

        $area_actividad =area_actividad::where('id_area',$array[1])->where('id_actividad',$array[0])->delete();

        return redirect('especialidad/'.$array[1]);


    }
}
