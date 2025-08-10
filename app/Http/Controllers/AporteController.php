<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Aporte;
use Dist\Models\Afiliado;
use Dist\Models\Institucion;
use Dist\Models\Area;
use Dist\Models\Pdf;
class AporteController extends Controller
{
    var $path_view          ="aporte";
    var $path_controller    ="aporte";
    var $title              ="Aporte";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Aporte::all();
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
            'motivo' => 'required|max:200',
            'descripcion' => 'nullable|max:1000',
            'monto' => 'required|numeric',
            'plazo' => 'required|date'
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

            $aporte=new Aporte();
            $aporte->motivo=$request->motivo;
            $aporte->descripcion=$request->descripcion;
            $aporte->monto=$request->monto;
            $aporte->plazo=$request->plazo;
            $aporte->id_usuario=$id_usuario;
            $aporte->save();

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
        
        $area=Area::findOrFail($id);
        $datos=$area->actividad;

        $actividad=Actividad::wherenotin('id',function($q) use ($id){
            $q->from('area_actividad')->select('id_actividad')->where('id_area',$id);
        })->get();


        return view($this->path_view.'.show')
            ->with('path_controller',$this->path_controller)
            ->with('id',$id)
            ->with('title',$this->title)
            ->with('area',$area)
            ->with('actividad',$actividad)
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
        $datos=Aporte::find($id);

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

            $area=Area::find($id);
            $area->nombre=$request->nombre;
            $area->descripcion=$request->descripcion;
            $area->id_usuario=$id_usuario;
            $area->update();           
        
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



        $aporte =Aporte::find($id);
        if($aporte->estado=='habilitado')
            $aporte->estado='X';
        else
            $aporte->estado='habilitado';
        $aporte->update();
        
