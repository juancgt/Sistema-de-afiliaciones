<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Afiliado;
use Dist\Models\Institucion;
use Dist\Models\Area;
use Dist\Models\Pdf;
use Dist\Models\Saldo;
use Dist\Models\Aporte;
use Dist\Models\Afiliado_Aporte;
class AfiliadoController extends Controller
{
    var $path_view          ="afiliado";
    var $path_controller    ="afiliado";
    var $title              ="Afiliado";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Afiliado::all();
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
        $institucion=Institucion::where('estado','habilitado')->get();
        $area=Area::where('estado','habilitado')->get();
        return view($this->path_view.".create")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('institucion',$institucion)
            ->with('area',$area);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //$fecha=date('2000-01-01');
        $fecha_actual = date("Y-m-d");
        //sumo 1 año
        $fecha=date("Y-m-d",strtotime($fecha_actual."- 20 year"));
        //return $fecha_actual." ".$fecha;
        $this->validate($request,[
            'numero_matricula' => 'required|nullable|numeric',
            'nombres' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'apellidos' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'ci' => 'required|min:7|max:15|alpha_num|unique:afiliado,ci',
            'sexo' => 'required|max:10',
            'direccion' => 'nullable|max:50',
            'estado_civil' => 'required|max:50',
            'fecha_nacimiento' => 'required|date|before:'.$fecha,
            'correo' => 'nullable|max:50|unique:afiliado,correo',
            'telefono' => 'nullable|numeric|digits_between:4,15',
            'foto' => 'nullable|file',
            'institucion' => 'required|numeric',
            'especialidad' => 'required|numeric',
            'fecha_afiliacion' => 'required|date',
            'fecha_titulacion' => 'required|date|before:'.$fecha,
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
        'confirmed' => 'La confirmación de la :attribute no coincide. ',
        'before' => 'La fecha debe ser inferior a la fecha '.$fecha]
        );

        \DB::beginTransaction();
        try {
            

            $img = $request->foto;
            if($img!=null)
                $img=base64_encode(file_get_contents($img));

            

            $id_usuario=\Auth::user()->id;

            $afiliado=new Afiliado();
            $afiliado->item=$request->numero_matricula;
            $afiliado->nombres=$request->nombres;
            $afiliado->apellidos=$request->apellidos;
            $afiliado->ci=$request->ci;
            $afiliado->sexo=$request->sexo;
            $afiliado->direccion=$request->direccion;
            $afiliado->estado_civil=$request->estado_civil;
            $afiliado->fecha_nacimiento=$request->fecha_nacimiento;
            $afiliado->correo=$request->correo;
            $afiliado->telefono=$request->telefono;
            $afiliado->fecha_afiliacion=$request->fecha_afiliacion;
            $afiliado->fecha_titulacion=$request->fecha_titulacion;
            $afiliado->foto=$img;
            $afiliado->id_usuario=$id_usuario;
            $afiliado->id_institucion=$request->institucion;
            $afiliado->id_area=$request->especialidad;
            $afiliado->save();

            $aporte=new Aporte();
            $aporte->motivo="APORTE AFILIACION - ".$afiliado->id;
            $aporte->descripcion="APORTE ANUAL PARA BENEFICIOS DEL MEDICO - ".$request->apellidos." ".$request->nombres;
            $aporte->monto=$request->aporte_anual;
            $aporte->plazo=$request->fecha_vencimiento;
            $aporte->tipo="AFILIADO";
            $aporte->id_usuario=$id_usuario;
            $aporte->save();

            $afiliado_aporte=new Afiliado_Aporte();
            $afiliado_aporte->id_afiliado=$afiliado->id;
            $afiliado_aporte->id_aporte=$aporte->id;
            $afiliado_aporte->id_usuario=$id_usuario;
            $afiliado_aporte->save();

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
    public function afiliado_especialidad(Request $request){
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

            $area=new Area();
            $area->nombre=$request->nombre;
            $area->descripcion=$request->descripcion;
            $area->id_usuario=$id_usuario;
            $area->save();

            \DB::commit();
            return $area;
            //return redirect($this->path_controller);
            
        } 
        catch (\Exception $e) 
        {
            $success = false;
            $error = $e->getMessage();
            \DB::rollback();
            return $error;
        }
    }
    public function afiliado_institucion(Request $request){
        //return $request->all();
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
            return $institucion;
            //return redirect($this->path_controller);
            
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
        
        $datos=Afiliado::find($id);
        //return $datos->afiliado_aporte;
        //return $datos->area->aporte;
        return view($this->path_view.".show")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('model',$this)
            ->with('id',$id);
    }
    public function saldo($id_cliente,$id_aporte)
    {
        //return "1";
        $query="select sum(saldo) saldo from saldo where id_aporte=? and id_afiliado=? and estado='habilitado'";
        $datos=\DB::select(\DB::raw($query),array($id_aporte,$id_cliente));
        return $datos[0]->saldo;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        $institucion=Institucion::where('estado','habilitado')->get();
        $area=Area::where('estado','habilitado')->get();
        $datos=Afiliado::find($id);
        //return $datos->afiliado_aporte[0]->plazo;
        
        return view($this->path_view.".edit")
            ->with('path_controller',$this->path_controller)
            ->with('title',$this->title)
            ->with('datos',$datos)
            ->with('id',$id)
            ->with('institucion',$institucion)
            ->with('area',$area);
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
            'item' => 'nullable|numeric',
            'nombres' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'apellidos' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'ci' => 'required|min:7|max:15|alpha_num|unique:afiliado,ci,'.$id,
            'sexo' => 'required|max:10',
            'direccion' => 'nullable|max:50',
            'estado_civil' => 'required|max:50',
            'fecha_nacimiento' => 'required|date',
            'correo' => 'nullable|max:50|unique:afiliado,correo,'.$id,
            'telefono' => 'nullable|numeric|digits_between:4,15',
            'foto' => 'nullable|file',
            'institucion' => 'required|numeric',
            'especialidad' => 'required|numeric',
            'fecha_afiliacion' => 'required|date',
            'fecha_titulacion' => 'required|date|before:'.date('Y-m-d')
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
            
            $img = $request->foto;
            if($img!=null)
                $img=base64_encode(file_get_contents($img));


            $id_usuario=\Auth::user()->id;

            $afiliado=Afiliado::find($id);
            $afiliado->item=$request->item;
            $afiliado->nombres=$request->nombres;
            $afiliado->apellidos=$request->apellidos;
            $afiliado->ci=$request->ci;
            $afiliado->sexo=$request->sexo;
            $afiliado->direccion=$request->direccion;
            $afiliado->estado_civil=$request->estado_civil;
            $afiliado->fecha_nacimiento=$request->fecha_nacimiento;
            $afiliado->correo=$request->correo;
            $afiliado->telefono=$request->telefono;
            $afiliado->fecha_afiliacion=$request->fecha_afiliacion;
            $afiliado->fecha_titulacion=$request->fecha_titulacion;
            $afiliado->foto=$img;
            $afiliado->id_usuario=$id_usuario;
            $afiliado->id_institucion=$request->institucion;
            $afiliado->id_area=$request->especialidad;
            $afiliado->update();           
        
            $aporte=Aporte::find($request->id_aporte);
            $aporte->plazo=$request->fecha_vencimiento;
            $aporte->monto=$request->aporte_anual;
            $aporte->update();    

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
        $area =Area::find($id);
        if($area->estado=='habilitado')
            $area->estado='X';
        else
            $area->estado='habilitado';
        $area->update();
        
        return redirect($this->path_controller);
    }

