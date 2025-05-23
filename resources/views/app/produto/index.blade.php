@extends('app.layouts.basico')


@section('titulo', 'Produto')
@section('conteudo')

	<div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Produto - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="{{ route('produto.index') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Largura</th>
                            <th>Altura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->largura ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->altura ?? '' }}</td>
                                {{-- <td>{{ $produto->altura ?? '' }}</td> --}}
                                <td>
                                    <a href="{{ route('produto.show', ['produto' => $produto->id]) }}">
                                        Visualizar
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <form id="formDel_{{ $produto->id }}" method="post" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                        @method('DELETE')
                                        @csrf

                                        {{-- <button type="submit">Excluir</button>
                                         --}}
                                         <a href="#" onclick="document.getElementById('formDel_{{ $produto->id }}').submit()">
                                            Excluir
                                        </a>
                                    </form>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="12">
                                    <p>Pedidos</p>

                                    {{ $produto }}
                                    {{ $produto->pedido }}

                                    @foreach ($produto->pedidos as $pedido)
                                        <a href="{{ route('pedido-produto/create', ['pedido' => $pedido->id]) }}">

                                            Pedido: {{ $pedido->id }}
                                        </a>

                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                {{-- {{ $fornecedores->appends($request)->links() }}
                <br>
                {{ $fornecedores->count() }} registros na página
                <br>
                {{ $fornecedores->total() }} registros totais
                <br>
                Registros {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }} --}}

                <br>
                {{-- Exibindo {{ $produtos->count() }} produtos de {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }} --}}

            </div>
        </div>
	</div>


@endsection
