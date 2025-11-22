# Classe Avaliador
[⬅️ Voltar à página principal](../README.md)

A classe Avaliador é a classe filha da classe mãe Pessoa.

Esta classe é uma entidade do sistema que tem a capacidade de avaliar jogose interagir com outros elementos, como jogos favoritos e comunidades.

---

No início do código, o *namespace Unimar\Poo;* é declarado, visto que o código está organizado dentro deste namespace para evitar conflitos de nomes com outras classes existentes e organiza o código.

E, ao declarar a classe Avaliador, ela é declarada como *class Avaliador extends Pessoa*. Isso destaca que a classe Avaliador herda o conteúdo da classe Pessoa. Isto se caracteriza como uma relação de Herança, estabelecendo que um Avaliador é uma Pessoa, herdando os atributos e métodos contidos em Pessoa, permitindo a reutilização de código.

Já as instruções *use Unimar\Poo\Class* é um comando para importar as classes necessárias para que a classe Avaliador possa interagir com elas (como criar/manipular objetos do tipo Jogo, Pessoa, Comentário, Comunidade e Avaliação).

A classe Avaliador define três atributos privados, aplicando o princípio do Encapsulamento ao restringir o acesso direto a eles. O acesso e a modificação desses dados devem ser feitos exclusivamente através dos métodos públicos (Getters e Setters, quando aplicáveis).

| ATRIBUTO | TIPO | DESCRIÇÃO | PRINCÍPIO POO |
| -------- | ---- | --------- | :-----------: | 
| $minhasAvaliacoes | private array | Armazena as instâncias da classe Avaliacao criadas por este avaliador | Encapsulamento |
| $jogosFavoritos | private array | Armazena instâncias da classe Jogo que este avaliador marcou como favoritas. A indexação é feita pelo título do jogo | Encapsulamento|
| $comunidades | private array | Armazena as instâncias da classe Comunidade nas quais o avaliador é membro | Encapsulamento |

---

**Métodos**

***A. Gerenciamento de Avaliações (Relação com Jogo e Avaliacao)***
| MÉTODO | RETORNO | DESCRIÇÃO | PRINCÍPIO POO |
| ------ | ------- | --------- | :-----------: |
| avaliarJogo(Jogo $jogo, float $nota, bool $recomenda) | ?Avaliacao | Cria uma nova Avaliacao para um Jogo específico, com nota e recomendação. Impede avaliações duplicadas para o mesmo jogo. Adiciona a avaliação à lista do avaliador e notifica o objeto Jogo sobre a nova avaliação ($jogo->receberAvaliacao()) | Abstração/Composição |
| editarAvaliacao(Avaliacao $avaliacao, float $novaNota, bool $novoRecomenda) | void | Permite alterar a nota e recomendação de uma avaliação existente, apenas se for uma avaliação feita pelo próprio avaliador. Após a edição, dispara o recálculo da média do jogo. | Encapsulamento |
| excluirAvaliacao(Avaliacao $avaliacao) | void | Remove a avaliação da lista do avaliador e notifica o Jogo para que remova a avaliação de seu registro. Verifica a propriedade da avaliação | Encapsulamento |
| getMinhasAvaliacoes() | array | Retorna a lista de todas as avaliações feitas pelo avaliador. (Getter) | Encapsulamento |
| limparAvaliacoesDeJogoExcluido(Jogo $jogoExcluido) | void | Método de manutenção que remove todas as avaliações feitas por este avaliador que se referiam a um Jogo que foi excluído do sistema (pode ter sido acionado por outro objeto). | Abstração/Manutenção |

***B. Gerenciamento de Jogos Favoritos (Relação com Jogo)***
| MÉTODO | RETORNO | DESCRIÇÃO |
| ------ | ------- | :-------: |
| adicionarJogoFavorito(Jogo $jogo) | void | Adiciona um jogo à lista de favoritos, prevenindo duplicatas através da verificação do título. |
| removerJogoFavorito(Jogo $jogo) | void | Remove um jogo da lista de favoritos, se ele estiver presente. |
| getJogosFavoritos() | array | Retorna a lista de jogos favoritos. |
| limparJogoExcluido(Jogo $jogoExcluido) | void | Método de manutenção para remover um jogo da lista de favoritos, caso ele tenha sido excluído do sistema. |

***C. Gerenciamento de Comunidades e Comentários***
| MÉTODO | RETORNO | DESCRIÇÃO | PRINCÍPIO POO |
| ------ | ------- | --------- | :-----------: |
| entrarComunidade(Comunidade $comunidade) | bool | Adiciona o avaliador a uma Comunidade e notifica a Comunidade para que adicione o avaliador como membro. Previne a entrada duplicada. |Abstração/Acoplamento |
| sairComunidade(Comunidade $comunidade) | bool | Remove o avaliador de uma Comunidade e notifica a Comunidade para remover o membro. | Abstração/Acoplamento |
| publicarComentario(Comunidade $comunidade, string $texto) |  void | Permite publicar um novo Comentario na Comunidade, desde que o avaliador seja membro dela. Lança uma exceção em caso contrário (Boa Prática). | Abstração |
| editarComentario(Comentario $comentario, string $novoTexto) | bool | Permite editar o texto de um Comentario, apenas se o avaliador for o autor original ($comentario->getAutor() === $this). | Encapsulamento |
| excluirComentario(Comunidade $comunidade, Comentario $comentario) | bool | Permite excluir um Comentario de uma Comunidade, apenas se o avaliador for o autor. | Encapsulamento |
| getMinhasComunidades() | array | Retorna a lista de comunidades do qual o avaliador é membro. | Encapsulamento |
| limparComunidadeExcluida(Comunidade $comunidadeExcluida) | void | Método de manutenção para remover uma Comunidade da lista, caso ela tenha sido extinta. | Abstração/Manutenção |

***D. Polimorfismo***
| MÉTODO | RETORNO | DESCRIÇÃO | PRINCÍPIO POO |
| ------ | ------- | --------- | :-----------: |
| seApresentar() | string | Sobrescreve o método seApresentar() da classe pai (Pessoa). Ele chama a implementação do método pai (parent::seApresentar()) e adiciona a especialização de "Perfil de Crítico de Jogos". | olimorfismo (Sobrescrita) |

