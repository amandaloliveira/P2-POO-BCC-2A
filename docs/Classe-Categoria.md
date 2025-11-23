# Classe Categoria
[⬅️ Voltar à página principal](../README.md)

A classe categoria [...].

---

1. **Criação da Classe Categoria**

Foi desenvolvida uma nova classe responsável por representar as categorias no sistema. Esta classe atua como um contêiner lógico, possuindo um atributo para o nome e uma lista interna (array) para armazenar as referências aos objetos Jogo associados a ela. Foram implementados métodos para recuperar essa lista e para adicionar novos jogos, garantindo o encapsulamento dos dados.

    private string $nome;
    private array $jogos = [];

    public function __construct(string $nome){
        $this->nome = $nome;
    }

Possui dois atributos privados, sendo uma string *$nome* e um array *$jogos*.

Para a inicialização de um objeto Categoria, precisamos apenas de seu nome (que é indicado como parâmetro no método construtor).

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }
    
    public function getJogos(): array{
        return $this->jogos; 
    }

Possui *getters e setters* para o acesso e/ou modificação dos atributos privados presentes na classe Categoria.
- *getNome*: Retorna uma variável *$nome* do tipo *string*.
- *getJogos*: Retorna uma variável *$jogos* do tipo *array*.
- *setNome*: Define uma variável *$nome* do tipo *string*.

      public function adicionarjogo(jogo $jogo): void{
        $this->jogos[] = $jogo;
      }

      public function removerJogo(Jogo $jogo): void{
        $jogoParaRemover = array_search($jogo, $this->jogos, true);
        
        if ($jogoParaRemover !== false) {
            unset($this->jogos[$jogoParaRemover]);
            $this->jogos = array_values($this->jogos); 
        }
      }

Também são definidos dois métodos na classe:
- *adicionarJogo*: Utiliza como parâmetro um objeto do tipo Jogo para adicioná-lo ao array *$jogos*.
- *removerJogo*: Remove um objeto Jogo do array $jogos. Utiliza array_search com comparação estrita (true) para encontrar a posição do objeto e, se encontrado, usa unset para removê-lo, seguido por array_values para reindexar o array e manter a integridade da lista. 

---

2. **Refatoração da Classe Jogo**

A classe Jogo sofreu alterações estruturais para suportar o relacionamento com as categorias. Inicialmente, a lógica previa a definição da categoria via construtor. No entanto, para permitir maior flexibilidade (como a possibilidade de um jogo pertencer a múltiplas categorias ou ter sua categoria definida posteriormente), removemos a dependência do método construtor. Em seu lugar, implementamos uma lista interna de categorias e o método **adicionarCategoria**. Isso alterou a natureza da relação para uma associação mais flexível, onde o objeto Jogo pode existir independentemente de estar categorizado no momento de sua criação. Também foi atualizado o método de exibição de detalhes para listar dinamicamente as categorias vinculadas.

---

3. **Ajustes na Classe Admin**

Como consequência da alteração na classe Jogo, o método **adicionarJogo** da classe Admin foi simplificado. Ele deixou de exigir o parâmetro de categoria no momento da instanciação do jogo. Agora, o administrador cria o jogo apenas com seus dados básicos (título, descrição e ano), delegando a associação de categoria para uma etapa posterior.

---

4. **Integração e Lógica no index.php**

O arquivo principal foi reestruturado para gerenciar o fluxo dessas novas entidades:
   
- **Inicialização**: A ordem de instanciação foi ajustada. As categorias são instanciadas primeiro, seguidas pelos jogos. A associação entre eles é feita através de métodos específicos (adicionarJogo na categoria e adicionarCategoria no jogo), garantindo a consistência dos dados em ambas as pontas da relação.

- **Estrutura de Controle**: O controle de fluxo do login foi unificado em uma estrutura condicional única (if/elseif), corrigindo problemas anteriores onde os menus de Administrador e Avaliador poderiam entrar em conflito lógico.

- **Interface do Administrador**: O menu do administrador recebeu uma nova funcionalidade dedicada: "Associar Jogo a Categoria". Isso separa a responsabilidade de criar o registro da responsabilidade de classificá-lo, permitindo um gerenciamento mais granular pelo usuário. O sistema agora lista as opções disponíveis e realiza a vinculação entre os objetos selecionados em tempo de execução.
