# Notas de Aula - Laravel Super Gestão with Jorge Sant Anna

## Relacionamentos

Por padrão definiremos dois nomes de classe:
> Classe A
> Classe B

1. **One to One (1 : 1)** 

Nessa relação de classes, um objeto da Classe A pode possuir ligação com apenas 1 objeto da Classe B.

**Exemplo**: Classe Carro, classe PlacaCarro
O Carro só pode possuir 1 placa ativa por vez.

**Exemplo 2**: Classe Pessoa, Classe CPF
A pessoa só pode possuir 1 CPF.



2. **One to Many (1 : N)**

Uma classe possui, ou pode possuir, várias relações com objetos da Classe N.

**Exemplo**: Classes Pessoa e PlanoSaude
A pessoa pode possuir vários planos de saúde distintos



3. **Many to One (N : 1)**

Relação inversa da 1:N, observada da perspectiva da classe que tem várias relações.

**Exemplo**: Classes Pessoa e PlanoSaude
Vários planos de saúde podem ser da mesma pessoa. 


4. **Many to Many (N : N)**

Por fim, relação entre classes onde há certo pertencimento necessário para o usuário verificar, porém, a relação não é de exclusividade.

*Exemplo*: Classes Carro e Cliente.
Um Cliente pode ter vários carros distintos, assim como um Carro é possuído por vários clientes distintos para o sistema.

Intrinsecamente, é interessante registrar as relações N:N em uma tabela única para o relacionamento, de modo que mais facilmente pode-se resgatar os registros ou verificar a situação de pertencimento.


=======================

## Exemplos práticos: Super Gestão

Vamos definir algumas classes presentes no projeto antes de desenvolver os exemplos práticos e trazer a grafia de cada relação estabelecida.

1. Item 			 (=Produto)
2. ItemDetalhe (=ProdutoDetalhe)
3. Fornecedor
4. Pedidos

Todas as relações serão, inicialmente, exemplificadas a partir da classe item.

1. Item e ItemDetalhe (1:1)
   	Um Item tem apenas um ItemDetalhe, com especificações desse Item.

	```php (arquivo Item.php)
	
		public function itemDetalhe() {
				return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');
		}
	
	```

	```php (arquivo ItemDetalhe.php)
	
		public function item() {
				return $this->belongsTo(Item::class, 'produto_id', 'id');
		}

	```

		Nesse caso em específico, a tabela no banco de dados estava como produtos, portanto a necessidade de especificar produto_id.


2. Fornecedor e Item (1:N)
   	Um Fornecedor fornece produtos e itens. Logo, um Fornecedor tem, ou pode ter, vários Itens diferentes.  

	```php (Arquivo Fornecedor.php)

			public function itens() {
					return $this->hasMany(Item::class, 'fornecedor_id', 'id');
					//     $this->hasMany(Item::class, 'foreign_key'  , 'id');
			}

	```

3. Item e Fornecedor (N:1)
   	Relação inversa da verificada acima. A partir do Item, verifica-se que vários Itens podem pertencem a apenas um Fornecedor. A relação é complementar: todo relacionamento 1:N gera um N:1 no outro objeto.

	```php (Arquivo Item.php)

			public function fornecedor() {
					return $this->belongsTo(Fornecedor::class);
			}

	```


4. Item e Pedidos  (N:N)
		O pedido pode conter N produtos distintos. 
		Por outro lado, o produto pode estar contido em N pedidos distintos.

		Essa relação de aparente independência entre as duas classes pode ser expressa por uma relação do tipo N:N.

		Quando há necessidade de conectar as classes em registros em uma tabela organizada, é ideal definir uma relação entre os objetos e sempre que estiverem conectados, incluir na tabela.  
		
		Assim, o pedido 30 possui correlação com produtos de ID 3, 5 e 11.
		Por outro lado, o produto 11 está contido nos pedidos 12, 21 e 30.
		
		Cada relação regitrada na tabela de pedidos_produtos (N:N) possui um ID, de modo que para resgatar todos os itens do Pedido 30, é necessária uma query.

	```php (Arquivo Item.php)
		public function pedidos() {
				return $this->belongsToMany(Pedido::class, 'pedidos_produtos', 'produto_id' , 'pedido_id');
		}
	```

	```php (Arquivo Pedido.php)
	  
		public function itens() {
        return $this->belongsToMany(Item::class, 'pedidos_produtos','pedido_id', 'produto_id')
                ->withPivot('id','created_at', 'updated_at');
    }

	```

		Comentário adicional: o withPivot permite estabelecer que mesmo que a relação seja aparentemente igual (pode-se adicionar novamente ou até editar itens), a tabela é definida por seu ID e timestamps, de modo que a pessoa pode readicionar ou alterar o ID da relação, mas sempre há registro de quando ocorreu.
