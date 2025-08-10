<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Institucion;
class InstitucionController extends Controller
{
    var $path_view          ="institucion";
    var $path_controller    ="institucion";
    var $title              ="Institucion donde Trabajan";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Institucion::all();
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
            'descripcion' => 'nullable|max:1000',
            'direccion' => 'nullable|max:80',
            'telefono' => 'nullable|numeric|digits_between:4,15'
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

            $institucion=new Institucion();
            $institucion->nombre=$request->nombre;
            $institucion->descripcion=$request->descripcion;
            $institucion->direccion=$request->direccion;
            $institucion->telefono=$request->telefono;
            $institucion->id_usuario=$id_usuario;
            $institucion->save();

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
        /*
        $mod_pago=Modalidad_Pago::find($id);
        $datos=$mod_pago->plan_pago;

        $plan_pago=Plan_Pago::wherenotin('id',function($q) use ($id){
            $q->from('modalidad_plan_pago')->select('id_modalidad_pago')->where('id_plan_pago',$id);
        })->get();

        
        return view($this->path_view.".show")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('plan_pago',$plan_pago)
            ->with('modalidad_pago',$mod_pago)
            ->with('id',$id);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $datos=Institucion::find($id);

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
            'descripcion' => 'nullable|max:1000',
            'direccion' => 'nullable|max:80',
            'telefono' => 'nullable|numeric|digits_between:4,15'
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

            $institucion=Institucion::find($id);
            $institucion->nombre=$request->nombre;
            $institucion->descripcion=$request->descripcion;
            $institucion->direccion=$request->direccion;
            $institucion->telefono=$request->telefono;
            $institucion->id_usuario=$id_usuario;
            $institucion->update();           
        
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



        $institucion =Institucion::find($id);
        if($institucion->estado=='habilitado')
            $institucion->estado='X';
        else
            $institucion->estado='habilitado';
        $institucion->update();
        
        return redirect($this->path_controller);
    }
}
