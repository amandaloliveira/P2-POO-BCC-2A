# Classe Jogo
[⬅️ Voltar à página principal](../README.md)

A classe Jogo é uma classe que permite a criação da instância **Jogo**, além de realizar algumas funções, como receber uma avaliação e calcular a média de notas de determinado jogo.

---

No início do código, o *namespace Unimar\Poo;* é declarado, visto que o código está organizado dentro deste namespace para evitar conflitos de nomes com outras classes existentes e organiza o código.

Já as instruções *use Unimar\Poo\Class* é um comando para importar as classes necessárias para que a classe Jogo possa interagir com elas (como criar/manipular objetos do tipo Categoria e Avaliação).

Os atributos privados (propriedades) que definem o estado de um objeto Jogo são:

| PROPRIEDADE | TIPO | DESCRIÇÃO |
| ----------- | ---- | :-------: |
| titulo | string | O nome do jogo. |
| descricao | string | Um breve resumo sobre o jogo. | 
| ano | int | O ano de lançamento do jogo. |
| avaliacoes | array | Uma lista de objetos do tipo Avaliacao recebidos (inicialmente vazia). |
| mediaDeAvaliacoes | float | A média das notas dadas nas avaliações (inicialmente$0.0$). | 
| categoria | Categoria | Um objeto Categoria ao qual o jogo pertence (ex: Ação, RPG). |

---

    public function __construct(string $titulo, string $descricao, int $ano, Categoria $categoria)
        {
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->ano = $ano;
            $this->categoria = $categoria;
        }

O construtor é chamado ao criar um novo objeto Jogo. Ele exige que você forneça o título, descrição, ano de lançamento e o objeto categoria para inicializar o jogo.

---

**Getters e Setters**

    public function getTitulo(): string {
            return $this->titulo;
        }
    public function getDescricao(): string {
        return $this->descricao;
    }
    public function getAno(): int {
        return $this->ano;
    }
    public function getCategoria(): Categoria {
        return $this->categoria;
    }
    public function getMediaDeAvaliacoes(): float {
        return $this->mediaDeAvaliacoes;
    }
    
    public function setTitulo(string $titulo): void {
        if (empty(trim($titulo))){
            echo "ERRO: O título não pode ser vazio.\n";
            return;
        }
        $this->titulo = $titulo;
    }
    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }
    public function setAno(int $ano): void {
        if ($ano < 1800 || $ano > date('Y') + 5){
            echo "AVISO: O ano inserido aparenta ser uma informação duvidosa, mas será salvo mesmo assim.\n";
        }
        $this->ano = $ano;
    }
    public function setCategoria(Categoria $categoria): void {
        $this->categoria = $categoria;
    }

Estes métodos públicos permitem ler (get) e modificar (set) os atributos privados, garantindo o princípio de Encapsulamento.

- *get...()*: Métodos como *getTitulo()* e *getMediaDeAvaliacoes()* retornam os valores atuais das propriedades.
- *set...()*: Métodos como *setTitulo() e setAno()* permitem alterar propriedades. Observe que o *setTitulo()* tem uma validação básica para garantir que o título não seja vazio. O setAno()exibe um aviso se o ano parecer suspeito, mas ainda o armazena.

---

**Gerenciamento de Avaliações**

Estes métodos lidam com a relação entre o Jogo e suas Avaliacaos.

    public function receberAvaliacao(Avaliacao $avaliacao): void
        {
            $this->avaliacoes[] = $avaliacao;
            $this->calcularMediaAvaliacoes();
        }

Adiciona um novo objeto Avaliacao ao array $avaliacoes.

Chama automaticamente o método calcularMediaAvaliacoes() para atualizar a média do jogo.

    public function removerAvaliacao(Avaliacao $avaliacaoParaRemover): void
        {
            foreach ($this->avaliacoes as $key => $avaliacao) {
                if ($avaliacao === $avaliacaoParaRemover) {
                    unset($this->avaliacoes[$key]);
                    break;
                }
            }
            $this->avaliacoes = array_values($this->avaliacoes);
            $this->calcularMediaAvaliacoes();
        }

Percorre o array $avaliacoes procurando a avaliação específica a ser removida (comparação de objetos ===).

Remove a avaliação encontrada usando unset().

Usa array_values() para reindexar o array após a remoção (tornando as chaves numéricas sequenciais novamente).

Chama calcularMediaAvaliacoes() para recalcular a média.

    public function calcularMediaAvaliacoes(): void
        {
            $totalNotas = 0;
            $numeroDeAvaliacoes = count($this->avaliacoes);
    
            if ($numeroDeAvaliacoes === 0) {
                $this->mediaDeAvaliacoes = 0.0;
                return;
            }
    
            foreach ($this->avaliacoes as $avaliacao) {
                $totalNotas += $avaliacao->getNota();
            }
    
            $this->mediaDeAvaliacoes = $totalNotas / $numeroDeAvaliacoes;
        }

Verifica se há avaliações. Se não houver, $mediaDeAvaliacoes é definida como $0.0$.

Se houver avaliações, itera sobre elas, somando todas as notas (usando $avaliacao->getNota()).

Calcula a média, dividindo a soma total pelo número de avaliações, e armazena o resultado na propriedade $mediaDeAvaliacoes.

---

**Métodos Utilitários**

    public function editarJogo(string $titulo, string $descricao, int $ano, Categoria $categoria): void {
            $this->setTitulo($titulo);
            $this->setDescricao($descricao);
            $this->setAno($ano);
            $this->setCategoria($categoria);
        }

Este método facilita a atualização de todas as informações básicas do jogo de uma só vez, reutilizando os setters existentes.

    public function exibirDetalhes(): void
        {
            echo "\n---------------- Ficha do Jogo ----------------\n";
            echo "Nome: " . $this->getTitulo() . "\n";
            echo "Descrição: " . $this->getDescricao() . "\n";
            echo "Categoria: " . $this->categoria->getNome() . "\n";
            echo "Ano de Lançamento: " . $this->getAno() . "\n";
            echo "Média de Avaliações: " . number_format($this->mediaDeAvaliacoes, 2) . "\n";
            echo "-----------------------------------------------\n";
        }

Imprime no console um resumo formatado das informações do jogo, incluindo o nome da categoria (obtido via $this->categoria->getNome()) e a média de avaliações formatada com duas casas decimais.
