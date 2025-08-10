<?php

namespace Dist\Http\Controllers;
use Dist\Models\Permission;
use Dist\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    var $path_view          ="permission";
    var $path_controller    ="permission";
    var $title              ="Permiso";

    public function index()
    {

    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'permiso' => 'required|numeric'
        ],
        ['required'   => 'El campo :attribute es obligatorio.',
        'different'  => 'El campo ubicacion y traslado deben ser diferente.',
        'date'       => 'La fecha es invalida',
        'numeric'       => 'El campo :attribute debe contener datos numericos.',
        'unique'       => 'El :attribute ya existe.',
        'alpha_dash' => ' El campo :attribute solo puede contener caracteres alfanuméricos, así como guiones altos y bajos.',
        'max' => 'El :attribute no debe ser mayor a :max caracteres.',
        'alpha'=> 'El :attribute debe contener únicamente caracteres alfabéticos.',
        'regex' => 'El :attribute contiene caracteres que no corresponden a un :attribute.',
        'min' => 'El :attribute debe tener al menos :min caracteres.']
        );

        //$display_name=str_replace(" ","_",$request->nombre);


        $rol = Role::find($request->id_rol);
        $rol->attachPermission($request->permiso);

        /*$permission = new Permission();
        $permission->name=$request->permiso;
        $permission->display_name=$display_name;
        $permission->description=$request->descripcion;
        $permission->save();*/
        return redirect('role/'.$request->id_rol);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$array = explode("-", $id);
        $id_permission=$array[0];
        $id_rol=$array[1];
        //return $id;
        $datos=Permission::find($id_permission);
        //return $datos->name;
        return view($this->path_view.".edit")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('id',$id)
            ->with('datos',$datos);*/
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
        /*$this->validate($request,[
            'nombre' => 'required|max:30',
            'descripcion' => 'nullable|max:255'
        ],
        ['required'   => 'El campo :attribute es obligatorio.',
        'different'  => 'El campo ubicacion y traslado deben ser diferente.',
        'date'       => 'La fecha es invalida',
        'numeric'       => 'El campo :attribute debe contener datos numericos.',
        'unique'       => 'El :attribute ya existe.',
        'alpha_dash' => ' El campo :attribute solo puede contener caracteres alfanuméricos, así como guiones altos y bajos.',
        'max' => 'El :attribute no debe ser mayor a :max caracteres.',
        'alpha'=> 'El :attribute debe contener únicamente caracteres alfabéticos.',
        'regex' => 'El :attribute contiene caracteres que no corresponden a un :attribute.',
        'min' => 'El :attribute debe tener al menos :min caracteres.']
        );

        $display_name=str_replace(" ","_",$request->nombre);


        $array = explode("-", $id);
        $id_permission=$array[0];
        $id_rol=$array[1];

        $permission =Permission::find($id_permission);
        $permission->name=$request->nombre;
        $permission->display_name=$display_name;
        $permission->description=$request->descripcion;
        $permission->update();
        return url('horario_clase/'.$id_rol);
        return url($this->path_controller);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //return $id;
        $array=explode("-",$id);
        $rol = Role::find($array[1]);
        $rol->detachPermission($array[0]);
        return redirect('role/'.$array[1]);

    }
}
