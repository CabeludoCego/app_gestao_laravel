<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        $pedido->produtos; // Eager-loading;
        return view('app.pedido-produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pedido $pedido)
    {

        // dd($request);
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'

        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'required' => ':attribute deve possuir valor válido.'
        ];

        $request->validate($regras, $feedback);

        // $pedidoProduto = new PedidoProduto();
        // $pedidoProduto->pedido_id = $pedido->id;
        // $pedidoProduto->produto_id = $request->get('produto_id');

        // $pedidoProduto->save();

        // ----------------------------------------------------------------

        // $pedido->produtos   // Listagem de itens com o relacionamento
        // $pedido->produtos() // Objeto que mapeia relacionamento

        // Envio de múltiplos itens, para múltiplos ids
        $pedido->produtos()->attach([
            $request->get('produto_id') => [
                'quantidade' => $request->get('quantidade')
            ],
            // $request->get('produto_id_2') => ['quantidade' => $request->get('quantidade_2'),],

        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // print_r($pedido->getAttributes());
        // echo '<hr>';
        // print_r($produto->getAttributes());

        // // método convencional: Query
        // PedidoProduto::where([
        //     'pedido_id' => $pedido->id,
        //     'produto_id' => $produto->id,
        // ])->delete();

        // método detach: Usa a relação
        // $pedido->produtos()->detach($produto->id);

        // ou o contrário:
        // $produto->pedidos()->detach($pedido->id);

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedidoProduto' => $pedidoProduto, 'pedido_id' => $pedido_id ]);

    }
}
