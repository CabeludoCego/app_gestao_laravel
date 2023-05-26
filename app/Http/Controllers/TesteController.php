<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function teste(int $param1, int $param2){
 
        // Array associativo
        // return view('site.teste', ['param1' => $param1, 'param2' => $param2]);

        // Compact
        return view('site.teste', compact('param1', 'param2'));

        // With
        // return view('site.teste')->with ('param1', $param1)->with('param2', $param2);

    }
}
