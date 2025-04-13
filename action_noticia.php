<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Sistema de Cadastro</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
 <body>
    <?php
        require 'bd/conexao.php';
        // Atribui uma conexão PDO
        $conexao = conexao::getInstance();
        // Recebe os dados enviados pela submissão
        $acao = (isset ($_POST['acao'])) ? $_POST['acao'] : '';
        $id = (isset ($_POST['id'])) ? $_POST['id'] : '';
        $titulo = (isset ($_POST['titulo'])) ? $_POST['titulo'] : '';
        $texto = (isset ($_POST[ 'texto'])) ? $_POST['texto'] : '';
        $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : '';
        $manter = (isset($_POST['manter'])) ? $_POST['manter'] : '';

        // echo $foto;

        // Verifica se o arquivo foi enviado sem erros
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK):
        
                // Diretório onde a imagem será salva
                $diretorio = 'img/noticias/';
                $imagem1 = $_FILES['foto']['name']; 
                if(pathinfo($imagem1, PATHINFO_EXTENSION) == "png"){
                    // Gera um nome único para a imagem usando timestamp
                    $nomeImagem = time() . '_' . $titulo. random_int(1,100) . '.png';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $titulo. random_int(1,100) . '.png';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpg") {
                    $nomeImagem = time() . '_' . $titulo. random_int(1,100) . '.jpg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $titulo. random_int(1,100) . '.jpg';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpeg") {
                    $nomeImagem = time() . '_' . $titulo. random_int(1,100) . '.jpeg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $titulo. random_int(1,100) . '.jpeg';
                    }
                }
                
                

                // Caminho completo onde a imagem será salva
                $caminhoCompleto1 = $diretorio . $nomeImagem;

                move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto1);
            endif;
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($titulo == '' || strlen($titulo) < 3):
                $mensagem .= '<li>Favor preencher o Título. </li>';
            endif;
            if ($texto == ''):
                $mensagem .= '<li>Favor preencher o Texto.</li>';
            endif;
            if ($foto == ''):
                $mensagem .= '<li>Favor escolher uma foto.</li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                exit;
            endif;
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):

        $sql = 'INSERT INTO artigos (art_titulo, art_foto, art_texto)
                        VALUES (:art_titulo, :art_foto, :art_texto)';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':art_titulo', $titulo);
        $stm->bindValue(':art_texto', $texto);
        $stm->bindValue(':art_foto', $caminhoCompleto1);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        else:
            echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
        endif;

        echo "<meta http-equiv=refresh content= '1;URL=indexnoticia.php')";
    endif;

    // Verifica se foi solicitada a edição de dados
    if($acao == 'editar'):
        if($manter == false):
            // Obtém o nome da imagem do banco de dados
            $sql_select = 'SELECT art_foto FROM artigos WHERE id=:id';
            $stm_select = $conexao->prepare($sql_select);
            $stm_select->bindValue(':id', $id);
            $stm_select->execute();
            $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

            if ($resultado_select) {
                $fotoexluir = $resultado_select['art_foto'];
                
                // Verifica se o arquivo existe antes de tentar excluí-lo
                if (file_exists($fotoexcluir)) {
                    // Exclui a imagem do diretório
                    unlink($fotoexcluir);
                }
            }

            $foto = $caminhoCompleto1;
        endif;
        if($manter==true):
            $sql_select = 'SELECT art_foto FROM artigos WHERE id=:id';
            $stm_select = $conexao->prepare($sql_select);
            $stm_select->bindValue(':id', $id);
            $stm_select->execute();
            $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

            
                $foto = $resultado_select['art_foto'];

        endif;

        $sql = 'UPDATE artigos SET art_foto=:art_foto, art_titulo=:art_titulo, art_texto=:art_texto';
        $sql .= ' WHERE id=:id';
        
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':art_titulo', $titulo);
        $stm->bindValue(':art_texto', $texto);
        $stm->bindValue(':art_foto', $foto);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexnoticia.php'>";
    endif;

    // Verifica se foi solicitada a exclusão dos dados
    if($acao == 'excluir'):
        
        // Obtém o nome da imagem do banco de dados
        $sql_select = 'SELECT art_foto FROM artigos WHERE id=:id';
        $stm_select = $conexao->prepare($sql_select);
        $stm_select->bindValue(':id', $id);
        $stm_select->execute();
        $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

        if ($resultado_select) {
            $foto = $resultado_select['art_foto'];
            
            // Verifica se o arquivo existe antes de tentar excluí-lo
            if (file_exists($foto)) {
                // Exclui a imagem do diretório
                unlink($foto);
            }
        }

        // Excluir o registro do banco de dados
        $sql = ' DELETE FROM artigos WHERE id=:id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id);
        $retorno = $stm->execute();



        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexnoticia.php'>";
    endif;
    ?>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>