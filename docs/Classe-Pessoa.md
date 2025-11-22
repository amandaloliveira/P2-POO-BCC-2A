# Classe Pessoa
[⬅️ Voltar à página principal](../README.md)

A classe Pessoa representa a essência de uma "pessoa" no sistema, omitindo detalhes específicos de subclasses (como seus atributos e métodos) e focando apenas nos atributos e comportamentos essenciais e comuns.

Nesta classe, a **Abstração** e o **Encapsulamento** foram implementadas.

---

A classe Pessoa possui três atributos que representam o estado de um objeto, cada um com um modificador de acesso específico:

| ATRIBUTO   |    TIPO   | DESCRIÇÃO   |    PRINCÍPIO   |
| ---------- | :-------: | ----------- | :------------: |
| nome       |  string   | Nome da pessoa. Seu acesso é permitido apenas pela própria classe e classes que a herdam.       |  Encapsulamento e Herança  |
| email      |  string   | Email da pessoa. Seu acesso é permitido apenas pela própria classe e classes que a herdam.      |  Encapsulamento e Herança   |
| senha      |  string   | Senha da pessoa. Seu acesso é estritamente privado, limitado apenas à própria classe Pessoa. Classes filhas não podem acessá-lo diretamente.      |  Encapsulamento     |

Ademais, a classe Pessoa define diversos métodos para inicializar, acessar, modificar e controlar o estado dos atributos, reforçando o Encapsulamento.

Em seu método construtor, os atributos *nome, email* e *senha* são inicializados no momento da criação do objeto, assim como correspondem também aos parâmetros.

Além disso, no decorrer do código são criados métodos de acesso (*Getters e Setters*), onde é permitida a leitura (*get*) e a modificação (*set*) controlada dos atributos privados e protegidos da classe:

| MÉTODO   |    TIPO   | RETORNO   |    DESCRIÇÃO   |
| ---------- | ------- | ----------- | :------------: |
| getNome()       |  1   | 1       |  1  |
| setNome(string $nome)      |  1   | 1     |  1   |
| getEmail()      |  1   | 1     |  1     |
| setEmail(string $email)      |  1   | 1     |  1     |
| setSenha()      |  1   | 1     |  1     |

