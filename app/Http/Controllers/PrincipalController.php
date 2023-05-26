<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Http\Request;


// /, /contato, /quem-somos


class PrincipalController extends Controller
{
    public function principal() {
        // echo 'Olá, este é o controller principal.';

        $motivo_contatos = MotivoContato::all();
        return view('site.principal', ['titulo'=> 'Index', 'motivo_contatos' => $motivo_contatos]);
    }
}
