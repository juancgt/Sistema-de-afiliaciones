<?php

namespace Dist\Http\Controllers;
use Dist\Models\Role;
use Dist\Models\Permission;
use Dist\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    var $path_view          ="role";
    var $path_controller    ="role";
    var $title              ="Rol";
    public function index()
    {
        $datos=Role::all();
        //return $clase;
        return view($this->path_view.".index")
            ->with('path_controller',$this->path_controller)
            ->with('datos',$datos)
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
        
        //$id_usuario = \Auth::id();

        $this->validate($request,[
            'nombre' => 'required|max:30|regex:/^[\pL\s]+$/u|unique:roles,name',
            'descripcion' => 'nullable|max:255'
        ],
        ['required'   => 'El campo :attribute es obligatorio.',
        'different'  => 'El campo ubicacion y traslado deben ser diferente.',
        'date'       => 'La fecha es invalida',
        'numeric'       => 'El campo :attribute debe contener datos numericos.',
        'unique'       => 'El dato ya existe.',
        'alpha_dash' => ' El campo :attribute solo puede contener caracteres alfanuméricos, así como guiones altos y bajos.',
        'max' => 'El :attribute no debe ser mayor a :max caracteres.',
        'alpha'=> 'El :attribute debe contener únicamente caracteres alfabéticos.',
        'regex' => 'El :attribute contiene caracteres que no corresponden a un :attribute.',
        'min' => 'El :attribute debe tener al menos :min caracteres.']
        );

        //return $request->all();
        //$string = str_replace("‐",",",$string);
        $display_name=str_replace(" ","_",$request->nombre);
        //return $display_name;
        $role = new Role();
        $role->name=$request->nombre;
        $role->display_name=$display_name;
        $role->description=$request->descripcion;
        //$role->id_usuario=$id_usuario;
        $role->save();
        return redirect($this->path_controller);
        //return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //buscamos los permisos que pertenezcan al rol $id
        $rol=Role::findOrFail($id);
        $datos=$rol->permission;

        $permiso=Permission::wherenotin('id',function($q) use ($id){
            $q->from('permission_role')->select('permission_id')->where('role_id',$id);
        })->get();
        //$rol=Role::find($id);
        //return $datos;
        //$datos=array();
        return view($this->path_view.'.show')
            ->with('path_controller',$this->path_controller)
            ->with('id',$id)
            ->with('title',$this->title)
            ->with('rol',$rol)
            ->with('permiso',$permiso)
            ->with('datos',$datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datos=Role::find($id);
        //return $datos->name;
        return view($this->path_view.".edit")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('id',$id)
            ->with('datos',$datos);
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
            'nombre' => 'required|max:30|regex:/^[\pL\s]+$/u|unique:roles,name',
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

        //return $request->all();
        //$string = str_replace("‐",",",$string);
        $display_name=str_replace(" ","_",$request->nombre);

        //

        $role =Role::find($id);
        $role->name=$request->nombre;
        $role->display_name=$display_name;
        $role->description=$request->descripcion;
        //$role->id_usuario=$id_usuario;
        $role->update();
        return redirect($this->path_controller);


        
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
        $role =Role::find($id);
        $role->delete();
        return redirect($this->path_controller);
    }
}
