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
        $cpf = (isset ($_POST['cpf'])) ? str_replace(array('.','-'), '', $_POST['cpf']) : '';
        $sobrenome = (isset ($_POST['sobrenome'])) ? $_POST['sobrenome'] : '';
        $disponibilidade = (isset ($_POST[ 'disponibilidade'])) ? $_POST['disponibilidade'] : '';
        $senha = (isset ($_POST['senha'])) ? $_POST['senha'] : '';
        $data_nascimento = (isset ($_POST['data_nascimento'])) ? $_POST['data_nascimento'] : '';
        $cargo = (isset ($_POST[ 'cargo'])) ? $_POST['cargo'] : '';
        $celular = (isset ($_POST ['celular'])) ? str_replace(array('-',' '), '',$_POST['celular']) : '';
        $foto = (isset($_POST['foto'])) ? $_POST['foto'] : '';
        $manter = (isset($_POST['manter'])) ? $_POST['manter'] : '';

        // Verifica se o arquivo foi enviado sem erros
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK):
        
                // Diretório onde a imagem será salva
                $diretorio = 'img/colaboradores/';
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
                    $foto = 'img/colaboradores/anonimo.png';
                endif;
            endif;
        // Valida os dados recebidos
        $mensagem = '';
        // Se for ação diferente de excluir valida os dados obrigatórios
        if ($acao != 'excluir'):
            if ($cargo == ''):
                $cargo = 'Colaborador';
            endif;
            if ($nome == '' || strlen($nome) < 3):
                $mensagem .= '<li>Favor preencher o Nome. </li>';
            endif;
            if ($sobrenome == '' || strlen($sobrenome) < 3):
                $mensagem .= '<li>Favor preencher o Sobrenome. </li>';
            endif;
            if ($cpf == ''):
                $mensagem .= '<li>Favor preencher o CPF.</li>';
            elseif(strlen($cpf) < 11):
                $mensagem .= '<li>Formato do CPF inválido.</li>';
            endif;
            if($disponibilidade == ''):
                $disponibilidade = 'Sim';
            endif;
            if ($disponibilidade == ''):
                $mensagem .= '<li>Favor preencher a Disponibilidade.</li>';
            endif;
            if ($senha == ''):
                $mensagem .= '<li>Favor preencher a Senha.</li>';
            endif;
            if ($data_nascimento == ''):
                $mensagem .= '<li>Favor preencher a Data de Nascimento.</li>';
            else:
                $data = explode('/', $data_nascimento);
                if (!checkdate($data[1], $data[0], $data[2])):
                    $mensagem .= '<li>Formato da Data de Nascimento inválido.</li>';
                endif;
            endif;
            if ($cargo == ''):
                $mensagem .= '<li>Favor preencher o Cargo.</li>';
            endif;
            if ($celular == ''):
                $mensagem .= '<li>Favor preencher o Celular.</li>';
            elseif (strlen($celular) < 11):
                $mensagem .= '<li>Formato do Celular inválido. </li>';
            endif;
            if ($mensagem != ''):
                $mensagem = '<ul>' . $mensagem . '</ul>';
                echo "<div class='alert alert-danger' role='alert'>" . $mensagem. "</div> ";
                exit;
            endif;
            // Constrói a data no formato ANSI yyyy/mm/dd
            $data_temp  = explode('/', $data_nascimento);
            $data_ansi = $data_temp[2] . '/' . $data_temp[1] . '/' . $data_temp[0];
        endif;

        // Verifica se foi solicitada a inclusão de dados
        if ($acao == 'incluir'):
            
            
            if($foto ==''):
                $foto = 'img/colaboradores/anonimo.png';
            endif;

        $sql = 'INSERT INTO colaboradores (col_nome, col_sobrenome, col_cpf, col_cargo, col_senha, col_datanasc, col_disponibilidade, col_celular, col_foto)
                        VALUES (:col_nome, :col_sobrenome,:col_cpf , :col_cargo, :col_senha, :col_datanasc, :col_disponibilidade, :col_celular, :col_foto)';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':col_nome', $nome);
        $stm->bindValue(':col_sobrenome', $sobrenome);
        $stm->bindValue(':col_cpf', $cpf);
        $stm->bindValue(':col_senha', $senha);
        $stm->bindValue(':col_cargo', $cargo);
        $stm->bindValue(':col_datanasc', $data_ansi);
        $stm->bindValue(':col_disponibilidade', $disponibilidade);
        $stm->bindValue(':col_celular', $celular);
        $stm->bindValue(':col_foto', $foto);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role= 'alert'>Registro inserido com sucesso, aguarde você está sendo redirecionado ...</div> ";
        else:
            echo "<div class= 'alert alert-danger' role= 'alert'>Erro ao inserir registro!</div> ";
        endif;

        echo "<meta http-equiv=refresh content= '1;URL=indexcolaborador.php')";
    endif;

    // Verifica se foi solicitada a edição de dados
    if($acao == 'editar'):
        if($manter == false):
            // Obtém o nome da imagem do banco de dados
            $sql_select = 'SELECT col_foto FROM colaboradores WHERE col_id=:col_id';
            $stm_select = $conexao->prepare($sql_select);
            $stm_select->bindValue(':col_id', $id);
            $stm_select->execute();
            $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

            if ($resultado_select && $resultado_select['col_foto'] != 'img/colaboradores/anonimo.png') {
                $fotoexluir = $resultado_select['col_foto'];
                
                // Verifica se o arquivo existe antes de tentar excluí-lo
                if (file_exists($fotoexluir)) {
                    // Exclui a imagem do diretório
                    unlink($fotoexluir);
                }
                
            } elseif($resultado_select && $resultado_select['col_foto'] == 'img/colaboradores/anonimo.png') {
                $foto = $caminhoCompleto1;
            } elseif($resultado_select && $resultado_select['col_foto'] == '') {
                $foto = 'img/colaboradores/anonimo.png';
            }
            if($foto == '') {
                $foto= 'img/colaboradores/anonimo.png';
            }
        endif;
        if($manter==true):
            $sql_select = 'SELECT col_foto FROM colaboradores WHERE col_id=:col_id';
            $stm_select = $conexao->prepare($sql_select);
            $stm_select->bindValue(':col_id', $id);
            $stm_select->execute();
            $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

            if($resultado_select['col_foto'] == '' || $resultado_select['col_foto'] == null):
                $foto ='img/colaboradores/anonimo.png';
            else:
                $foto = $resultado_select['col_foto'];
            endif;

        endif;

        $sql = 'UPDATE colaboradores SET col_sobrenome=:col_sobrenome, col_foto=:col_foto, col_nome=:col_nome, col_cpf=:col_cpf, col_disponibilidade=:col_disponibilidade, col_cargo=:col_cargo, col_datanasc=:col_datanasc, col_senha=:col_senha, col_celular=:col_celular ';
        $sql .= ' WHERE col_id=:col_id';
        
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':col_nome', $nome);
        $stm->bindValue(':col_sobrenome', $sobrenome);
        $stm->bindValue(':col_cpf', $cpf);
        $stm->bindValue(':col_senha', $senha);
        $stm->bindValue(':col_disponibilidade', $disponibilidade);
        $stm->bindValue(':col_datanasc', $data_ansi);
        $stm->bindValue(':col_cargo', $cargo);
        $stm->bindValue(':col_celular', $celular);
        $stm->bindValue(':col_foto', $foto);
        $stm->bindValue(':col_id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro editado com sucesso, aguarde você está sendo redirecionado ...</div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao editar registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexcolaborador.php'>";
    endif;

    // Verifica se foi solicitada a exclusão dos dados
    if($acao == 'excluir'):
        
        // Obtém o nome da imagem do banco de dados
        $sql_select = 'SELECT col_foto FROM colaboradores WHERE col_id=:col_id';
        $stm_select = $conexao->prepare($sql_select);
        $stm_select->bindValue(':col_id', $id);
        $stm_select->execute();
        $resultado_select = $stm_select->fetch(PDO::FETCH_ASSOC);

        if ($resultado_select) {
            $foto = $resultado_select['col_foto'];
            
            // Verifica se o arquivo existe antes de tentar excluí-lo
            if (file_exists($foto)) {
                // Exclui a imagem do diretório
                unlink($foto);
            }
        }

        // Excluir o registro do banco de dados
        $sql = 'DELETE FROM colaboradores WHERE col_id=:col_id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':col_id', $id);
        $retorno = $stm->execute();

        if ($retorno):
            echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso, aguarde você está sendo redirecionado ...<div>";
        else:
            echo "<div class='alert alert-danger' role='alert'>Erro ao excluir registro!</div>";
        endif;

        echo"<meta http-equiv=refresh content='3;URL=indexcolaborador.php'>";
    endif;
    ?>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>