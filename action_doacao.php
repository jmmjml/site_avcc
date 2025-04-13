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
        $nomedoador = (isset ($_POST[ 'nomedoador'])) ? $_POST['nomedoador'] : '';
        $valor = (isset ($_POST['valor'])) ? $_POST['valor'] : '';
        $tipo = (isset ($_POST[ 'tipo'])) ? $_POST['tipo'] : '';
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if($tipo = "dinheiro"):
            if ($acao != 'excluir'):
                if ($nome == '' || strlen($nome) < 3):
                    $mensagem .= '<li>Favor preencher o Nome. </li>';
                endif;
                if ($nomedoador == ''):
                    $mensagem .= '<li>Favor preencher o Nome do Doador.</li>';
                endif;
                if ($tipo == ''):
                    $mensagem .= '<li>Favor preencher o Tipo.</li>';
                endif;
                if ($valor == ''):
                    $mensagem .= '<li>Favor preencher o Valor.</li>';
                endif;
                if ($mensagem != ''):
                    $mensagem = '<ul>' . $mensagem . '</ul>';
                    echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                    exit;
                endif;
                
            endif;

                // Verifica se foi solicitada a inclusão de dados
            if ($acao == 'incluir'):

                $sql = 'INSERT INTO doacoes (doa_nome, doa_nomedoador, doa_tipo, doa_valor)
                                VALUES (:doa_nome, :doa_nomedoador, :doa_tipo, :doa_valor)';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':doa_nome', $nome);
                $stm->bindValue(':doa_nomedoador', $nomedoador);
                $stm->bindValue(':doa_tipo', $tipo);
                $stm->bindValue(':doa_valor', $valor);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
                else:
                    echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
                endif;

                echo "<meta http-equiv=refresh content= '1;URL=indexdoa.php')";
            endif;

            // Verifica se foi solicitada a edição de dados
            if($acao == 'editar'):

                $sql = 'UPDATE doacoes SET doa_nome=:doa_nome, doa_nomedoador=:doa_nomedoador, doa_tipo=:doa_tipo, doa_valor=:doa_valor ';
                $sql .= ' WHERE doa_id=:doa_id';
                
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':doa_nome', $nome);
                $stm->bindValue(':doa_nomedoador', $nomedoador);
                $stm->bindValue(':doa_tipo', $tipo);
                $stm->bindValue(':doa_valor', $valor);
                $stm->bindValue(':doa_id', $id);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
                else:
                    echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
                endif;

                echo"<meta http-equiv=refresh content='3;URL=indexdoa.php'>";
            endif;

            // Verifica se foi solicitada a exclusão dos dados
            if($acao == 'excluir'):

                // Excluir o registro do banco de dados
                $sql = 'DELETE FROM doacoes WHERE doa_id=:doa_id';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':doa_id', $id);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
                else:
                    echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
                endif;

                echo"<meta http-equiv=refresh content='3;URL=indexdoa.php'>";
            endif;
        else:
            if ($acao != 'excluir'):
                if ($nome == '' || strlen($nome) < 3):
                    $mensagem .= '<li>Favor preencher o Nome. </li>';
                endif;
                if ($nomedoador == ''):
                    $mensagem .= '<li>Favor preencher o Nome do Doador.</li>';
                endif;
                if ($tipo == ''):
                    $mensagem .= '<li>Favor preencher o Tipo.</li>';
                endif;
                if ($mensagem != ''):
                    $mensagem = '<ul>' . $mensagem . '</ul>';
                    echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                    exit;
                endif;
                
            endif;

                // Verifica se foi solicitada a inclusão de dados
            if ($acao == 'incluir'):

                $sql = 'INSERT INTO doacoes (doa_nome, doa_nomedoador, doa_tipo, doa_valor)
                                VALUES (:doa_nome, :doa_nomedoador, :doa_tipo, :doa_valor)';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':doa_nome', $nome);
                $stm->bindValue(':doa_nomedoador', $nomedoador);
                $stm->bindValue(':doa_tipo', $tipo);
                $stm->bindValue(':doa_valor', $valor);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
                else:
                    echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
                endif;

                echo "<meta http-equiv=refresh content= '1;URL=cadastroprodutoed.php?nome=".$nome."')";
            endif;

            // Verifica se foi solicitada a edição de dados
            if($acao == 'editar'):

                $sql = 'UPDATE doacoes SET doa_nome=:doa_nome, doa_nomedoador=:doa_nomedoador, doa_tipo=:doa_tipo, doa_valor=:doa_valor ';
                $sql .= ' WHERE doa_id=:doa_id';
                
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':doa_nome', $nome);
                $stm->bindValue(':doa_nomedoador', $nomedoador);
                $stm->bindValue(':doa_tipo', $tipo);
                $stm->bindValue(':doa_valor', $valor);
                $stm->bindValue(':doa_id', $id);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
                else:
                    echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
                endif;

                echo"<meta http-equiv=refresh content='3;URL=indexdoa.php'>";
            endif;

            // Verifica se foi solicitada a exclusão dos dados
            if($acao == 'excluir'):

                // Excluir o registro do banco de dados
                $sql = 'DELETE FROM doacoes WHERE doa_id=:doa_id';
                $stm = $conexao->prepare($sql);
                $stm->bindValue(':doa_id', $id);
                $retorno = $stm->execute();

                if ($retorno):
                    echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
                else:
                    echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
                endif;

                echo"<meta http-equiv=refresh content='3;URL=indexdoa.php'>";
            endif;
        endif;
    ?>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>