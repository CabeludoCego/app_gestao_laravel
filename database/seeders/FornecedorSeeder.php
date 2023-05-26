<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // manual, fill pode resolver
        $fornecedor = new Fornecedor();
        $fornecedor->nome=  'Fornecedor 100';
        $fornecedor->uf=    'ES';
        $fornecedor->site=  'forne100.com';
        $fornecedor->email= 'fornece100@gmail.com';
        $fornecedor->save();

        $fornecedor2 = new Fornecedor();
        $fornecedor2->fill(['nome'=>'João',
        'uf'=>'PE',
        'site'=>'acesseme.ponto.com',
        'email'=>'terra@email.com']);
        $fornecedor2->save();

        // requer fillable
        Fornecedor::create([
            'nome'=>'Fornecedor 300',
            'uf'=>'RS', 
            'site'=>'Forne300.com', 
            'email'=>'fornecedor300@email.com'
        ]);

        // insert
        DB::table('fornecedores')->insert([
            
            'nome'=>'Fornecedor 300',
            'uf'=>'RS', 
            'site'=>'Forne300.com', 
            'email'=>'fornecedor300@email.com'
        ]);
    }
}
