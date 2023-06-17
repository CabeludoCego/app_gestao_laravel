@extends('app.layouts.basico')


@section('titulo', 'Produto')
@section('conteudo')

	<div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            {{-- @if(isset($produto->id)) --}}

            {{-- @else --}}
            <p>
                Produto - Adicionar
            </p>
            {{-- @endif --}}
        </div>

        <div class="menu">
            <ul>
                <li href="{{ route('produto.index') }}">Voltar</li>
                <li>Consulta</li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{ $msg ?? '' }}
            <div style="width:30%; margin-left: auto; margin-right: auto;">
                @component('app.produto._components.form_create_edit', ['unidades' => $unidades])

                @endcomponent
            </div>
        </div>
	</div>


@endsection
