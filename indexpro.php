<?php
session_start();
function verificarSessao()
{
    if (!isset($_SESSION["nome"])) {
        header("Location: index.php");
        exit();
    }
}
// Chame a função para verificar a sessão
verificarSessao();
?>
<?php
require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT pro_id, pro_nome, pro_tipo, pro_valor, pro_disponibilidade, pro_foto FROM produtos order by pro_nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT pro_id, pro_nome, pro_tipo, pro_valor, pro_disponibilidade, pro_foto FROM produtos WHERE pro_nome LiKE :pro_nome OR pro_tipo LIKE :pro_tipo';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':pro_nome', $termo . '%');
    $stm->bindValue(':pro_tipo', $termo . '%');
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>
<?php include_once "header.php" ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Produtos</title>
    <!-- Link do css do bootstrap na maquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <!-- link css do bootstrap da barra de pesquisa -->
    <link rel="stylesheet" href="css/navbar-fixed.css">
    <!-- link css customizado -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        #nomeUsu {
            color: #ffffff;
        }

        img {
            height: 2rem;
            width: 2rem;
            border-radius: 90rem;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">

        <fieldset>
            <!-- CabeÃ§alho da Listagem -->
            <legend>
                <h1>Listagem de Produtos</h1>
            </legend>
            <!-- Formulario de Pesquisa -->
            <form action="" method="get" id="form-contato" class="">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div class="">
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="informe o nome ou tipo " style="border-color: #000000; width: 100%;">
                </div>
                <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="indexpro.php" class="btn btn-primary">Ver Todos</a>
                </div>

            </form>
            <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                <!-- Link para pagina de cadastro -->
                <a href="cadastroproduto.php" class="btn btn-success">Cadastrar Produto</a>
            </div>

            <div class="clearfix"></div>
            <?php if (!empty($produtos)): ?>

                <!-- Tabela de Produtos -->
                <div id="conteudoParaImprimir" class="table-responsive">
                    <table class="table table-striped">
                        <tr class="active">
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>tipo</th>
                            <th>valor</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><img src="<?= $produto->pro_foto ?>" alt="foto do produto"></td>
                                <td><?= $produto->pro_nome ?></td>
                                <td><?= $produto->pro_tipo ?></td>
                                <td><?= $produto->pro_valor ?></td>
                                <td><?= $produto->pro_disponibilidade ?></td>
                                <td>
                                    <a href="editarproduto.php?id=<?= $produto->pro_id ?>" class="btn btn-primary">Editar</a>
                                    <a href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<?= $produto->pro_id ?>">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                <?php else: ?>
                    <!-- Mensagem caso nao exista produtos ou nao encontrado -->
                    <h3 class="text-center text-primary">Não existem produtos cadastrados!</h3>
                <?php endif; ?>
                </div>
        </fieldset>

    </div>
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Início</a></li>
                <li class="nav-item"><a href="indexcolaborador.php" class="nav-link px-2 text-body-secondary">Colaboradores</a></li>
                <li class="nav-item"><a href="indexdoa.php" class="nav-link px-2 text-body-secondary">doações</a></li>
                <li class="nav-item"><a href="indexevento.php" class="nav-link px-2 text-body-secondary">Eventos</a></li>
                <li class="nav-item"><a href="indexpro.php" class="nav-link px-2 text-body-secondary">Produtos</a></li>
                <li class="nav-item"><a href="indexnoticia.php" class="nav-link px-2 text-body-secondary">Notícias</a></li>
            </ul>
            <p class="text-center text-body-secondary">&copy; Associação Venceslauense de Combate ao Câncer</p>
        </footer>
    </div>
    <script type="text/javascript" src="js/cadastroproduto.js"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const usernamePlaceholder = document.getElementById("nomeUsu");

            // Verifica se o usuário está logado
            const isLoggedIn = <?php echo isset($_SESSION["nome"]) ? "true" : "false"; ?>;

            if (isLoggedIn) {
                const username = "<?php echo isset($_SESSION["nome"]) ? $_SESSION["nome"] : ""; ?>";
                usernamePlaceholder.innerHTML = `Olá, ` + username + `!`; // Exibe o nome de usuário
            } else {
                usernamePlaceholder.innerHTML = "";
                // alert('nada conectado'); // Deixa em branco se não estiver logado
            }
        });
    </script>
</body>

</html>