        return redirect($this->path_controller);
    }
    public function reporte()
    {
        //$data=Aporte::all();
        //return $datos;
        $data=Afiliado::all();
        $institucion=Institucion::all();
        $area=Area::all();
        //return $data;
        return view('reporte.index')
            ->with('path_controller',$this->path_controller)
            ->with('data',$data)
            ->with('institucion',$institucion)
            ->with('area',$area )
            ->with('title','Reporte');
    }
    public function reporte_pdf(Request $request)
    {
        $this->pdf= new Pdf('L','mm','Legal');
        $this->pdf->skipHeader = false;
        $this->pdf->skipFooter = false;
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->pdf->header=false;
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(0,5,"APORTES",0,0,"C");
        $this->pdf->Ln();

        $inicio=$request->desde;
        $fin=$request->hasta;
        $id_afiliado=$request->afiliado;
        $id_especialidad=$request->especialidad;
        $id_institucion=$request->institucion;
        $plan_pago=$request->plan_pago;
        $parametros=array();
        $bol=false;
        $bol2=false;
        $bol3=false;
        if($plan_pago=="todos")
            $condicion4="";
        else if($plan_pago=="contado")
            $condicion4="(select count(id) from saldo where id_aporte=ap.id and id_afiliado=a.id)=1 and (select sum(saldo) from saldo where id_aporte=ap.id and id_afiliado=a.id)=ap.monto and";
        else
            $condicion4="(select count(id) from saldo where id_aporte=ap.id and id_afiliado=a.id)>1 and ";


        if($id_institucion=="todos")
        {
            $condicion3="";
            //return "entro";
        }
        else
        {
            $condicion3=" i.id=? and ";
            $parametros[]=$id_institucion;
            $bol3=true;
        }
        if($id_especialidad=="todos")
        {
            $condicion2="";
            //return "entro";
        }
        else
        {
            $condicion2=" ar.id=? and ";
            $parametros[]=$id_especialidad;
            $bol2=true;
        }
        if($id_afiliado=="todos")
        {
            $condicion1="";
            //return "entro";
        }
        else
        {
            $condicion1=" a.id=? and ";
            $parametros[]=$id_afiliado;
            $bol=true;
        }
        
        
        if($bol)
        {
            $afiliado=Afiliado::find($id_afiliado);
            
            $this->pdf->Cell(0,5,$afiliado->nombres." ".$afiliado->apellidos,0,0,"C");
            $this->pdf->Ln();
        }
     
        
        $fecha=date('d-m-Y');
        $this->pdf->Cell(0,5,"De ".$inicio." a ".$fin,0,0,"C");
        $this->pdf->Ln();
        $this->pdf->Ln();
        
        //$header = array("Nro","Cliente","Fecha","Inmueble","Oferta","Modalidad");

        //return $request->all();
      
            //return "reservas";
        if($bol)
        {
            $header = array("Nro","Aporte","Institucion","Especialidad","Plazo","Total","A cuenta","Saldo");
            $tam=array(10,70,70,70,25,20,20,20);
            $pp=305;
            $pp=(335-$pp)/2; 
        }
        else
        {
            $header = array("Nro","Afiliado","Aporte","Institucion","Especialidad","Total","A cuenta","Saldo");
            $tam=array(10,70,70,70,54,20,20,20);
            $pp=334;
            $pp=(335-$pp)/2; 
        }
        
        



        $data=array();
        $query="select a.nombres||' '||a.apellidos afiliado,ap.motivo,ap.descripcion,ap.monto,ap.plazo,i.nombre institucion, ar.nombre especialidad,
        (select sum(saldo) from saldo where id_aporte=ap.id and id_afiliado=a.id)
        
        from afiliado a
        inner join institucion i
        on i.id=a.id_institucion

        inner join area ar
        on a.id_area=ar.id
        inner join area_aporte aa
        on aa.id_area=ar.id
        inner join aporte ap
        on ap.id=aa.id_aporte
        where ".$condicion4.$condicion3.$condicion2.$condicion1." date(ap.created_at)>= ? and  date(ap.created_at)<=?
        union
        select a.nombres||' '||a.apellidos afiliado,ap.motivo,ap.descripcion,ap.monto,ap.plazo,i.nombre institucion, ar.nombre especialidad,
        (select sum(saldo) from saldo where id_aporte=ap.id and id_afiliado=a.id)
        from afiliado a
        inner join institucion i
        on i.id=a.id_institucion

        inner join area ar
        on a.id_area=ar.id
        inner join afiliado_aporte aa
        on aa.id_afiliado=a.id
        inner join aporte ap
        on ap.id=aa.id_aporte
        where ".$condicion4.$condicion3.$condicion2.$condicion1." date(ap.created_at)>= ? and  date(ap.created_at)<=?
        ";
        //return $query;
        $parametros[]=$inicio;
        $parametros[]=$fin;
        if($bol3)
            $parametros[]=$id_institucion;
        if($bol2)
            $parametros[]=$id_especialidad;
        if($bol)
        {
            $parametros[]=$id_afiliado;
        }
        
        
        $parametros[]=$inicio;
        $parametros[]=$fin;

        $rows=\DB::select(\DB::raw($query),$parametros);
        //return $rows;
        $i=1;
        $total_unidades=0;
        $total_precio=0;
        $total_saldo=0;
        $total_a_cuenta=0;
        foreach($rows as $key=>$item)
        {
            //return "entro";
            $fil=array();
            $fil[]=$i++;
            if(!$bol)
            {
                $fil[]=$item->afiliado;
            }
                
            $fil[]=$item->motivo;
            if($bol)
            {
                $fil[]=$item->plazo;
            }
         
            $fil[]=$item->institucion; 
            $fil[]=$item->especialidad; 
            
            $fil[]=$item->monto;
            $fil[]=$item->sum;
            $fil[]=($item->monto)-($item->sum);
            $data[]=$fil;
            
        }

       


        $this->pdf->BasicTable($header,$data,$tam,$pp);
        /*$this->pdf->AddPage();*/
        $this->pdf->Ln(25);
        $this->pdf->SetFont('Courier', 'B', 18);
        
        $this->pdf->Cell(0, 5, 'FIRMA',0,0,'C');
        //$this->pdf->Text(120, 50, "asdas");
        $headers=['Content-Type' => 'application/pdf'];
        return \Response::make($this->pdf->Output(),200,$headers);
    }
}