    public function foto($id)
    {
        $afiliado=Afiliado::find($id);

        //$foto=Consultas::ver_foto_perfil($afiliado->foto);
        //return die($foto[0]->foto_perfil);
        header("Content-type: image/jpg image/png");
        
        $my_bytea=stream_get_contents($afiliado->foto);
        //return dd($my_bytea);
        die(base64_decode($my_bytea));
    }

    public function detalle($id_afiliado,$id_aporte)
    {
        //return $id1." ".$id2;
        $this->pdf= new Pdf('L','mm','letter');
        $this->pdf->skipHeader = true;
        $this->pdf->skipFooter = true;
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->header=false;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(0,5,"REPORTE - DETALLE DE PAGO",0,0,"C");
        $this->pdf->Ln();


        
        

        $afiliado=Afiliado::find($id_afiliado);
        $aporte=Aporte::find($id_aporte);
        $fecha=date('d-m-Y');
        //return $datos;
        $this->pdf->Cell(0,5,$aporte->motivo,0,0,"C");
        $this->pdf->Ln();
        $this->pdf->Ln();
        $this->pdf->Text(60,32,"AFILIADO: ".$afiliado->nombres." ".$afiliado->apellidos);
        $this->pdf->Text(180,32,"FECHA: ".$fecha);
        
       
        
        
        
        $this->pdf->Ln();
        $this->pdf->Ln();
        
        //$header = array("Nro","Cliente","Fecha","Inmueble","Oferta","Modalidad");

        //return $request->all();
      
            //return "reservas";
        $header = array("Nro","Fecha","Monto");
        $tam=array(10,100,50);
        $pp=160;
        $pp=(260-$pp)/2; 
        

        $data=array();
        $query="select * from saldo
        where id_aporte=? and id_afiliado=?";
        $rows=\DB::select(\DB::raw($query),array($id_aporte,$id_afiliado));
        
        //return $rows;
        $i=1;
        $sum=0;
        foreach($rows as $key=>$item)
        {
            //return "entro";
            $fil=array();
            $fil[]=$i++;
            $fil[]=$item->created_at;
            $fil[]=$item->saldo;
            $sum+=$item->saldo;
            $data[]=$fil;
            
        }
        $fil=array();
        $fil[]='';
        $fil[]='TOTAL';
        $fil[]=$sum;
        $data[]=$fil;

       


        $this->pdf->BasicTable($header,$data,$tam,$pp);
        /*$this->pdf->AddPage();
        $this->pdf->SetFont('Courier', 'B', 18);
        $this->pdf->Cell(50, 25, 'Hello World!');*/
        $headers=['Content-Type' => 'application/pdf'];
        return \Response::make($this->pdf->Output(),200,$headers);
    }
    public function recibo($id1,$id2)
    {
        $this->pdf= new Pdf('L','mm','letter');
        $this->pdf->skipHeader = true;
        $this->pdf->skipFooter = true;
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->header=false;
        $this->pdf->SetFont('Arial', 'B', 12);
        
        $this->pdf->Ln();
        $afiliado=Afiliado::find($id1);


        $saldo=$this->saldo($id1,$id2);

        $query="select * from saldo
                where id_aporte=? and id_afiliado=?
                order by id desc  limit 1";
        $aporte_saldo=\DB::select(\DB::raw($query),array($id2,$id1));

        $numero='';
        $fecha="";
        if(sizeOf($aporte_saldo)>0)
        {
            $numero=$aporte_saldo[0]->id;
            $fecha=$aporte_saldo[0]->created_at;
            $aporte_saldo=$aporte_saldo[0]->saldo;
            
        }
        else
            $aporte_saldo="";
        //return $aporte_saldo;
        $query="select * from aporte where id=?";
        $datos=\DB::select(\DB::raw($query),array($id2));

        $monto=$datos[0]->monto;
        $debe=$monto-$saldo;
        $motivo=$datos[0]->motivo;
        //$fecha=$datos[0]->created_at;
        //$numero=$datos[0]->id;
        
        
       

        $this->pdf->Cell(150,80,'',1,100,"C");
        $this->pdf->SetFont('Arial', 'B', 18);
        $this->pdf->Text(12,16,"RECIBO ");
        $this->pdf->Text(128,16,"Nro 0000".$numero);
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Text(12,30,"RECIBI DE  ".$afiliado->nombres." ".$afiliado->apellidos);
        $this->pdf->Text(35,31,"........................................................................................................");
        //$this->pdf->Text(70,30,"NOMBRES: ".$afiliado->nombres);
        $this->pdf->Text(12,40,"LA CANTIDAD DE ".$aporte_saldo." Bs.");
        $this->pdf->Text(49,41,"............................................................................................");
        //$this->pdf->Text(70,50,"INSTITUCION: ".$afiliado->institucion->nombre);
        $this->pdf->Text(12,50,"POR CONCEPTO DE  ".$motivo);
        $this->pdf->Text(55,51,".......................................................................................");
        $this->pdf->Text(118,60,$fecha);

        $this->pdf->Text(12,77,"RECIBI CONFORME");

        $this->pdf->Text(70,77,"ENTREGUE CONFORME");

        $this->pdf->Text(140,83,$debe." Bs.");
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Text(129,88,"Saldo Pendiente");
        

        $headers=['Content-Type' => 'application/pdf'];
        return \Response::make($this->pdf->Output(),200,$headers);
    }
    public function credencial($id)
    {
        
        $this->pdf= new Pdf('L','mm','letter');
        $this->pdf->skipHeader = true;
        $this->pdf->skipFooter = true;
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->header=false;
        $this->pdf->SetFont('Arial', 'B', 12);
        
        $this->pdf->Ln();
        
        $afiliado=Afiliado::find($id);

        $foto=$afiliado->foto;
        if($foto!=null){
            header("Content-type: image/jpg image/png");
            $my_bytea=stream_get_contents($foto);
            $dataURI= "data:image/jpeg;base64,$my_bytea";       
            $this->pdf->Image($dataURI,15,15,50,50,'PNG');
        }
        else{
            $this->pdf->Image('img/user2-160x160.jpg',15,15,50,50);
        }
        $this->pdf->Cell(150,80,'',1,100,"C");
        $this->pdf->Text(100,15,"NRO MATRICULA ".$afiliado->item);
        $this->pdf->Text(70,30,"NOMBRES: ".$afiliado->nombres);
        $this->pdf->Text(70,40,"APELLIDOS: ".$afiliado->apellidos);
        //$this->pdf->Text(70,50,"INSTITUCION: ".$afiliado->institucion->nombre);
        $this->pdf->Text(70,60,"FECHA DE NACIMIENTO: ".$afiliado->fecha_nacimiento);
        $this->pdf->Text(30,70,$afiliado->ci);

        $headers=['Content-Type' => 'application/pdf'];
        return \Response::make($this->pdf->Output(),200,$headers);
    }
    public function pdf($id)
    {
        $dataURI= "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAPCAMAAADarb8dAAAABlBMVEUAAADtHCTeKUOwAAAAF0lEQVR4AWOgAWBE4zISkMbDZQRyaQkABl4ADHmgWUYAAAAASUVORK5CYII=";

        $img = explode(',',$dataURI,2);
        $pic = 'data://text/plain;base64,'. $img;

        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->Image($pic, 10,30,0,0,'png');
        $this->pdf->Output();
    }
}
