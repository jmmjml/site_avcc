<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quem somos? | AVCC</title>
    <link rel="stylesheet" href="css/carousel.css" />
    <link rel="stylesheet" href="header.html" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />

    <style>
        body {
            background-color: #f8f8f8;
        }

        .sla {
            margin: 0;
            padding: 0;
            padding-top: 5%;
            display: flex;
            justify-content: center;

        }

        .container {
            display: flex;
            width: 70%;
            margin-bottom: 20px;
            /* Espaço abaixo da div container */
        }

        h2 {
            color: black;
        }

        .texto {
            flex: 0 0 60%;
            background-color: white;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 4px;
            margin-right: 20px;
            /* Espaço entre texto e link */
        }

        .txt {
            font-size: 23px;
            color: #747d88;
            padding: 40px;
            /* Adicionado espaço interno */
            display: block;
            /* Certifica que o span ocupa a largura disponível */
        }

        .link span {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 10px;
        }

        .link ul {
            list-style-type: none;
            padding: 0;
        }

        .link li {
            margin: 10px 0;
        }

        .link a {
            text-decoration: none;
            color: #770099;
            /* Cor padrão dos links */
            transition: color 0.3s;
            font-size: 18px;
        }

        .link a:hover {
            color: orange;
            /* Cor laranja ao passar o mouse */
        }

        .titulohistoria {
            font-family: "Libre Franklin", sans-serif;
            text-align: start;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include_once "header.php" ?>
    <div class="sla">
        <div class="container">
            <div class="texto">
                <span class="txt">
                    <h2 class="titulohistoria">FAQ | AVCC</h2>
                    <p class="textonoticia" style="text-align: justify;">
                        Esclareça suas dúvidas aqui!
                        Esta seção foi criada para responder às perguntas mais comuns sobre as atividades e atuações da
                        Fundação do Câncer, incluindo como fazer doações, atualização de cadastro de doador, parcerias e
                        outros assuntos. Nosso compromisso é fornecer informações claras e objetivas para sanar as
                        dúvidas e
                        necessidades de quem nos procura.
                        <br><br>
                        Como doar para a Fundação do Câncer?
                        Acesse a área de doações em nosso site para saber como fazer sua contribuição. Se tiver alguma
                        dúvida, entre em contato conosco pelo telefone: (18)98827-1135
                        <br><br>
                        Como fazer doações de alimentos e outros produtos para a Fundação do Câncer?
                        Acesse a área de doações em nosso site para fazer sua contribuição, ou se prefirir entregar na
                        própria localização em qual estamos. Se tiver alguma dúvida, entre em contato conosco pelo
                        telefone:
                        (18)98827-1135
                        <br><br>
                        Como ser uma empresa parceira da Fundação do Câncer?
                        Há diversas formas de parceria com empresas. Algumas colaboram com doações regulares, outras
                        contribuem para projetos específicos. Para iniciar uma parceria, entre em contato conosco pelo
                        telefone (18)98827-1135 e apresentaremos as possibilidades conforme o perfil da sua empresa.
                    </p>
                </span>
            </div>
            <div class="link">
                <span class="topicostitulo">Veja Também</span>
                <ul>
                    <li><a href="index.php" class="topicos">Página Inicial</a></li>
                    <li><a href="governanca.php" class="topicos">Governança</a></li>
                    <li><a href="areadodoador.php" class="topicos">Seja um doador</a></li>
                    <li><a href="faq.php" class="topicos">FAQ</a></li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>