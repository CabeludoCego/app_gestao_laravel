<?php

namespace App\Http\Middleware;

use App\Models\LogAcesso;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // $request 

        // return $next($request);
        // dd($request); // forma objeto response. Print não forma response.

        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log' => "IP $ip solicitou rota $rota"]);

        // return $next($request);
        $resposta = $next($request);

        $resposta->setStatusCode(201, 'Status e texto da resposta modificados.');
        
        return $resposta;
        // dd($resposta);

        // return Response('Chegamos no middleware. Finalizamos nele.');

    }
}
