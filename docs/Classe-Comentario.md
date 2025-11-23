# Classe Comentário
[⬅️ Voltar à página principal](../README.md)

A classe *Comentario* atua como uma estrutura de dados ou modelo que conecta um avaliador ( Avaliador), uma comunidade (Comunidade) e os detalhes específicos do comentário (autor, texto e data).

---

A estrutura apresentada define a classe Comentario, pertencente ao namespace Unimar\Poo. O objetivo principal desta classe é modelar e representar um comentário individual dentro de uma aplicação (como um blog, fórum ou sistema de interação social).

Esta classe encapsula as informações essenciais que definem um comentário, sendo estas: quem o escreveu, o conteúdo textual e quando foi criado.

A classe Comentario possui três atributos de instância, todos definidos como privados (private), garantindo a integridade dos dados e o controle sobre seu acesso e modificação.
| ATRIBUTO | TIPO | MODIFICADOR | FUNÇÃO E OBSERVAÇÕES |
| -------- | ---- | ----------- | :------------------: | 
| $autor | Pessoa | Private | Armazena a referência ao objeto que representa o autor do comentário. A tipagem exige que seja uma instância da classe Pessoa, demonstrando Composição ou Associação entre objetos. |
| $texto | string | private | Armazena o conteúdo textual do comentário. |
| $data | \DateTime | private | Armazena a data e hora de criação do comentário. O type hint \DateTime usa a namespace global para a classe nativa de PHP. | 

---

**Métodos**

Os métodos definidos implementam as funcionalidades básicas para a criação, acesso e, em alguns casos, modificação controlada do estado do objeto.

    public function __construct(Pessoa $autor, string $texto) {
            $this->autor = $autor;
            $this->texto = $texto;
            $this->data = new \DateTime();
        }

*Função*: É o método especial invocado automaticamente no momento da instanciação de um novo objeto Comentario.

*Parâmetros*: Exige dois argumentos obrigatórios: uma instância de Pessoa para $autor e uma string para $texto.

*Ações*:
- Atribui os valores passados nos parâmetros às respectivas propriedades $this->autor e $this->texto.
- Instancia um novo objeto \DateTime() e o atribui à propriedade $this->data, registrando automaticamente a data e hora atual em que o comentário foi criado.

---

**Métodos**

    public function getAutor(): Pessoa {
            return $this->autor; 
        }

    public function getTexto(): string {
        return $this->texto;
    }

    public function setTexto(string $texto): void {
        $this->texto = $texto;
    }

    public function getDataFormatada(): string {
        return $this->data->format('d/m/Y H:i');
    }

    
Estes métodos (*getters*) permitem ler os valores dos atributos privados, aplicando o princípio de Encapsulamento.

- *public function getAutor(): Pessoa*: Retorna a instância da classe Pessoa que representa o autor.

- *public function getTexto(): string*: Retorna o conteúdo textual do comentário.

- *public function getDataFormatada(): string*: Retorna a data e hora armazenada em $this->data, porém, em um formato amigável (d/m/Y H:i), utilizando o método format da classe \DateTime.

Este método, o *setter*, permite modificar o valor de um atributo privado de forma controlada.

- *public function setTexto(string $texto): void*: Permite alterar o conteúdo do comentário após sua criação. O type hint de retorno void indica que o método não retorna nenhum valor.
