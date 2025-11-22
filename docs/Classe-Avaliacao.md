# Classe Avaliação
[⬅️ Voltar à página principal](../README.md)

A classe Avaliacao atua como uma estrutura de dados ou modelo que conecta um avaliador ( Avaliador), um jogo ( Jogo) e os detalhes específicos da avaliação (pontuação/ notae recomendação/ recomenda).

---

No início do código, o *namespace Unimar\Poo;* é declarado, visto que o código está organizado dentro deste namespace para evitar conflitos de nomes com outras classes existentes e organiza o código.

Já as instruções *use Unimar\Poo\Class* é um comando para importar as classes necessárias para que a classe Avaliador possa interagir com elas (como criar/manipular objetos do tipo Jogo e Avaliação).

A classe possui quatro propriedades privadas, o que significa que elas só podem ser acessadas ou modificadas diretamente de dentro da Avaliação/própria classe:
| PROPRIEDADE | TIPO | DESCRIÇÃO |
| ----------- | ---- | :-------: |
| avaliador | Avaliador | O objeto que representa o avaliador que fez a avaliação. |
| jogo | Jogo | O objeto que representa o jogo que foi analisado. | 
| nota | float | A pontuação ou classificação atribuída ao jogo (ex.: 8,5, 9,0). | 
| recomenda | bool | Um valor booleano ( trueverdadeiro ou falso false) que indica se o avaliador recomenda o jogo. |

Utilizando o método *public function __construct(Avaliador $avaliador, Jogo $jogo, float $nota, bool $recomenda)*, ele inicializa todas as propriedades privadas com os valores passados ​​como argumentos, garantindo que cada objeto de avaliação seja criado em um estado válido com todos os dados necessários quando uma nova instância do tipo **Avaliação** é criada.

---

**Métodos**

Os métodos públicos proporcionam acesso controlado às propriedades privadas.

Os Getters (Acessores) permitem que o usuário leia o valor de uma propriedade privada de fora da classe.
- *getAvaliador(): Avaliador*: Retorna o Avaliadorobjeto.
- *getJogo(): Jogo*: Retorna o Jogoobjeto.
- *getNota(): float*: Retorna a pontuação/classificação.
- *getRecomenda(): bool* Retorna o status da recomendação.

Já os Setters (Mutadores) permitem modificar o valor de uma propriedade privada de fora da classe.
- *setNota(float $nota): void:* Define um novo valor para a pontuação/classificação.
- *setRecomenda(bool $recomenda): void*: Define um novo status de recomendação.
