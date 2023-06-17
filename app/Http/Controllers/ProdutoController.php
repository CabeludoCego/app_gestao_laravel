<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);
        // get();

        // // Bloco substituível pela declaração hasOne()!
        // foreach($produtos as $key => $produto) {
        //     $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
        //     if(isset($produtoDetalhe)) {
        //         $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
        //         $produtos[$key]['largura'] =     $produtoDetalhe->largura;
        //         $produtos[$key]['altura'] =      $produtoDetalhe->altura;
        //     }
        // }
        // // fim bloco

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Se necessário tratativa
        // $produto = new Produto();
        // $nome = $request->get('nome');
        // $descricao = $request->get('descricao');

        // $nome = strtoupper($nome);

        // $produto->nome = $nome;
        // $produto->descricao = $descricao;
        // $produto->save();


        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',

            // 'unidade_id' => 'exists:<table>,<coluna>',

        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'min' => 'O campo :attribute deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 40 caracteres',

            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'Unidade informada não existe',
        ];

        $request->validate($regras, $feedback);

        // Se não requer tratativa
        Produto::create($request->all());

        return redirect()->route('produto.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        // dd($produto);
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);

        // return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        // Visualizar dados novos e anteriores, sem atualizar.
        // Comentar tudo abaixo dele.
        // print_r($request->all());
        // echo '<br>';
        // print_r($produto->getAttributes());

        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produto.index');

    }
}
