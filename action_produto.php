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
        $nome = (isset ($_POST['nome'])) ? $_POST['nome'] : '';
        $disponibilidade = (isset ($_POST[ 'disponibilidade'])) ? $_POST['disponibilidade'] : '';
        $valor = (isset ($_POST['valor'])) ? $_POST['valor'] : '';
        $tipo = (isset ($_POST[ 'tipo'])) ? $_POST['tipo'] : '';
        $foto = (isset($_POST['foto'])) ? $_POST['foto'] : '';
        $manter = (isset($_POST['manter'])) ? $_POST['manter'] : '';

        // Verifica se o arquivo foi enviado sem erros
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK):
        
                // Diretório onde a imagem será salva
                $diretorio = 'img/produtos/';
                $imagem1 = $_FILES['foto']['name']; 
                if(pathinfo($imagem1, PATHINFO_EXTENSION) == "png"){
                    // Gera um nome único para a imagem usando timestamp
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.png';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpg';
                    }
                } elseif (pathinfo($imagem1, PATHINFO_EXTENSION) == "jpeg") {
                    $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    while(file_exists($nomeImagem)){
                        $nomeImagem = time() . '_' . $nome. random_int(1,100) . '.jpeg';
                    }
                }
                
                

                // Caminho completo onde a imagem será salva
                $caminhoCompleto1 = $diretorio . $nomeImagem;

                move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto1);
                $foto = $caminhoCompleto1;
                if($foto == ''):
                    $foto = 'img/produtos/anonimo.png';
                endif;
            endif;
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
            if ($acao != 'excluir'):
                if ($nome == '' || strlen($nome) < 3):
                    $mensagem .= '<li>Favor preencher o Nome. </li>';
                endif;
                if ($disponibilidade == ''):
                    $mensagem .= '<li>Favor preencher o Disponibilidade.</li>';
                endif;
                if ($tipo == ''):
                    $mensagem .= '<li>Favor preencher o Tipo.</li>';
                endif;
                if ($valor == ''):
                    $mensagem .= '<li>Favor preencher o Valor.</li>';
                endif;
                if ($_FILES["foto"] == ''):
                    $mensagem .= '<li>Favor selecionar uma Imagem.</li>';
                endif;
                if ($mensagem != ''):
                    $mensagem = '<ul>' . $mensagem . '</ul>';
                    echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                    exit;
                endif;
                
            endif;

                // Verifica se foi solicitada a inclusão de dados
            if ($acao == 'incluir'):

                $sql = 'INSERT INTO produtos (pro_nome, pro_tipo, pro_valor, pro_disponibilidade, pro_foto)
                                VALUES (:pro_nome, :pro_tipo, :pro_valor, :pro_disponibilidade, :pro_foto)';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':pro_nome', $nome);
                $stm->bindValue(':pro_tipo', $tipo);
                $stm->bindValue(':pro_valor', $valor);
                $stm->bindValue(':pro_foto', $foto);
                $stm->bindValue(':pro_disponibilidade', $disponibilidade);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
                else:
                    echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
                endif;

                echo "<meta http-equiv=refresh content= '1;URL=indexpro.php')";
            endif;

            // Verifica se foi solicitada a edição de dados
            if($acao == 'editar'):
                if($manter == false):
                    // Obtém o nome da imagem do banco de dados
                    $sql_select = 'SELECT pro_foto FROM produtos WHERE pro_id=:pro_id';
                    $stm_select = $conexao->prepare($sql_select);
                    $stm_select->bindValue(':pro_id', $id);
                    $stm_select->execute();
                    $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);
        
                    if ($resultado_select && $resultado_select['pro_foto'] != 'img/produtos/anonimo.png') {
                        $fotoexluir = $resultado_select['pro_foto'];
                        
                        // Verifica se o arquivo existe antes de tentar excluí-lo
                        if (file_exists($fotoexluir)) {
                            // Exclui a imagem do diretório
                            unlink($fotoexluir);
                        }
                        
                    } elseif($resultado_select && $resultado_select['pro_foto'] == 'img/produtos/anonimo.png') {
                        $foto = $caminhoCompleto1;
                    } elseif($resultado_select && $resultado_select['pro_foto'] == '') {
                        $foto = 'img/produtos/anonimo.png';
                    }
                    if($foto == '') {
                        $foto= 'img/produtos/anonimo.png';
                    }
                endif;
                if($manter==true):
                    $sql_select = 'SELECT pro_foto FROM produtos WHERE pro_id=:pro_id';
                    $stm_select = $conexao->prepare($sql_select);
                    $stm_select->bindValue(':pro_id', $id);
                    $stm_select->execute();
                    $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);
        
                    if($resultado_select['pro_foto'] == '' || $resultado_select['pro_foto'] == null):
                        $foto ='img/produtos/anonimo.png';
                    else:
                        $foto = $resultado_select['pro_foto'];
                    endif;
        
                endif;

                $sql = 'UPDATE produtos SET pro_nome=:pro_nome, pro_disponibilidade=:pro_disponibilidade, pro_tipo=:pro_tipo, pro_valor=:pro_valor, pro_foto=:pro_foto ';
                $sql .= ' WHERE pro_id=:pro_id';
                
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':pro_nome', $nome);
                $stm->bindValue(':pro_tipo', $tipo);
                $stm->bindValue(':pro_valor', $valor);
                $stm->bindValue(':pro_id', $id);
                $stm->bindValue(':pro_foto', $foto);
                $stm->bindValue(':pro_disponibilidade', $disponibilidade);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
                else:
                    echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
                endif;

                echo"<meta http-equiv=refresh content='3;URL=indexpro.php'>";
            endif;

            // Verifica se foi solicitada a exclusão dos dados
            if($acao == 'excluir'):
                // Obtém o nome da imagem do banco de dados
                $sql_select = 'SELECT pro_foto FROM produtos WHERE pro_id=:pro_id';
                $stm_select = $conexao->prepare($sql_select);
                $stm_select->bindValue(':pro_id', $id);
                $stm_select->execute();
                $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);
    
                if ($resultado_select && $resultado_select['pro_foto'] != 'img/produtos/anonimo.png') {
                    $fotoexluir = $resultado_select['pro_foto'];
                    
                    // Verifica se o arquivo existe antes de tentar excluí-lo
                    if (file_exists($fotoexluir)) {
                        // Exclui a imagem do diretório
                        unlink($fotoexluir);
                    }
                    
                }

                // Excluir o registro do banco de dados
                $sql = 'DELETE FROM produtos WHERE pro_id=:pro_id';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':pro_id', $id);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
                else:
                    echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
                endif;

                echo"<meta http-equiv=refresh content='3;URL=indexpro.php'>";
            endif;
    ?>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>