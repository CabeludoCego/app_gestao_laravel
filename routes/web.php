<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\QuemSomosController;
use App\Http\Controllers\TesteController;
use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// /, /contato, /quem-somos

// Route::get('/', function () {
//     // return view('welcome');
//     return 'Seja bem vindo ao curso!';
// });


Route::get('/', [PrincipalController::class, 'principal'])
        ->name('site.index');
        // ->middleware(LogAcessoMiddleware::class);

Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'salvar'])->name('site.contato');

$uri1 = '/quem-somos'; $callback3 = [QuemSomosController::class,'quemSomos'];
Route::get($uri1, $callback3)->name('site.quem-somos');




Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function() {
    Route::get('/home',       [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair',       [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente',    [ClienteController::class, 'index'])->name('app.cliente');

    
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::get('/fornecedor/listar/', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::post('/fornecedor/listar/', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}/{msg?}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');


    Route::get('/produto',    [ProdutoController::class, 'index'])->name('app.produto');
    Route::resource('produto', ProdutoController::class);


});

Route::get('/rota1', function() {echo 'Rota 1';} )->name('site.rota1');
Route::get('/rota2', function() {
    return redirect()->route('site.rota1');
})->name('site.rota2');

// Redirect 1: controller ou na rota, acima

// Redirect 2: Direto
// Route::redirect('/rota2', '/rota1');

// Rota de fallback
Route::fallback(function() { echo 'Rota inexistente.
    <a href="'.route('site.index').'"> Retornar à Página principal. </a>' ;
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('site.teste');












// AULAS: ROTAS E PARÂMETROS

$callback4 = function (
    string $nome, string $categoria, string $assunto = '_', string $mensagem = 'vazio') {
    echo 'Fala comigo, ' .$nome .', me diz cadê você. <br>';
    echo "Para falar de $categoria, a respeito de $assunto, quero dizer que $mensagem." ;
};

Route::get('/contato/{nome}/{categoria}/{assunto?}/{mensagem?}', $callback4);

Route::get('/contato2/{nome}/{categoria_id?}', function (
        string $nome = 'Unknown',
        int $categoria_id = 1
    ) {
        echo "User $nome, ID $categoria_id";
    }
)->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+');
