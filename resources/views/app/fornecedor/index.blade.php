@extends('app.layouts.basico')


@section('titulo', 'Fornecedor')
@section('conteudo')

	<div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Fornecedor</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            <div style="width:30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('app.fornecedor.listar') }}">
                    @csrf
                    <input name="nome" type="text" placeholder="Nome" class="borda-preta">
                    <input name="site" type="text" placeholder="Site" class="borda-preta">
                    <input name="uf" type="text" placeholder="UF" class="borda-preta">
                    <input name="email" type="text" placeholder="E-mail" class="borda-preta">
                    <button type="submit" class="borda-preta">Pesquisar</button>
                </form>
            </div>
        </div>
	</div>


@endsection
