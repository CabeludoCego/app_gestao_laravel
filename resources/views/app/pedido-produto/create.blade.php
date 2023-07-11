@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Adicionar Produtos ao Pedido</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">


            <h4>Detalhes do pedido</h4>
            <p>ID do pedido: {{ $pedido->id }}</p>
            <p>Cliente: {{ $pedido->cliente_id }}</p>

            <h4>Itens do pedido</h4>
            <table border="1"
            {{-- width="80%" --}}
            style="width: 70%; margin-left: auto; margin-right: auto;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do produto</th>
                        {{-- <th>Quantidade</th>0 --}}
                        <th>Data de inclusão</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->produtos as $produto)

                        <tr>
                            <td> {{ $produto->id }} </td>
                            <td> {{ $produto->nome }} </td>
                            {{-- <td> {{ $pedido->produtos->quantidade }}</td> --}}
                            <td> {{ $produto->pivot->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('pedido-produto.destroy', ['pedidoProduto' => $produto->pivot->id, 'pedido_id' => $pedido->id]) }}"
                                    id="form_{{ $produto->pivot->id }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="#" onclick="document.getElementById('form_{{ $produto->pivot->id }}').submit()">Excluir</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $pedido }} --}}

            <br>
            <div style="margin-top: 50px; width: 40%; margin-left: auto; margin-right: auto;">
                @component('app.pedido-produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent
            </div>
        </div>

    </div>

@endsection

