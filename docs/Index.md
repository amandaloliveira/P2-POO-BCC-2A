# Index
[⬅️ Voltar à página principal](../README.md)

O index simula um ambiente de console interativo onde diferentes tipos de usuários (Administradores e Avaliadores) podem gerenciar e interagir com jogos, categorias e comunidades.

O principal objetivo é demonstrar o uso dos quatro pilares da POO (Abstração, Herança, Polimorfismo e Encapsulamento), além de boas práticas de programação, através da estruturação de classes que representam as entidades do sistema.

---

A arquitetura do sistema é construída em torno de várias classes que se relacionam para modelar o domínio:

| CONCEITO POO | DESCRIÇÃO NO CÓDIGO |
| ------------ | :-----------------: | 
| Abstração |  A classe Pessoa abstrai as características comuns a todos os usuários (nome, email, senha). Classes como Jogo e Categoria focam apenas em suas responsabilidades essenciais. |
| Encapsulamento | Todos os atributos das classes (ex: $nome em Pessoa, $titulo em Jogo) são privados/protegidos e só podem ser acessados ou modificados através de métodos públicos (Getters e Setters, como getNome() e setNome()). Isso protege o estado interno dos objetos. |
| Herança | A classe Pessoa é a classe base. Admin e Avaliador herdam de Pessoa, adquirindo suas propriedades e métodos básicos (como verificarSenha()), mas adicionando comportamentos específicos (ex: adicionarJogo() para Admin, avaliarJogo() para Avaliador). |
| Polimorfismo | É evidente em como diferentes tipos de usuários se comportam: o método seApresentar() provavelmente existe na classe base Pessoa e é sobrescrito em Admin e Avaliador para fornecer uma saudação específica para cada tipo. A lógica de menu que utiliza instanceof Admin ou instanceof Avaliador para exibir menus diferentes também é uma forma de polimorfismo de inclusão. |

---

Embora as definições completas das classes não estejam no trecho fornecido (use Unimar\Poo\...), podemos inferir seus atributos e métodos principais com base no código de execução:

**1. Pessoa (Base - Abstração)**
- *Atributos (Início)*: $nome, $email, $senha
- *Métodos (Início)*: __construct(), getNome(), getEmail(), setNome(), verificarSenha($senha), seApresentar()

**2. Admin (Herda de Pessoa)**

- *Atributos (Inferidos)*: Os mesmos de Pessoa, e talvez $nivelAcesso.
- *Métodos Específicos (Comportamento de Gerenciamento)*:
   - *adicionarJogo()*: Adiciona um novo objeto Jogo a uma lista de jogos e associa-o a uma Categoria.
   - *removerJogo()*: Remove um Jogo da lista e inicia a limpeza de referências em Avaliador.
   - *criarComunidade(), editarComunidade(), excluirComunidade()*: Gerencia comunidades.
   - *adicionarCategoria(), editarCategoria(), excluirCategoria()*: Gerencia categorias.
     
**3. Avaliador (Herda de Pessoa)**
- *Atributos (Inferidos)*: Os mesmos de Pessoa, mais uma lista de $avaliacoes (objetos Avaliacao) e uma lista de $jogosFavoritos.
- *Métodos Específicos (Comportamento de Usuário):*
   - *avaliarJogo(Jogo $jogo, float $nota, bool $recomenda)*: Cria ou edita uma Avaliacao para um jogo.
   - *editarAvaliacao(), excluirAvaliacao()*: Gerencia as próprias avaliações.
   - *adicionarJogoFavorito(), removerJogoFavorito(), getJogosFavoritos()*: Gerencia a lista de favoritos.
   - *limparJogoExcluido()*: Método de "limpeza" chamado pelo Admin após a exclusão de um jogo.

**4. Jogo**
- *Atributos (Início)*: $titulo, $descricao, $ano (inteiro), $categoria (objeto Categoria), $avaliacoes (lista de objetos Avaliacao).
- *Métodos (Início)*: __construct(), getTitulo(), exibirDetalhes(), editarJogo().

**5. Categoria**
- *Atributos (Início)*: $nome, $jogos (lista de objetos Jogo).
- *Métodos (Início)*: __construct(), getNome(), adicionarJogo(), getJogos().

**6. Comunidade**
- *Atributos (Início)*: $nome.
- *Métodos (Início)*: __construct(), getNome(), e métodos para interação (implícitos no menu, como adicionarMembro, postarComentario, etc.).

**7. Avaliacao (Implícita)**
- *Atributos (Inferidos)*: $jogo (objeto Jogo), $avaliador (objeto Avaliador), $nota (float), $recomenda (boolean).
- *Métodos (Início)*: getNota(), getRecomenda(), setNota(), setRecomenda().

---

O código principal (<?php ...) simula o ponto de entrada da aplicação e é dividido em três etapas principais:

**1. Inicialização (Setup)**

*Inclusão de Classes*: require_once 'vendor/autoload.php'; carrega as classes via Autoloading (padrão de boas práticas). Além de indicar importação das classes através do comando *use\Unimar\Poo\Class*.

    require_once 'vendor/autoload.php';
    
    use Unimar\Poo\Admin;
    use Unimar\Poo\Avaliador;
    use Unimar\Poo\Jogo;
    use Unimar\Poo\Pessoa;
    use Unimar\Poo\Categoria;
    use Unimar\Poo\Comunidade;

---

*Criação de Entidades Base*:

Arrays globais ($usuarios, $categorias, $jogos, $comunidades) são criados para armazenar os objetos.

