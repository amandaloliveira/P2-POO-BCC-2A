# Classe Pessoa
[⬅️ Voltar à página principal](../README.md)

A classe Pessoa representa a essência de uma "pessoa" no sistema, omitindo detalhes específicos de subclasses (como seus atributos e métodos) e focando apenas nos atributos e comportamentos essenciais e comuns.

Nesta classe, a **Abstração** e o **Encapsulamento** foram implementadas.

---

A classe Pessoa possui três atributos que representam o estado de um objeto, cada um com um modificador de acesso específico:

| ATRIBUTO   |    TIPO   | DESCRIÇÃO                                                                                                                                     |                 PRINCÍPIO   |
| ---------- | :-------: | --------------------------------------------------------------------------------------------------------------------------------------------- | :-------------------------: |
| nome       |  string   | Nome da pessoa. Seu acesso é permitido apenas pela própria classe e classes que a herdam.                                                     |  Encapsulamento e Herança   |
| email      |  string   | Email da pessoa. Seu acesso é permitido apenas pela própria classe e classes que a herdam.                                                    |  Encapsulamento e Herança   |
| senha      |  string   | Senha da pessoa. Seu acesso é estritamente privado, limitado apenas à própria classe Pessoa. Classes filhas não podem acessá-lo diretamente.  |  Encapsulamento             |

Ademais, a classe Pessoa define diversos métodos para inicializar, acessar, modificar e controlar o estado dos atributos, reforçando o Encapsulamento.

Em seu método construtor, os atributos *nome, email* e *senha* são inicializados no momento da criação do objeto, assim como correspondem também aos parâmetros.

Além disso, no decorrer do código são criados métodos de acesso (*Getters e Setters*), onde é permitida a leitura (*get*) e a modificação (*set*) controlada dos atributos privados e protegidos da classe:

| MÉTODO                     |    TIPO   | RETORNO    |              DESCRIÇÃO               |
| -------------------------- | --------- | ---------- | :----------------------------------: |
| getNome()                  |  getter   | string     |  Retorna o valor do atributo *$nome* |
| setNome(string $nome)      |  setter   | void       |  Define o valor do atributo *$nome*  |
| getEmail()                 |  getter   | string     | Retorna o valor do atributo *$email* |
| setEmail(string $email)    |  setter   | void       | Define o valor do atributo *$senha*  |
| setSenha(string $senha)    |  setter   | void       |  Define o valor do atributo *$senha* |

*OBS: Nos métodos ***setNome(string $nome), setEmail(string $email) e setSenha(string $senha)***, existe alguns pontos implementados. Em ***setNome(string $nome) e setEmail(string $email)***, são aplicadas as funções ***trim()***, para remover os espaços em branco no início e fim do valor. Já em ***setSenha(string $senha)***,  foi implementada uma regra de validação simples, onde a senha só é definida e registrada se tiver um comprimento de 4 ou mais caracteres.*

Além disso, temos métodos de comportamento específico:

- ***verificarSenha(string $senha)***

Este método compara a string se senha fornecida com o valor armazenado no atributo privado, retornando *true* se forem idênticas. Mas, se o caso for contrário, é retornado *false*.

- ***seApresentar()***

Este método retorna uma string formatada contendo o nome e o email da pessoa. Porém, este método representa um comportamento básico da classe, permitindo ser sobrescrito em classes filhas (Admin e Avaliador) para apresentar informações mais específicas de si, aplicando-se o conceito de um dos pilares da Programação Orientada à Objetos: o **Polimorfismo**.
