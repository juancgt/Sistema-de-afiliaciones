<?php

namespace Dist\Http\Controllers;
use Dist\User;
use Dist\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    var $path_view          ="user";
    var $path_controller    ="user";
    var $title              ="Usuario";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::all();
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
        $role=Role::all();
        return view($this->path_view.".create")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('role',$role);
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
            'nombres' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'apellidos' => 'required|max:30|regex:/^[\pL\s]+$/u',
            /*'apellido_materno' => 'nullable|max:30|alpha',
            'fecha_nacimiento' => 'nullable|date',
            'ci' => 'nullable|min:7|max:15|alpha_num|unique:persona,ci_nit',*/
            'correo_electronico' => 'nullable|max:50|unique:users,email',
            /*'direccion' => 'nullable|max:50',
            'telefono' => 'nullable|numeric|digits_between:4,15',*/
            'usuario' => 'required|max:30|unique:users,name',
            'contraseña' => 'required|min:4',
            'foto' => 'nullable|file',
            'rol' => 'required|numeric'    
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

        $success=false;
        \DB::beginTransaction();
        try {
            
            $img = $request->foto;
            if($img!=null)
                $img=base64_encode(file_get_contents($img));


            $id_usuario=\Auth::user()->id;


            $user=new User();
            $user->first_name=$request->nombres;
            $user->last_name=$request->apellidos;
            $user->name=$request->usuario;
            $user->email=$request->correo_electronico;
            $user->password=\Hash::make($request->contraseña);  
            $user->photo=$img;
            $user->save();

            $user->attachRole($request->rol);

            \DB::commit();
            $success = true;
            
        } 
        catch (\Exception $e) 
        {
            $success = false;
            $error = $e->getMessage();
            \DB::rollback();
            return $error;
        }
        if($success)
        {
            return redirect($this->path_controller);
        }
        else
        {
            \DB::rollback();
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
        $datos=User::find($id);
        
        return view($this->path_view.".show")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('rol',$datos->roles)
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
        $user=User::find($id);

        $roles=Role::all();
        return view($this->path_view.".edit")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('roles',$roles)
            ->with('user',$user)
            ->with('rol',$user->roles)
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
        $user=User::find($id);
        $this->validate($request,[
            'nombres' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'apellidos' => 'required|max:30|regex:/^[\pL\s]+$/u',
            /*'apellido_materno' => 'nullable|max:30|alpha',
            'fecha_nacimiento' => 'nullable|date',
            'ci' => 'nullable|min:7|max:15|alpha_num|unique:persona,ci_nit',*/
            'correo_electronico' => 'nullable|max:50|unique:users,email,'.$id,
            /*'direccion' => 'nullable|max:50',
            'telefono' => 'nullable|numeric|digits_between:4,15',*/
            'usuario' => 'required|max:30|unique:users,name,'.$id,
            'contraseña' => 'nullable|min:4',
            'foto' => 'nullable|file',
            'rol' => 'required|numeric'     
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

            

            $user->roles()->sync($request->rol);
            //$user=new User();
            $img = $request->foto;
            if($img!=null)
                $img=base64_encode(file_get_contents($img));
            else
                $img=$user->foto_perfil;


                
                
            $user->first_name=$request->nombres;
            $user->last_name=$request->apellidos;
            $user->name=$request->usuario;
            $user->email=$request->correo_electronico;
            if(!empty($request->contraseña))
            {
                $user->password=\Hash::make($request->contraseña);
            }
            $user->photo=$img;
            $user->update();

            
        
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

        /*$query="select * from habilitar_deshabilitar_usuario(?)";
        \DB::select(\DB::raw($query),array($id));*/

        $user =User::find($id);
        if($user->estado=='habilitado')
            $user->estado='X';
        else
            $user->estado='habilitado';
        $user->update();
        
        return redirect($this->path_controller);
    }
}
