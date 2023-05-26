<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Http\Request;

class QuemSomosController extends Controller
{
    public function __construct(){
        $this->middleware('log.acesso');
    }

    public function quemSomos () {
    
        return view('site/quem-somos');        
    }
}
