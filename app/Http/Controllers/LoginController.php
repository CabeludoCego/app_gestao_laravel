<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request) {

        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha não existem.';
        } elseif ($request->get('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso.';
        }
        // $erro = $request->get('erro');


        return view('site.login', ['titulo' => 'login', 'erro' => $erro]);
    }

    

    public function autenticar(Request $request) {
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];
        
        $feedback = [
            'usuario.email'  => 'O campo usuário (email) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $email    = $request->get('usuario');
        $password = $request->get('senha');

        echo "Usuário: $email | Senha: $password";
        echo '<br>';

        $user = new User();
        $usuario = $user->where('email', $email)->where('password', $password)
        ->get()->first();

        if(isset($usuario->name)) {

            echo 'Usuário existe';

            session_start();  
            // Superglobal: Recupera parâmetros em qualquer página, sem passagem.
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            // dd($_SESSION);
            return redirect()->route('app.home');
            

        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_destroy();
        return redirect()->route('site.index');
    }
}
