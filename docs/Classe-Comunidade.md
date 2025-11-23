# Classe Comunidade
[⬅️ Voltar à página principal](../README.md)

Esta classe é uma abstração de uma entidade do mundo real, como um grupo social ou fórum online.

O propósito central da classe é gerenciar os dados e comportamentos associados a uma comunidade virtual, incluindo seu nome, a lista de membros (Pessoa) e a lista de comentários (Comentario).

---

    class Comunidade {
    
        private string $nome;
        private array $membros = [];        
        private array $comentarios = [];

Criação da classe comunidade e dos atributos, nome, membros e comentários.

---

    public function __construct(string $nome){
            $this->nome = $nome;
        }

Criação da função *construct*, que recebe o nome do usuário.

---

    public function adicionarMembro(Pessoa $membro): void{
            $this->membros[] = $membro;
        }

Criação do método *adicionarMembro* que adiciona um usuário a lista de membros.

---

    public function setNome(string $nome): void{
            $this->nome = $nome;
        }

Criação da função *setNome* que atribui o nome recebido a variável *nome*.

---

    public function removerMembro(Pessoa $membro): void{
            foreach ($this->membros as $index => $u) {
                if ($u === $membro) {
                    unset($this->membros[$index]);
                    $this->membros = array_values($this->membros);
                    break;
                }
            }
        }

Criação da função *removerMembro*, a função recebe uma pessoa e para cada usuário que for um membro o programa faz a verificação se é do mesmo tipo e se tem a mesma informação, caso seja verdade o programa remove o usuário da lista de membros e reenumera a lista.

---

    public function adicionarComentario(Comentario $comentario): void{
            $this->comentarios[] = $comentario;
        }

Criação da função *adicionarComentario*, a função recebe um comentário e adiciona ele a lista de comentários.

---

    public function removerComentario(Comentario $comentario): void {
            $chave = array_search($comentario, $this->comentarios, true);
            if ($chave !== false) {
                unset($this->comentarios[$chave]);
                $this->comentarios = array_values($this->comentarios); 
            }
        }

Criação da função *removerComentario*.

A função recebe um objeto *Comentario*, procura esse comentário na lista de comentários com *array_search*.

Se encontrar, remove do array usando *unset()* e reorganiza os índices com *array_values()*.

---

    public function exibirListaDeComentarios(): void{
            if (empty($this->comentarios)) {
                echo "Nenhum comentário disponível.\n";
                return;
            }

        echo "Comentários da comunidade '{$this->nome}':\n";
        foreach ($this->comentarios as $c) {
            if ($c instanceof Comentario) {
                echo "- [" . $c->getDataFormatada() . "] " . 
                     $c->getAutor()->getNome() . ": " . 
                     $c->getTexto() . "\n";
            }
        }
    }

A função verifica se há comentários cadastrados.

Se não houver, exibe uma mensagem informando que não existem comentários.

Se houver, percorre a lista de comentários e exibe, para cada um, a data formatada, o nome do autor e o texto do comentário.

---

    public function exibirListaDeUsuarios(): void{
            if (empty($this->membros)) {
                echo "Nenhum usuário inserido.\n";
                return;
            }

        echo "Usuários da comunidade '{$this->nome}':\n";
        foreach ($this->membros as $u) {
            echo "- " . $u->getNome() . "\n";
        }
    }

Criação da função *exibirListaDeUsuarios*.

A função verifica se há usuários (membros) cadastrados.

Se não houver, exibe uma mensagem informando que não existem usuários.

Se houver, percorre a lista de usuários e mostra o nome de cada um.

---

    public function editarJogo(string $titulo, string $descricao, int $ano, Categoria $categoria): void {
           $this->setTitulo($titulo);
           $this->setDescricao($descricao);
           $this->setAno($ano);
           $this->setCategoria($categoria);

Criação da função *editarJogo*.

A função recebe novos valores para título, descrição, ano e categoria de um jogo.

Ela atualiza os dados do objeto atual chamando os métodos *setTitulo(), setDescricao(), setAno() e setCategoria()* com os novos valores recebidos.
