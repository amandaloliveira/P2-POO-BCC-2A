# Classe Admin
[⬅️ Voltar à página principal](../README.md)

A classe Admin é a classe filha da classe mãe Pessoa.

Esta classe é uma entidade do sistema responsável por executar operações de administração e gestão de conteúdo, sendo o principal ponto de controle para a manipulação de jogos, categorias e comunidades, otimizando o ambiente.

A atualização desta classe acarretou nas alterações de outras classses relacionadas, como a classe Categoria, Comunidade, Jogo e Avaliador.

Em **Categoria**, foi adicionado o método de remover o objeto do tipo Jogo de dentro da lista de jogos da comunidade e do registro dos usuários. 

Em **Comunidade**, foi declarado que os métodos *adicionarUsuario()* e *removerUsuario()* devem adicionar/remover um objeto do tipo Pessoa.

Em **Jogo**, foi adicionado o método *getCategoria()* para que as alterações das categorias fossem realizadas pelo Admin respeitando o encapsulamento.

Em **Avaliador**, foi adicionado o método *limparJogoExcluido* que, ao ser implementado no index, chama esta função para limpar da lista de jogos favoritos, o jogo em que o Admin deseja apagar.

Essas e outras alterações serão detalhadas em suas respectivas classes.

---

No início do código, o *namespace Unimar\Poo;* é declarado, visto que o código está organizado dentro deste namespace para evitar conflitos de nomes com outras classes existentes e organiza o código.

E, ao declarar a classe Admin, ela é declarada como *class Admin extends Pessoa*. Isso destaca que a classe Admin herda o conteúdo da classe Pessoa. Isto se caracteriza como uma relação de Herança, estabelecendo que um Admin é uma Pessoa, herdando os atributos e métodos contidos em Pessoa, permitindo a reutilização de código.

Já as instruções *use Unimar\Poo\Class* é um comando para importar as classes necessárias para que a classe Admin possa interagir com elas (como criar/manipular objetos do tipo Jogo, Pessoa, Categoria e Comunidade).

Esta é uma classe que não possui atributos próprios declarados no corpo do nosso código, sendo inicialiados através de um método Construtor. Na verdade, a classe Admin utiliza os atributos definidos na sua classe mãe (Pessoa).

**Métodos**
| MÉTODO               |   FUNÇÃO  | RETORNO |
| -------------------- | --------- | :-----: |
| adicionarJogo()      | Cria uma nova instância de Jogo, adiciona-o no arrya de *$jogos* e a associa à *$categoria* informada | Jogo    |
| editarJogo()         | Modifica os dados (nome, descrição, ano) de um objeto Jogo existente. Se a Categoria mudar, garante a remoção da categoria antiga e a adição à nova, mantendo a integridade dos dados | void    |
| removerJogo()        | Remove o objeto Jogo do array principal e, crucialmente, da Categoria associada, evitando inconsistências. Utiliza os comandos *array_search* e *unset* | void    |
| adicionarCategoria() | Cria uma nova Categoria, usando uma *$chave* para indexar no array de *$categorias*. Além disso, também verifica se a chave já existe para evitar a duplicação | bool    |
| editarCategoria()    | Atualiza o nome de um objeto Categoria existente, chamando um *setter* na classe Categoria | void    |
| excluirCategoria()   | Remove uma Categoria do array *$categorias* pela sua chave | void    |
| criarComunidade()    | Instancia e adiciona um novo objeto Comunidade ao array | void    |
| editarComunidade()   | Atualiza o nome de uma Comunidade existente | void    |
| excluirComunidade()  | Percorre o array para encontrar e remover o objeto Comunidade passado como parãmetro. Reindexa o array usando o comando *array_values*  | void    |
| seApresentar()       | Sobrescreve um método que provavelmente existe na classe Pessoa. Este é um exemplo de polimorfismo por sobrescrita: o Admin implementa a sua própria versão de como se apresentar | string  |
