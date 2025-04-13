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
        $nomeevento = (isset ($_POST['nomeevento'])) ? $_POST['nomeevento'] : '';
        $nometitular = (isset ($_POST['nometitular'])) ? $_POST['nometitular'] : '';
        $descricao = (isset ($_POST[ 'descricao'])) ? $_POST['descricao'] : '';
        $celular = (isset ($_POST ['celular'])) ? str_replace(array('-',' '), '',$_POST['celular']) : '';
        $data_evento = (isset ($_POST['data'])) ? $_POST['data'] : '';
        $status = (isset ($_POST['status'])) ? $_POST['status'] : '';
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($nomeevento == '' || strlen($nomeevento) < 3):
                $mensagem .= '<li>Favor preencher o Nome do evento. </li>';
            endif;
            if ($nometitular == '' || strlen($nometitular) < 3):
                $mensagem .= '<li>Favor preencher o Nome do titular do evento. </li>';
            endif;
            
            if ($descricao == ''):
                $mensagem .= '<li>Favor preencher a Descrição.</li>';
            endif;
            if ($data_evento == ''):
                $mensagem .= '<li>Favor preencher a Data do evento.</li>';
            else:
                $data = explode('/', $data_evento);
                if (!checkdate($data[1], $data[0], $data[2])):
                    $mensagem .= '<li>Formato da Data inválido.</li>';
                endif;
            endif;
            if ($celular == ''):
                $mensagem .= '<li>Favor preencher o Celular.</li>';
            elseif (strlen($celular) < 11):
                $mensagem .= '<li>Formato do Celular inválido. </li>';
            endif;
            if($status == ''):
                $status = 'aguardando';
            endif;
            if ($status == ''):
                $mensagem .= '<li>Favor preencher o Status.</li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                exit;
            endif;
            // Constrói a data no formato ANSI yyyy/mm/dd
            $data_temp  = explode('/', $data_evento);
            $data_ansi = $data_temp[2] . '/' . $data_temp[1] . '/' . $data_temp[0];
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):

        $sql = 'INSERT INTO eventos (eve_data, eve_nome, eve_descricao, eve_nometitular, eve_celular, eve_status)
                        VALUES (:eve_data, :eve_nome, :eve_descricao, :eve_nometitular, :eve_celular, :eve_status)';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':eve_nome', $nomeevento);
        $stm->bindValue(':eve_nometitular', $nometitular);
        $stm->bindValue(':eve_status', $status);
        $stm->bindValue(':eve_data', $data_ansi);
        $stm->bindValue(':eve_descricao', $descricao);
        $stm->bindValue(':eve_celular', $celular);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        else:
            echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
        endif;

        echo "<meta http-equiv=refresh content= '1;URL=indexevento.php')";
    endif;

    // Verifica se foi solicitada a edição de dados
    if($acao == 'editar'):
        

        $sql = 'UPDATE eventos SET eve_nometitular=:eve_nometitular, eve_nome=:eve_nome, eve_status=:eve_status, eve_data=:eve_data, eve_descricao=:eve_descricao, eve_celular=:eve_celular';
        $sql .= ' WHERE eve_id=:eve_id';
        
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':eve_nome', $nomeevento);
        $stm->bindValue(':eve_nometitular', $nometitular);
        $stm->bindValue(':eve_status', $status);
        $stm->bindValue(':eve_data', $data_ansi);
        $stm->bindValue(':eve_descricao', $descricao);
        $stm->bindValue(':eve_celular', $celular);
        $stm->bindValue(':eve_id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexevento.php'>";
    endif;

    // Verifica se foi solicitada a exclusão dos dados
    if($acao == 'excluir'):
        
        
        // Excluir o registro do banco de dados
        $sql = 'DELETE FROM eventos WHERE eve_id=:eve_id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':eve_id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexevento.php'>";
    endif;
    ?>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>