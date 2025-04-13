<?php
    require 'bd/conexao.php';

    // Recebe o id do noticia via GET
    $id_noticia = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_noticia) && is_numeric($id_noticia)):

        // Captura os dados do noticia solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT * FROM artigos WHERE id = :id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':id', $id_noticia);
        $stm -> execute();
        $noticia = $stm->fetch(PDO::FETCH_OBJ); 
        // Convertendo a string da data para um objeto DateTime
        $data_original = $noticia->art_datapost;
        $data_obj = DateTime::createFromFormat('Y-m-d H:i:s', $data_original);

        // Formatando a data para o formato dia-mes-ano
        $data_formatada = $data_obj->format('d/m/Y');

        echo($data_formatada);
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
    <title><?=$noticia->art_titulo?></title>
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
        
    </style>
</head>
<body>
<!-- ?php include_once "header.php" ?> -->
    <div class="container">
        <fieldset>
            <!-- Formulario de Pesquisa -->
            <form action="" method="get" id="form-contato" class="">
                <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                    <a href="indexnoticia.php" class="btn btn-primary">Ver Todos</a>
                </div>
                
            </form>

            <div class="clearfix"></div>
            <?php if(!empty($noticia)):?>
            <h1><?=$noticia->art_titulo?></h1>
            <br>
            <img src="<?=$noticia->art_foto?>" alt="Foto da Notícia">
            <br>
            <textarea cols="180" rows="80%" readonly style="border: none; display: block; resize: none; text-align: justify;" disabled><?=$noticia->art_texto?></textarea>
            <!-- Tabela de Colaboradores
            <div id="conteudoParaImprimir">
                <table class="table table-striped">
                    <tr class="active">
                        <th>foto</th>
                        <th>Título</th>
                        <th>Ação</th>
                    </tr>
                    <php foreach($noticias as $noticia):?>
                        <tr>
                            <td><img src="<=$noticia->art_foto?>" alt="foto notícia"></td>
                            <td><=$noticia->art_titulo?></td>
                            <td>
                                <a href="editarnoticia.php?id=<=$noticia->id?>" class="btn btn-primary">Editar</a>
                                <a href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<=$noticia->id?>">Excluir</a>
                            </td>                    
                        </tr>
                    <php endforeach;?>
    
                </table> -->
                <span><p><?=$data_formatada?></p></span>
                <?php else: ?>
                    <!-- Mensagem caso nao exista colaboradores ou nao encontrado -->
                    <h3 class="text-center text-primary">Notícia não encontrada!</h3>
                    <?php endif; ?>
            </div>
        </fieldset>

    </div>
    <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Início</a></li>
            <li class="nav-item"><a href="indexcli.php" class="nav-link px-2 text-body-secondary">Clientes</a></li>
            <li class="nav-item"><a href="indexfor.php" class="nav-link px-2 text-body-secondary">Fornecedores</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Usuários</a></li>
            <li class="nav-item"><a href="indexpro.php" class="nav-link px-2 text-body-secondary">Produtos</a></li>
          </ul>
          <p class="text-center text-body-secondary">&copy; 2023 Company, Inc</p>
        </footer>
    </div>
    <script type="text/javascript" src="js/cadastronoticia.js"></script>
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
</body>
</html>