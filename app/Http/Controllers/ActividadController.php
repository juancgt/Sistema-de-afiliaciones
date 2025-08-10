<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Actividad;
class ActividadController extends Controller
{
    var $path_view          ="actividad";
    var $path_controller    ="actividad";
    var $title              ="Actividad";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Actividad::all();
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
            'actividad' => 'required|max:200',
            'inicio_actividad' => 'required|max:1000',
            'fin_actividad' => 'required|max:1000',
            'descripcion' => 'required'
            //'archivo' => 'nullable|file'
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

            $archivo = $request->archivo;
            
            if($archivo!=null)
            {
                $name=time()."_".$archivo->getClientOriginalName();
                $archivo->move(public_path().'/archivos/',$name);
                //$archivo=base64_encode(file_get_contents($archivo));
            }
            //$request->file('archivo')->store('public');

            $id_usuario=\Auth::user()->id;

            $actividad=new Actividad();
            $actividad->actividad=$request->actividad;
            $actividad->inicio=$request->inicio_actividad;
            $actividad->fin=$request->fin_actividad;
            $actividad->archivo='/archivos/'.$name;
            $actividad->descripcion=$request->descripcion;
            $actividad->id_usuario=$id_usuario;
            $actividad->save();

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
        
        $datos=Actividad::find($id);


        
        return view($this->path_view.".show")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('id',$id);
    }

    public function actividad($id)
    {
        
        $datos=Actividad::find($id);


        
        return view($this->path_view.".actividad")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
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
        $datos=Actividad::find($id);

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
        //return "asd";
        $this->validate($request,[
            'actividad' => 'required|max:200',
            'inicio_actividad' => 'required|max:1000',
            'fin_actividad' => 'required|max:1000',
            'descripcion' => 'required'
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

            $actividad=Actividad::find($id);
            $actividad->actividad=$request->actividad;
            $actividad->inicio=$request->inicio_actividad;
            $actividad->fin=$request->fin_actividad;
            $actividad->descripcion=$request->descripcion;
            $actividad->id_usuario=$id_usuario;
            $actividad->update();           
        
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



        $actividad =Actividad::find($id);
        if($actividad->estado=='habilitado')
            $actividad->estado='X';
        else
            $actividad->estado='habilitado';
        $actividad->update();
        
        return redirect($this->path_controller);
    }
}
