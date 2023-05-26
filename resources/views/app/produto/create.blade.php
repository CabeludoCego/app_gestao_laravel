@extends('app.layouts.basico')


@section('titulo', 'Produto')
@section('conteudo')

	<div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Produto - Adicionar</p>
        </div>

        <div class="menu">
            <ul>
                <li>Novo</li>
                <li>Consulta</li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{ $msg ?? '' }}
            <div style="width:30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('app.produto.create') }}">
                    <input type="hidden" name="id" value="{{ $produto->id ?? '' }}">
                    @csrf
                    <input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" placeholder="Site" class="borda-preta">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

                    <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="UF" class="borda-preta">
                    {{ $errors->has('peso') ? $errors->first('peso') : '' }}

                    <input type="text" name="unidade_id" value="{{ $produto->unidade_id ?? old('unidade_id') }}" placeholder="E-mail" class="borda-preta">
                    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
	</div>


@endsection
