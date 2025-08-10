<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Modalidad_Pago;
use Dist\Models\Plan_Pago;

class Modalidad_PagoController extends Controller
{
    var $path_view          ="modalidad_pago";
    var $path_controller    ="modalidad_pago";
    var $title              ="Modalidad de Pago";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Modalidad_Pago::all();
        //return $datos;
        return view($this->path_view.'.index')
            ->with('path_controller',$this->path_controller)
            ->with('data',$data)
            ->with('title',$this->title);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view($this->path_view.".create")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'nombre' => 'required|max:200',
            'descripcion' => 'nullable|max:1000'
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

            $modalidad_pago=new Modalidad_Pago();
            $modalidad_pago->nombre=$request->nombre;
            $modalidad_pago->descripcion=$request->descripcion;
            $modalidad_pago->id_usuario=$id_usuario;
            $modalidad_pago->save();

            \DB::commit();
            return redirect($this->path_controller);
            
        } 
        catch (\Exception $e) 
        {
            $success = false;
            $error = $e->getMessage();
            \DB::rollback();
            return $error;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mod_pago=Modalidad_Pago::find($id);
        $datos=$mod_pago->plan_pago;
        //return $datos;
        /*$permiso=Permission::wherenotin('id',function($q) use ($id){
            $q->from('permission_role')->select('permission_id')->where('role_id',$id);
        })->get();*/
        $plan_pago=Plan_Pago::wherenotin('id',function($q) use ($id){
            $q->from('modalidad_plan_pago')->select('id_modalidad_pago')->where('id_plan_pago',$id);
        })->get();
        //$datos=Plan_Pago::where('estado','habilitado')->get();
        //return $plan_pago;
        
        return view($this->path_view.".show")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('plan_pago',$plan_pago)
            ->with('modalidad_pago',$mod_pago)
            ->with('id',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $datos=Modalidad_Pago::find($id);

        return view($this->path_view.".edit")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('id',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre' => 'required|max:200',
            'descripcion' => 'nullable|max:1000'   
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

            $modalidad_pago=Modalidad_Pago::find($id);
            $modalidad_pago->nombre=$request->nombre;
            $modalidad_pago->descripcion=$request->descripcion;
            $modalidad_pago->id_usuario=$id_usuario;
            $modalidad_pago->update();           
        
            \DB::commit();
    
            return redirect($this->path_controller);
            
        } 
        catch (\Exception $e) 
        {
            $error = $e->getMessage();
            \DB::rollback();
            return $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        $modalidad_pago =Modalidad_Pago::find($id);
        if($modalidad_pago->estado=='habilitado')
            $modalidad_pago->estado='X';
        else
            $modalidad_pago->estado='habilitado';
        $modalidad_pago->update();
        
        return redirect($this->path_controller);
    }
}
