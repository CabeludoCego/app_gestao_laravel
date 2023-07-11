<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe() {
        return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');
        // naturalmente busca FK = Item_id
        // deve buscar produto_id
    }

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }

    public function pedidos() {
        return $this->belongsToMany(Pedido::class, 'pedidos_produtos', 'produto_id' , 'pedido_id');
    }

    /*
        3- FK da tabela mapeada pelo model, na tabela de relacionamento
        4- FK da tabela mapeada pelo model
    */
}
