@extends('app.layouts.basico')


@section('titulo', 'Produto Detalhes')
@section('conteudo')

	<div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>
                Detalhes do Produto - Adicionar
            </p>
        </div>

        <div class="menu">
            <ul>
                <li href="{{ route('produto.index') }}">Voltar</li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{ $msg ?? '' }}
            <div style="width:30%; margin-left: auto; margin-right: auto;">
                @component('app.produto_detalhe._components.form_create_edit', ['unidades' => $unidades])

                @endcomponent
            </div>
        </div>
	</div>


@endsection