Instanciação: Objetos iniciais são criados para demonstração:
- Um Admin e um Avaliador são criados e armazenados no array $usuarios (utilizando o email como chave, simulando um banco de dados).
  
      $usuarios = [];
      $usuarios["admin@email.com"] = new Admin("Admin Mestre", "admin@email.com", "12345");
      $usuarios["avaliador@email.com"] = new Avaliador("Avaliador", "avaliador@email.com", "1234");

- Várias Categorias, Jogos e Comunidades são instanciados.

      $categorias = [];
      $categorias['aventura'] = new Categoria("Aventura");
      $categorias['acao'] = new Categoria("Ação");
      $categorias['terror'] = new Categoria("Terror");
      $categorias['indie'] = new Categoria("Indie");
      
      $jogos = [];
      $jogos[0] = new Jogo("Sally Face", "Aventuras sinistras...", 2016, $categorias['aventura']);
      $jogos[1] = new Jogo("Nine Souls", "Jogo de ação-plataforma 2D", 2024, $categorias['acao']);
      $jogos[2] = new Jogo("Katana Zero", "Jogo de plataforma...", 2019, $categorias['acao']);
      
      $comunidades = [];
      $comunidades[0] = new Comunidade ("Amantes do Terror");
      $comunidades[1] = new Comunidade ("Aventureiros.com");

Associações: Jogos são adicionados às suas respectivas categorias (ex: $categorias['aventura']->adicionarJogo($jogos[0]);).

    $categorias['aventura']->adicionarJogo($jogos[0]);
    $categorias['acao']->adicionarJogo($jogos[1]);
    $categorias['acao']->adicionarJogo($jogos[2]);

Ação Inicial de Exemplo: O $avaliador faz uma avaliação inicial no jogo "Sally Face" (exemplo de uso do método de Avaliador).

    $avaliador = $usuarios["avaliador@email.com"];
    if ($avaliador instanceof Avaliador) {
        $avaliador->avaliarJogo($jogos[0], 9.5, true);
    }

---

**2. Loop Principal (Interação com o Usuário)**
O sistema entra em um loop infinito (while (true)) para simular uma aplicação de console interativa, oferecendo menus com base no estado de autenticação do usuário.

**Estado 1**: Usuário Deslogado ($usuarioLogado === null)

É definido que a variável *$usuarioLogado* possui valor *null* antes do laço *while*. Isto é feito para que, ao fim de toda execução do laço, não seja registrado qual o usuário mantido, assim, é possível acessar o menu inicial e geral do sistema, antes de realizar o acesso de cada menu específico (Admin e Avaliador).

    $usuarioLogado = null;

