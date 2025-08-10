<?php

namespace Dist\Http\Controllers;

use Illuminate\Http\Request;
use Dist\Models\Saldo;
class SaldoController extends Controller
{
    public function store(Request $request){
        //return $request->all();
        $id_usuario=\Auth::user()->id;
        $saldo=new Saldo();
        $saldo->saldo=$request->saldo;
        $saldo->id_afiliado=$request->id_cliente;
        $saldo->id_aporte=$request->id_aporte;
        $saldo->id_usuario=$id_usuario;
        $saldo->save();
    }
}
