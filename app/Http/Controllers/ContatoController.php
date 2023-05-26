<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato (Request $request) {
        
        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');
        
        // print_r($contato->getAttributes());
        // $contato->save();

        // $contato = new SiteContato();

        // // Método 2: Criar imediatamente
        // $contato->create($request->all());

        // Método 1: Preencher e salvar
        // $contato->fill($request->all());
        // $contato->save();

        $motivo_contatos = MotivoContato::all();

        return view('site/contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);   
        
    }

    public function salvar (Request $request) {
        // dd($request);

        // validar dados
        // Associados com names de input do front end
        $regras = [
            'nome' => 'required|min:3|max:60|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem'  => 'required|max:400',
        ];

        $correcoes = [
            'nome.required' => 'Preencha corretamente o campo nome',
            'nome.min' => 'O campo nome requer no mínimo 3 caracteres',
            'nome.unique' => 'O nome informado já está em uso',

            'email.email' => 'Email não válido!',

            'required'    => 'Campo :attribute precisa ser preenchido!',
        ];

        $request->validate($regras, $correcoes );



        // Salvar
        SiteContato::create($request->all());

        return redirect()->route('site.index');

        // return view('site/contato', ['titulo' => 'Contato']);   

    }
}