Exibe o Menu de Acesso: Login, Cadastro de Novo Avaliador ou Sair.

    while (true) {
        if ($usuarioLogado === null) {
               echo "\n========== ACESSO AO SISTEMA ==========\n";
               echo "1. Fazer Login\n";
               echo "2. Cadastrar Novo Avaliador\n";
               echo "3. Sair\n";
               echo "=======================================\n";

        $entrada = readline("Escolha uma opção: ");
        $opcao = (int)$entrada;

        switch ($opcao) {
            case 1:
                echo "\n---------- Login ----------\n";
                $email = trim(readline("Email: "));
                $senha = trim(readline("Senha: "));

                if (isset($usuarios[$email]) && $usuarios[$email]->verificarSenha($senha)) {
                    $usuarioLogado = $usuarios[$email];
                    echo "\nLogin realizado com sucesso!\n";
                    echo $usuarioLogado->seApresentar() . "\n";
                } else {
                    echo "\nEmail ou senha inválidos. Tente novamente.\n";
                }
                break;
            case 2:
                echo "\n---------- Cadastro de Novo Avaliador ----------\n";
                $nome = trim(readline("Nome completo: "));
                $email = trim(readline("Email: "));
                $senha = trim(readline("Senha (mínimo 4 caracteres): "));

                if (isset($usuarios[$email])) {
                    echo "\nEste email já está cadastrado. Tente fazer o login.\n";
                } elseif (strlen($senha) < 4) {
                    echo "\nA senha deve ter no mínimo 4 caracteres.\n";
                } else {
                    $usuarios[$email] = new Avaliador($nome, $email, $senha);
                    echo "\nCadastro realizado com sucesso! Você já pode fazer o login.\n";
                }
                break;
            case 3:
                echo "\nSistema finalizado. Até logo!\n";
                exit;
            default:
                echo "\nOpção inválida! Tente novamente.\n";
                break;
        }

A opção de Login demonstra o encapsulamento e a delegação de responsabilidade ao método $usuarios[$email]->verificarSenha($senha).

---

**Estado 2**: Usuário Logado como Admin ($usuarioLogado instanceof Admin)

Exibe o Menu de Gerenciamento Completo (Jogos, Comunidades, Categorias).

As opções (1 a 12) chamam métodos exclusivos da classe Admin (como $usuarioLogado->adicionarJogo(...), demonstrando o princípio do Polimorfismo (o objeto $usuarioLogado pode executar ações que não estão disponíveis para outros tipos de usuário logado).

    } elseif ($usuarioLogado instanceof Admin) {
        echo "\n========== MENU PRINCIPAL (ADMIN) ==========\n";
        echo "\n========== GERENCIAMENTO DE JOGOS ==========\n";
        echo "1. Adicionar Novo Jogo\n";
        echo "2. Ver Detalhes de um Jogo\n";
        echo "3. Exibir Lista de Categorias\n";
        echo "4. Exibir Jogos de uma Categoria\n";
        echo "5. Editar um Jogo\n";
        echo "6. Excluir um Jogo\n";
        echo "\n======= GERENCIAMENTO DE COMUNIDADES =======\n";
        echo "7. Criar uma comunidade\n";
        echo "8. Editar uma comunidade\n";
        echo "9. Excluir uma comunidade\n";
        echo "\n======== GERENCIAMENTO DE CATEGORIAS =======\n";
        echo "10. Adicionar Nova Categoria\n";
        echo "11. Editar Categoria Existente\n";
        echo "12. Excluir Categoria\n";
        echo "\n============================================\n";
        echo "13. Sair\n";
        echo "============================================\n";

        $comunidadesExistentes = $comunidades;
        $entrada = trim(readline("Escolha uma opção: "));
        $opcao = (int)$entrada;

        switch ($opcao) {
            case 1:
                echo "\n---------- Adicionar Novo Jogo ----------\n";
                echo "Digite '0' a qualquer momento para CANCELAR.\n"; 

                $nomeJogo = trim(readline("Digite o nome do jogo: "));

                if (strtoupper($nomeJogo) === '0') {
                    echo "Operação de adição cancelada.\n";
                    break; 
                }

                $descricaoJogo = trim(readline("Digite a descrição do jogo: "));
                $anoJogoStr = trim(readline("Digite o ano de lançamento: "));
                $anoJogo = (int)$anoJogoStr;

                echo "Escolha a categoria do jogo:\n";
                foreach ($categorias as $key => $cat) {
                    echo "[$key] - " . $cat->getNome() . "\n";
                }
                $keyCategoria = readline("Digite o código da categoria: ");

                if (!isset($categorias[$keyCategoria])) {
                    echo "\nCategoria inválida!\n";
                    break;
                }
                $categoriaSelecionada = $categorias[$keyCategoria];

                $usuarioLogado->adicionarJogo($jogos, $nomeJogo, $descricaoJogo, $anoJogo, $categoriaSelecionada);

                echo "\nJogo '$nomeJogo' adicionado com sucesso!\n";
                break;
            case 2:
                echo "\n========== Ver Detalhes de um Jogo ==========\n";
                if (empty($jogos)) {
                    echo "Nenhum jogo cadastrado ainda.\n";
                    break;
                }

                echo "Qual jogo você deseja ver os detalhes?\n";
                foreach ($jogos as $indice => $jogo) {
                    echo "$indice. " . $jogo->getTitulo() . "\n";
                }

                $indiceJogoStr = trim(readline("Escolha o número do jogo: "));
                $indiceJogo = (int)$indiceJogoStr;

                if (isset($jogos[$indiceJogo])) {
                    $jogos[$indiceJogo]->exibirDetalhes();
                } else {
                    echo "\nOpção de jogo inválida.\n";
                }
                break;

            case 3:
                echo "\n========== Categorias Cadastradas ==========\n";
                foreach ($categorias as $cat) {
                    echo "- " . $cat->getNome() . "\n";
                }
                break;

            case 4:
                echo "\n---------- Escolha a Categoria ----------\n";
                foreach ($categorias as $chave => $cat) {
                    echo "[$chave] - " . $cat->getNome() . "\n";
                }
                $chaveCat = readline("Digite o código da categoria: ");

                if (!isset($categorias[$chaveCat])) {
                    echo "\nCategoria inválida.\n";
                    break;
                }
                $catSelecionada = $categorias[$chaveCat];
                $jogosDaCategoria = $catSelecionada->getJogos();

                echo "\n========== Jogos em '" . $catSelecionada->getNome() . "' ==========\n";
                if (empty($jogosDaCategoria)) {
                    echo "Nenhum jogo cadastrado nesta categoria.\n";
                } else {
                    foreach ($jogosDaCategoria as $jogo) {
                        $jogo->exibirDetalhes();
                    }
                }
                break;

            
            case 5:
                echo "\n========== Editar Jogo ==========\n";

                if (empty($jogos)) {
                    echo "Nenhum jogo cadastrado.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";
                foreach ($jogos as $i => $jogo) {
                    echo " " . ($i + 1) . ". " . $jogo->getTitulo() . "\n"; 
                }

                $entradaPos = trim(readline("Escolha o número do jogo: "));
                $pos = (int)$entradaPos;

                if ($pos === 0) {
                    echo "Operação de edição cancelada.\n";
                    break;
                }
                
                $indexReal = $pos - 1;

                if (!isset($jogos[$indexReal])) {
                    echo "Índice inválido.\n";
                    break;
                }

                $jogo = $jogos[$indexReal];

                $titulo = readline("Novo título ({$jogo->getTitulo()}): ");
                $descricao = readline("Nova descrição ({$jogo->getDescricao()}): ");
                $anoInput = readline("Novo ano ({$jogo->getAno()}): ");
                $ano = $anoInput ? (int)$anoInput : $jogo->getAno();

                echo "Categorias disponíveis:\n";
                foreach ($categorias as $chave => $cat) {
                    echo " - $chave (" . $cat->getNome() . ")\n";
                }

                $catEscolhida = readline("Digite a categoria: ");

                if (!isset($categorias[$catEscolhida])) {
                    echo "Categoria inválida.\n";
                    break;
                }

                $jogo->editarJogo(
                    $titulo ?: $jogo->getTitulo(),
                    $descricao ?: $jogo->getDescricao(),
                    $ano,
                    $categorias[$catEscolhida]
                );

                echo "\nJogo editado com sucesso!\n";
                break;

            case 6:
                echo "\n========== Excluir Jogo ==========\n";

                if (empty($jogos)) {
                    echo "Nenhum jogo cadastrado.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";
                foreach ($jogos as $i => $jogo) {
                    echo " " . ($i + 1) . ". " . $jogo->getTitulo() . "\n"; 
                }

                $entradaPos = trim(readline("Escolha o número do jogo para remover (ou 0 para cancelar): "));
                $pos = (int)$entradaPos;

                if ($pos === 0) {
                    echo "Operação de exclusão cancelada.\n";
                    break; 
                }

                $indexReal = $pos - 1;

                if (!isset($jogos[$indexReal])) {
                    echo "Índice inválido.\n";
                    break;
                }

                $jogoParaExcluir = $jogos[$indexReal];

                $usuarioLogado->removerJogo($jogos, $jogoParaExcluir);
                
                echo "--- Iniciando limpeza em todas as contas do tipo Avaliador... ---\n";
                foreach ($usuarios as $usuario) {
                    if ($usuario instanceof Avaliador) {
                        $usuario->limparJogoExcluido($jogoParaExcluir);
                        $usuario->limparAvaliacoesDeJogoExcluido($jogoParaExcluir);
                    }
                }
                echo "--- Limpeza de Favoritos concluída. ---\n";
                
                break;
            case 7:
                echo "\n========== Criar Comunidade ==========\n";
                $nome = trim(readline("Nome da Comunidade (ou 0 para cancelar): "));
                        
                if ($nome === '0' || empty($nome)) {
                    echo "Criação cancelada.\n";
                    break;
                }
                        
                $usuarioLogado->criarComunidade($comunidades, $nome);
                break;
            case 8:
                echo "\n========== Editar Comunidade ==========\n";
                if (empty($comunidadesExistentes)) {
                    echo "Nenhuma comunidade para editar.\n";
                    break;
                }

                echo "0. CANCELAR\n";
                foreach ($comunidadesExistentes as $i => $comunidade) {
                    echo " " . ($i + 1) . ". {$comunidade->getNome()}\n";
                }
                $entradaPos = trim(readline("Escolha o número da comunidade (ou 0 para cancelar): "));
                $pos = (int)$entradaPos;

                if ($pos === 0) {
                    echo "Edição cancelada.\n";
                    break;
                }

                $valorIndexado = $pos - 1;
                if ($valorIndexado < 0 || !isset($comunidadesExistentes[$valorIndexado])) {
                    echo "Opção inválida.\n";
                    break;
                }

                $comunidadeParaEditar = $comunidadesExistentes[$valorIndexado];
                $novoNome = trim(readline("Novo Nome (Atual: {$comunidadeParaEditar->getNome()}): "));

                if (empty($novoNome)) {
                    echo "Nome inválido. Edição cancelada.\n";
                    break;
                }
                         
                $usuarioLogado->editarComunidade($comunidadeParaEditar, $novoNome);
                break;
            case 9:
                echo "\n========== Excluir Comunidade ==========\n";
                if (empty($comunidadesExistentes)) {
                    echo "Nenhuma comunidade para excluir.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";
                foreach ($comunidadesExistentes as $i => $comunidade) {
                    echo " " . ($i + 1) . ". {$comunidade->getNome()}\n";
                }
                        
                $entradaPos = trim(readline("Escolha o número da comunidade para EXCLUIR (ou 0 para cancelar): "));
                $pos = (int)$entradaPos;
                        
                if ($pos === 0) {
                    echo "Operação de exclusão cancelada.\n";
                    break;
                }

                $valorIndexado = $pos - 1;
                if ($valorIndexado < 0 || !isset($comunidadesExistentes[$valorIndexado])) {
                    echo "Opção inválida.\n";
                    break;
                }

                $comunidadeParaExcluir = $comunidadesExistentes[$valorIndexado];
                $confirm = trim(readline("Tem certeza que deseja DELETAR a comunidade '{$comunidadeParaExcluir->getNome()}'? (s/n): "));

                if (strtolower($confirm) === 's') {
                    $usuarioLogado->excluirComunidade($comunidades, $comunidadeParaExcluir);

                    foreach($usuarios as $usuario){
                        if ($usuario instanceof Avaliador){
                            $usuario->limparComunidadeExcluida($comunidadeParaExcluir);
                        }
                    }
                } else {
                    echo "Exclusão cancelada.\n";
                }
                break;
            case 10:
                echo "\n---------- Adicionar Nova Categoria ----------\n";
                echo "Digite '0' para cancelar.\n";
                $nomeCat = trim(readline("Nome da Categoria (ex: RPG): "));
                if ($nomeCat === '0' || empty($nomeCat)) break;
                $chaveCat = trim(readline("Código único (slug) para a categoria (ex: rpg): "));
                $chaveCat = strtolower(str_replace(' ', '-', $chaveCat));

                if ($usuarioLogado->adicionarCategoria($categorias, $chaveCat, $nomeCat)){
                    echo "\nCategoria '$nomeCat' criada com sucesso!\n";
                } else {
                    echo"\nErro: Já existe uma categoria com o código '$chaveCat' .\n";
                }
                break;
            case 11:
                echo "\n---------- Editar Categoria ----------\n";
                echo "Escolha o NÚMERO da categoria para editar:\n";
                $listaChaves = array_keys($categorias);
                if (empty($listaChaves)) {
                    echo "Nenhuma categoria cadastrada.\n";
                    break;
                }
                foreach ($listaChaves as $index => $chave) {
                    echo ($index + 1) . ". " . $categorias[$chave]->getNome() . "\n";
                }
                echo "0. CANCELAR\n";
                $entrada = (int)readline("Digite o número da categoria: ");
                if ($entrada === 0) {
                    echo "Operação cancelada.\n";
                    break;
                }
                $indexReal = $entrada - 1;
                if (isset($listaChaves[$indexReal])) {
                    $keyCat = $listaChaves[$indexReal]; 
                    $catSelecionada = $categorias[$keyCat];
                    $novoNome = trim(readline("Novo nome para '" . $catSelecionada->getNome() . "': "));
                    
                    if (!empty($novoNome)) {
                        $usuarioLogado->editarCategoria($catSelecionada, $novoNome);
                        echo "\nCategoria atualizada com sucesso!\n";
                    } else {
                        echo "\nNome inválido (vazio).\n";
                    }
                } else {
                    echo "\nOpção inválida!\n";
                }
                break;
            case 12:
                echo "\n---------- Excluir Categoria ----------\n";
                echo "ATENÇÃO: Excluir uma categoria não exclui os jogos, mas remove a referência da lista global.\n";
                $listaChaves = array_keys($categorias);
                if (empty($listaChaves)) {
                    echo "Nenhuma categoria cadastrada.\n";
                    break;
                }

                foreach ($listaChaves as $index => $chave) {
                    echo ($index + 1) . ". " . $categorias[$chave]->getNome() . "\n";
                }
                echo "0. CANCELAR\n";
                $entrada = (int)readline("Escolha o número da categoria para EXCLUIR: ");
                if ($entrada === 0) {
                    echo "Operação cancelada.\n";
                    break;
                }
                $indexReal = $entrada - 1;
                if (isset($listaChaves[$indexReal])) {
                    $keyCat = $listaChaves[$indexReal];
                    $nomeCat = $categorias[$keyCat]->getNome();
                    $confirm = readline("Tem certeza que deseja excluir a categoria '{$nomeCat}'? (s/n): ");
                    if (strtolower($confirm) === 's') {
                        $usuarioLogado->excluirCategoria($categorias, $keyCat);
                        echo "\nCategoria excluída com sucesso.\n";
                    } else {
                        echo "\nExclusão cancelada.\n";
                    }
                } else {
                    echo "\nOpção inválida.\n";
                }
                break;
            case 13:
                $usuarioLogado = null;
                echo "\nLogout realizado com sucesso.\n";
                break;

            default:
            echo "\nOpção inválida.\n";
            break;
        }

---

**Estado 3**: Usuário Logado como Avaliador ($usuarioLogado instanceof Avaliador)

Exibe o Menu de Usuário Padrão (Avaliar, Ver Detalhes, Favoritos, Minha Conta, Comunidades).

As opções (1 a 13) chamam métodos exclusivos da classe Avaliador (como $usuarioLogado->avaliarJogo(...) e $usuarioLogado->adicionarJogoFavorito()), demonstrando a funcionalidade e o Polimorfismo.

    } elseif ($usuarioLogado instanceof Avaliador) {
        echo "\n========== MENU PRINCIPAL (AVALIADOR) ==========\n";
        echo "1. Avaliar um Jogo\n";
        echo "2. Editar Minha Avaliação\n";
        echo "3. Excluir Minha Avaliação\n";
        echo "4. Ver Detalhes de um Jogo\n";
        echo "5. Exibir Lista de Categorias\n";
        echo "6. Exibir Jogos de uma Categoria\n";
        echo "=================== FAVORITOS ==================\n";
        echo "7. Adicionar Jogo aos Favoritos\n";
        echo "8. Remover Jogo dos Favoritos\n";
        echo "9. Ver Meus Favoritos\n";
        echo "================= MINHA CONTA ==================\n";
        echo "10. Alterar Meu Nome\n";
        echo "11. Excluir Minha Conta\n";
        echo "================== COMUNIDADES =================\n";
        echo "12. Entrar/Sair de Comunidades\n";
        echo "13. Interagir em uma Comunidade (Comentar/Ver)\n";
        echo "================================================\n";
        echo "14. Logout\n";
        echo "================================================\n";

        $entrada = trim(readline("Escolha uma opção: "));
        $opcao = (int)$entrada;

        switch ($opcao) {
            case 1:
                echo "\n---------- Avaliar um Jogo ----------\n";
                if (empty($jogos)) {
                    echo "Nenhum jogo cadastrado para avaliar.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";
                echo "Qual jogo você deseja avaliar?\n";
    
                foreach ($jogos as $indice => $jogo) {
                    echo " " . ($indice + 1) . ". " . $jogo->getTitulo() . "\n";
                }

                $indiceJogoStr = trim(readline("Escolha o número do jogo (ou 0 para cancelar): "));
                $pos = (int)$indiceJogoStr;

                if ($pos === 0) {
                    echo "Operação de avaliação cancelada.\n";
                    break;
                }

                $indexReal = $pos - 1;
                if (!isset($jogos[$indexReal])) {
                    echo "\nOpção de jogo inválida.\n";
                    break;
                }
                $jogoSelecionado = $jogos[$indexReal];
                echo "Avaliando: " . $jogoSelecionado->getTitulo() . "\n";

                $notaStr = trim(readline("Digite a nota para o jogo (ex: 9.5): "));
                $notaPt = str_replace(",", ".", $notaStr);
                $nota = (float)$notaPt;

                $inputRecomenda = trim(readline("Você recomenda? (s/n): "));
                $recomenda = (strtolower($inputRecomenda) == 's');

                $resultado = $usuarioLogado->avaliarJogo($jogoSelecionado, $nota, $recomenda);

                if ($resultado === null) {
                    echo "\nVocê já avaliou este jogo! Use a opção 'Editar Minha Avaliação'.\n";
                } else {
                    echo "\nAvaliação registrada com sucesso!\n";
                }
                break;

            case 2:
                echo "\n---------- Editar Minha Avaliação ----------\n";
                $minhasAvaliacoes = $usuarioLogado->getMinhasAvaliacoes();
                if (empty($minhasAvaliacoes)) {
                    echo "Você ainda não fez nenhuma avaliação.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";
                echo "Qual avaliação você deseja editar?\n";
    
                foreach ($minhasAvaliacoes as $indice => $avaliacao) {
                    echo " " . ($indice + 1) . ". " . $avaliacao->getJogo()->getTitulo() . " (Nota: " . $avaliacao->getNota() . ")\n";
                }
    
                $indiceAvalStr = trim(readline("Escolha o número da avaliação (ou 0 para cancelar): "));
                $pos = (int)$indiceAvalStr;

                if ($pos === 0) {
                    echo "Operação de edição cancelada.\n";
                    break; 
                }

                $indexReal = $pos - 1;

                if (!isset($minhasAvaliacoes[$indexReal])) {
                    echo "\nOpção inválida.\n";
                    break;
                }

                $avaliacaoParaEditar = $minhasAvaliacoes[$indexReal];
                echo "Editando: " . $avaliacaoParaEditar->getJogo()->getTitulo() . "\n";
                $novaNotaStr = trim(readline("Digite a NOVA nota (Atual: " . $avaliacaoParaEditar->getNota() . "): "));
                $novaNotaPt = str_replace(",", ".", $novaNotaStr);
                $novaNota = (float)$novaNotaPt;
                $inputRecomenda = trim(readline("Você recomenda? (s/n) (Atual: " . ($avaliacaoParaEditar->getRecomenda() ? 'Sim' : 'Não') . "): "));
                $novoRecomenda = (strtolower($inputRecomenda) == 's');

                $usuarioLogado->editarAvaliacao($avaliacaoParaEditar, $novaNota, $novoRecomenda);
                break;

            case 3:
                echo "\n---------- Excluir Minha Avaliação ----------\n";
                $minhasAvaliacoes = $usuarioLogado->getMinhasAvaliacoes();
                if (empty($minhasAvaliacoes)) {
                    echo "Você ainda não fez nenhuma avaliação.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";

                echo "Qual avaliação você deseja EXCLUIR?\n";
                foreach ($minhasAvaliacoes as $indice => $avaliacao) {
                    echo " " . ($indice + 1) . ". " . $avaliacao->getJogo()->getTitulo() . " (Nota: " . $avaliacao->getNota() . ")\n";
                }
    
                $indiceAvalStr = trim(readline("Escolha o número da avaliação (ou 0 para cancelar): "));
                $pos = (int)$indiceAvalStr;

                if ($pos === 0) {
                    echo "Exclusão de avaliação cancelada.\n";
                    break;
                }
                
                $indexReal = $pos - 1;

                if (!isset($minhasAvaliacoes[$indexReal])) {
                    echo "\nOpção inválida.\n";
                    break;
                }

                $avaliacaoParaExcluir = $minhasAvaliacoes[$indexReal];
                echo "Tem certeza que deseja excluir sua avaliação para '" . $avaliacaoParaExcluir->getJogo()->getTitulo() . "'? (s/n): ";
                $confirm = trim(readline());

                if (strtolower($confirm) == 's') {
                    $usuarioLogado->excluirAvaliacao($avaliacaoParaExcluir);
                } else {
                    echo "\nExclusão cancelada.\n";
                }
                break;

            case 4:
                echo "\n========== Ver Detalhes de um Jogo ==========\n";
                if (empty($jogos)) {
                    echo "Nenhum jogo cadastrado ainda.\n";
                    break;
                }
                echo "Qual jogo você deseja ver os detalhes?\n";
                foreach ($jogos as $indice => $jogo) {
                    echo "$indice. " . $jogo->getTitulo() . "\n";
                }
                $indiceJogoStr = trim(readline("Escolha o número do jogo: "));
                $indiceJogo = (int)$indiceJogoStr;

                if (isset($jogos[$indiceJogo])) {
                    $jogos[$indiceJogo]->exibirDetalhes();
                } else {
                    echo "\nOpção de jogo inválida.\n";
                }
                break;

            case 5:
                echo "\n========== Categorias Cadastradas ==========\n";
                foreach ($categorias as $cat) {
                    echo "- " . $cat->getNome() . "\n";
                }
                break;

            case 6:
                echo "\n---------- Escolha a Categoria ----------\n";
                foreach ($categorias as $key => $cat) {
                    echo "[$key] - " . $cat->getNome() . "\n";
                }
                $keyCat = readline("Digite o código da categoria: ");

                if (!isset($categorias[$keyCat])) {
                    echo "\nCategoria inválida.\n";
                    break;
                }
                $catSelecionada = $categorias[$keyCat];
                $jogosDaCategoria = $catSelecionada->getJogos();

                echo "\n========== Jogos em '" . $catSelecionada->getNome() . "' ==========\n";
                if (empty($jogosDaCategoria)) {
                    echo "Nenhum jogo cadastrado nesta categoria.\n";
                } else {
                    foreach ($jogosDaCategoria as $jogo) {
                        $jogo->exibirDetalhes();
                    }
                }
                break;

            case 7:
                echo "\n---------- Adicionar Jogo aos Favoritos ----------\n";
                if (empty($jogos)) {
                    echo "Nenhum jogo cadastrado.\n";
                    break;
                }

                echo "0. CANCELAR E VOLTAR AO MENU\n";
                echo "Qual jogo deseja adicionar aos favoritos?\n";
    
                foreach ($jogos as $indice => $jogo) {
                    echo " " . ($indice + 1) . ". " . $jogo->getTitulo() . "\n";
                }
    
                $indiceJogoStr = trim(readline("Escolha o número do jogo (ou 0 para cancelar): "));
                $pos = (int)$indiceJogoStr;

                if ($pos === 0) {
                    echo "Operação de adição cancelada.\n";
                    break;
                }

                $indexReal = $pos - 1;

                if (isset($jogos[$indexReal])) {
                    $usuarioLogado->adicionarJogoFavorito($jogos[$indexReal]);
                } else {
                    echo "\nOpção de jogo inválida.\n";
                }
                break;

            case 8:
                echo "\n---------- Remover Jogo dos Favoritos ----------\n";
                $favoritos = $usuarioLogado->getJogosFavoritos();
                if (empty($favoritos)) {
                    echo "Você não tem nenhum jogo favorito.\n";
                    break;
                }
                echo "0. CANCELAR E VOLTAR AO MENU\n";
                echo "Qual jogo deseja remover dos favoritos?\n";

                foreach ($favoritos as $indice => $jogo) {
                    echo " " . ($indice + 1) . ". " . $jogo->getTitulo() . "\n"; 
                }
    
                $indiceJogoStr = trim(readline("Escolha o número do jogo (ou 0 para cancelar): "));
                $pos = (int)$indiceJogoStr;

                if ($pos === 0) {
                    echo "Operação de remoção cancelada.\n";
                    break;
                }

                $indexReal = $pos - 1;

                if (isset($favoritos[$indexReal])) {
                    $usuarioLogado->removerJogoFavorito($favoritos[$indexReal]);
                } else {
                    echo "\nOpção de jogo inválida.\n";
                }
                break;

            case 9:
                echo "\n---------- Meus Jogos Favoritos ----------\n";
                $favoritos = $usuarioLogado->getJogosFavoritos();
                if (empty($favoritos)) {
                    echo "Você ainda não adicionou nenhum jogo aos favoritos.\n";
                } else {
                    foreach ($favoritos as $jogo) {
                        echo "- " . $jogo->getTitulo() . "\n";
                    }
                }
                echo "--------------------------------------------\n";
                break;

            case 10:
                echo "\n---------- Alterar Meu Nome ----------\n";
                echo "Seu nome atual é: " . $usuarioLogado->getNome() . "\n";
                $novoNome = trim(readline("Digite o novo nome: "));
                if (!empty($novoNome)) {
                    $usuarioLogado->setNome($novoNome);
                    echo "\nNome alterado com sucesso!\n";
                } else {
                    echo "\nNome não pode ser vazio. Alteração cancelada.\n";
                }
                break;

            case 11:
                echo "\n---------- Excluir Minha Conta ----------\n";
                $emailParaExcluir = $usuarioLogado->getEmail();
                $confirm = trim(readline("ATENÇÃO! Isso é permanente. Tem certeza que deseja excluir sua conta ($emailParaExcluir)? (s/n): "));

                if (strtolower($confirm) == 's') {
                    unset($usuarios[$emailParaExcluir]);
                    $usuarioLogado = null;
                    echo "\nSua conta foi excluída com sucesso. Você será redirecionado para o menu inicial.\n";
                } else {
                    echo "\nExclusão de conta cancelada.\n";
                }
                break;

            case 12:
                echo "\n========== Gerenciar Comunidades ==========\n";
                if (empty($comunidades)) {
                    echo "Nenhuma comunidade existente no sistema.\n";
                    break;
                }

                echo "Lista de Comunidades:\n";
                $listaComunidades = array_values($comunidades);
                
                foreach ($listaComunidades as $i => $comunidade) {
                    $status = in_array($comunidade, $usuarioLogado->getMinhasComunidades(), true) ? "[MEMBRO]" : "";
                    echo ($i + 1) . ". " . $comunidade->getNome() . " $status\n";
                }

                $escolha = (int)readline("Escolha o número da comunidade para Entrar/Sair (0 volta): ");
                if ($escolha === 0) break;

                if (isset($listaComunidades[$escolha - 1])) {
                    $comunidadeAlvo = $listaComunidades[$escolha - 1];
                    if (in_array($comunidadeAlvo, $usuarioLogado->getMinhasComunidades(), true)) {
                        $usuarioLogado->sairComunidade($comunidadeAlvo);
                        echo "Você saiu da comunidade '{$comunidadeAlvo->getNome()}'.\n";
                    } else {
                        $usuarioLogado->entrarComunidade($comunidadeAlvo);
                        echo "Você entrou na comunidade '{$comunidadeAlvo->getNome()}'!\n";
                    }
                } else {
                    echo "Comunidade inválida.\n";
                }
                break;

            case 13:
                echo "\n========== Mural da Comunidade ==========\n";
                $minhasComunidades = $usuarioLogado->getMinhasComunidades();
                if (empty($minhasComunidades)) {
                    echo "Você não é membro de nenhuma comunidade. Use a opção 12 para entrar em uma.\n";
                    break;
                }

                foreach ($minhasComunidades as $i => $comm) {
                    echo ($i + 1) . ". " . $comm->getNome() . "\n";
                }
                
                $escolha = (int)readline("Escolha a comunidade para interagir (0 volta): ");
                if ($escolha === 0) break;
                
                $minhasComunidadesValues = array_values($minhasComunidades);

                if (isset($minhasComunidadesValues[$escolha - 1])) {
                    $comunidadeAtual = $minhasComunidadesValues[$escolha - 1];
                    
                    while(true) {
                        echo "\n--- {$comunidadeAtual->getNome()} ---\n";
                        echo "1. Ver Comentários\n";
                        echo "2. Publicar Comentário\n";
                        echo "3. Editar Meu Comentário\n";
                        echo "4. Excluir Meu Comentário\n";
                        echo "5. Voltar\n";
                        
                        $acao = (int)readline("O que deseja fazer? ");
                        
                        if ($acao === 5) break;
                        
                        switch ($acao) {
                            case 1:
                                $comentarios = $comunidadeAtual->getComentarios();
                                if (empty($comentarios)) echo "Nenhum comentário ainda.\n";
                                foreach ($comentarios as $c) {
                                    echo "[{$c->getDataFormatada()}] {$c->getAutor()->getNome()}: {$c->getTexto()}\n";
                                }
                                break;
                            case 2:
                                $texto = readline("Digite seu comentário: ");
                                try {
                                    $usuarioLogado->publicarComentario($comunidadeAtual, $texto);
                                    echo "Comentário publicado!\n";
                                } catch (\Exception $e) {
                                    echo "Erro: " . $e->getMessage() . "\n";
                                }
                                break;
                            case 3:
                                $comentarios = $comunidadeAtual->getComentarios();
                                echo "Seus comentários:\n";
                                $meusComentariosIndices = [];
                                foreach ($comentarios as $idx => $c) {
                                    if ($c->getAutor() === $usuarioLogado) {
                                        echo "$idx. [{$c->getDataFormatada()}] {$c->getTexto()}\n";
                                        $meusComentariosIndices[] = $idx;
                                    }
                                }
                                if (empty($meusComentariosIndices)) {
                                    echo "Você não tem comentários aqui.\n";
                                    break;
                                }
                                $idEdit = (int)readline("ID do comentário para editar: ");
                                if (in_array($idEdit, $meusComentariosIndices)) {
                                    $novoTexto = readline("Novo texto: ");
                                    $usuarioLogado->editarComentario($comentarios[$idEdit], $novoTexto);
                                    echo "Atualizado!\n";
                                } else {
                                    echo "ID inválido ou comentário não é seu.\n";
                                }
                                break;
                            case 4:
                                $comentarios = $comunidadeAtual->getComentarios();
                                echo "Seus comentários:\n";
                                $meusComentariosIndices = [];
                                foreach ($comentarios as $idx => $c) {
                                    if ($c->getAutor() === $usuarioLogado) {
                                        echo "$idx. [{$c->getDataFormatada()}] {$c->getTexto()}\n";
                                        $meusComentariosIndices[] = $idx;
                                    }
                                }
                                if (empty($meusComentariosIndices)) {
                                    echo "Você não tem comentários aqui.\n";
                                    break;
                                }
                                $idDel = (int)readline("ID do comentário para excluir: ");
                                if (in_array($idDel, $meusComentariosIndices)) {
                                    $usuarioLogado->excluirComentario($comunidadeAtual, $comentarios[$idDel]);
                                    echo "Excluído!\n";
                                } else {
                                    echo "ID inválido.\n";
                                }
                                break;
                        }
                    }

                } else {
                    echo "Opção inválida.\n";
                }
                break;

---

**3. Encerramento**

O loop pode ser quebrado nas seguintes situações:

Opção 3 (Sair) no Menu de Acesso (encerra o script com exit).

    case 3:
                echo "\nSistema finalizado. Até logo!\n";
                exit;

Opção 14 (Logout) no Menu do Avaliador, ou 13 (Sair) no Menu do Admin (limpa a variável $usuarioLogado e retorna ao Menu de Acesso).

    case 13:
                $usuarioLogado = null;
                echo "\nLogout realizado com sucesso.\n";
                break;
    
    [...]
    
    case 14:
                $usuarioLogado = null;
                echo "\nLogout realizado com sucesso.\n";
                break;

Opção 11 (Excluir Minha Conta) no Menu do Avaliador (remove a conta e faz o logout).

            case 11:
                echo "\n---------- Excluir Minha Conta ----------\n";
                $emailParaExcluir = $usuarioLogado->getEmail();
                $confirm = trim(readline("ATENÇÃO! Isso é permanente. Tem certeza que deseja excluir sua conta ($emailParaExcluir)? (s/n): "));

                if (strtolower($confirm) == 's') {
                    unset($usuarios[$emailParaExcluir]);
                    $usuarioLogado = null;
                    echo "\nSua conta foi excluída com sucesso. Você será redirecionado para o menu inicial.\n";
                } else {
                    echo "\nExclusão de conta cancelada.\n";
                }
                break;
