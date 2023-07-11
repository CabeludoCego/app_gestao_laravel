<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtos() {
        return $this->belongsToMany(Item::class, 'pedidos_produtos', 'pedido_id', 'produto_id')
                ->withPivot('id','created_at', 'updated_at');

        // itens:
        // 1. Model de relacionamento NxN em relação ao que está sendo implementado (aqui, Pedido)
        // 2. Tabela auxiliar que armazena os registros de relacionamento
        // 3. Representa o nome da FK da tabela mapeada pelo modelo, na tabela de relacionamento
        // 4. Representa o nome da FK da tabela mapeada pelo modelo usado no relacionamento

    }
}
