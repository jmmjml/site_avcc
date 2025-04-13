
<?php
session_start();
function verificarSessao() {
    if (!isset($_SESSION["nome"])) {
        header("Location: index.php");
        exit();
    }
}
// Chame a função para verificar a sessão
verificarSessao();
?>
<?php include_once "header.php" ?>

<?php
require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT col_id, col_nome, col_cargo, col_senha, col_datanasc, col_disponibilidade, col_celular, col_foto FROM colaboradores order by col_nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $colaboradores = $stm->fetchAll(PDO::FETCH_OBJ);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT col_id, col_nome, col_cargo, col_senha, col_datanasc, col_disponibilidade, col_celular, col_foto FROM colaboradores WHERE col_nome LiKE :col_nome OR col_celular LIKE :col_celular';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':col_nome', $termo. '%');
    $stm->bindValue(':col_celular', $termo. '%');
    $stm->execute();
    $colaboradores = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">    
    <title>Colaboradores</title>
    <!-- Link do css do bootstrap na maquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <!-- link css do bootstrap da barra de pesquisa -->
    <link rel="stylesheet" href="css/navbar-fixed.css">
    <!-- link css customizado -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        #nomeUsu{
            color: #ffffff;
        }
        img{
            height: 2rem;
            width: 2rem;
            border-radius: 90rem;
        }
    </style>
</head>
<body>
    <br>
<!-- ?php include_once "header.php" ?> -->
    <div class="container">
        <fieldset>
            <!-- CabeÃ§alho da Listagem -->
            <legend><h1>Listagem de Colaboradores</h1></legend>
            <!-- Formulario de Pesquisa -->
            <form action="" method="get" id="form-contato" class="">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div class="">
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="informe o nome ou e-mail " style="border-color: #000000; width: 100%;">
                </div>
                <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="indexusu.php" class="btn btn-primary">Ver Todos</a>
                </div>
                
            </form>
            <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                <!-- Link para pagina de cadastro -->
                <a href="cadastrocolaborador.php" class="btn btn-success">Cadastrar Colaborador</a>
                <!-- link para imprimir
                <a href="imprimircolaborador.php" ><button class="btn btn-danger">Imprimir</button></a> -->
            </div>

            <div class="clearfix"></div>
            <?php if(!empty($colaboradores)):?>

            <!-- Tabela de Colaboradores -->
            <div id="conteudoParaImprimir" class="table-responsive">
                <table class="table table-striped">
                    <tr class="active">
                        <th>foto</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Celular</th>
                        <th>Disponibilidade</th>
                        <th>Ação</th>
                    </tr>
                    <?php foreach($colaboradores as $colaborador):?>
                        <tr>
                            <td><img src="<?=$colaborador->col_foto?>" alt="foto colaborador"></td>
                            <td><?=$colaborador->col_nome?></td>
                            <td><?=$colaborador->col_cargo?></td>
                            <td><?=$colaborador->col_celular?></td>
                            <td><?=$colaborador->col_disponibilidade?></td>
                            <td>
                                <a href="editarcolaborador.php?id=<?=$colaborador->col_id?>" class="btn btn-primary">Editar</a>
                                <a href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<?=$colaborador->col_id?>">Excluir</a>
                                <a href="javascript:void(0)" class="btn btn-success link_whatsapp" data-celular="<?=$colaborador->col_celular?>">Enviar WhatsApp</a>
                            </td>                    
                        </tr>
                    <?php endforeach;?>
    
                </table>
                <?php else: ?>
                    <!-- Mensagem caso nao exista colaboradores ou nao encontrado -->
                    <h3 class="text-center text-primary">Não existem colaboradores cadastrados!</h3>
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
    <script type="text/javascript" src="js/cadastrocolaborador.js"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const usernamePlaceholder = document.getElementById("nomeUsu");
        
        // Verifica se o usuário está logado
        const isLoggedIn = <?php echo isset($_SESSION["nome"]) ? "true" : "false"; ?>;
        
        if (isLoggedIn) {
            const username = "<?php echo isset($_SESSION["nome"]) ? $_SESSION["nome"] : ""; ?>";
            usernamePlaceholder.innerHTML = `Olá, `+username+`!`; // Exibe o nome de usuário
        } else {
            usernamePlaceholder.innerHTML = "";
            // alert('nada conectado'); // Deixa em branco se não estiver logado
        }
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const whatsappLinks = document.querySelectorAll('.link_whatsapp');
        
        whatsappLinks.forEach(link => {
            link.addEventListener('click', function() {
                const celular = this.getAttribute('data-celular');
                const ddd = celular.substring(0, 2);
                const numero = celular.substring(2);
                const mensagem = "Olá, gostaria de mais informações sobre você";
                const url = `https://wa.me/55${ddd}${numero}?text=${encodeURIComponent(mensagem)}`;
                
                window.open(url, '_blank');
            });
        });
    });
</script>
</body>
</html>