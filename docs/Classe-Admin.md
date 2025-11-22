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

Esta é uma cçasse que não possui atributos próprios declarados no corpo do nosso código, sendo inicialiados através de um método Construtor. Na verdade, a classe Admin utiliza os atributos definidos na sua classe mãe (Pessoa).

**Métodos**
