<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Database\Factories\SiteContatoFactory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $contato = new SiteContato();
        // $contato->nome = 'Nome';
        // $contato->email = '@email.com';
        // $contato->telefone = '86 99909090';
        // $contato->motivo_contato = 2;
        // $contato->mensagem = 'txt';
        
        // old
        // factory(SiteContatoFactory::class, 100)->create();
        
        SiteContato::factory()->count(100)->create();

    }
}
