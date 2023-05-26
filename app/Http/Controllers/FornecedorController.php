<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            // ->paginate(5);
            ->get();

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){

        $msg = '';
        
        // Inclusão de elemento, verifica csrf token
        if($request->input('_token') != '' && $request->input('id') == ''){

            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchida',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso';


        }


        // Edição de elemento
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));

            $update = $fornecedor->update($request->all());
            if($update) {
                $msg = 'Atualizado com sucesso!';
            } else {
                $msg = 'Erro ao atualizar o registro!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {

        $fornecedor = Fornecedor::find($id);

        return view ('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id) {


        Fornecedor::find($id)->delete();      // registro permanece na db
        // Fornecedor::find($id)->forceDelete(); // apaga da db

        return redirect()->route('app.fornecedor');

    }
}


// ------- Antigo método do fornecedor --------
// public function index() {

//     $fornecedores = [
//         0=>[ 'nome' =>'fornecedor 1'],
//         1=>[ 'nome' =>'fornecedor 2', 'ddd' => 12],
//         2=>[ 'nome' => 'fornecedor 3', 'status' => 'ativo', 'ddd' => 11 ],
//         4=>[ 'nome' => 'fornecedor 4', 'status' => 'ativo', 'ddd' => 86 ],
//     ];

//     // // Operador ternário
//     // echo isset($fornecedores[0]['cpnj']) ? 'CNPJ informado' : 'CPNJ não informado';
//     // // Atribuição de valor
//     $msg = isset($fornecedores[0]['cpnj']) ? 'CNPJ informado' : 'CPNJ não informado';
//     echo $msg;

//     return view('app.fornecedor.index', compact('fornecedores'));
// }
