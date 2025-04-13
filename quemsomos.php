<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quem somos?</title>
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
            flex-direction: column;
            /* Muda para coluna em telas pequenas */
            width: 70%;
            /* Largura original */
            max-width: 1200px;
            /* Largura máxima para grandes telas */
            margin-bottom: 20px;
        }

        h2 {
            color: black;
        }

        .texto {
            flex: 1;
            /* Permitir que o texto ocupe o espaço disponível */
            background-color: white;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
            /* Espaço entre texto e link */
        }

        .txt {
            font-size: 1.5rem;
            /* Usar rem para responsividade */
            color: #747d88;
            padding: 2.5rem;
            /* Usar rem */
            display: block;
        }

        .link {
            margin-top: 20px;
            /* Espaço acima do link */
        }

        .link span {
            font-size: 1.5rem;
            /* Usar rem */
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
            transition: color 0.3s;
            font-size: 1rem;
            /* Usar rem */
        }

        .link a:hover {
            color: orange;
        }

        .titulohistoria {
            font-family: "Libre Franklin", sans-serif;
            text-align: start;
            margin-bottom: 10px;
        }

        /* Media Queries para responsividade */
        @media (min-width: 768px) {
            .container {
                flex-direction: row;
                /* Muda para linha em telas maiores */
            }

            .texto {
                flex: 0 0 60%;
                /* 60% da largura do container */
                margin-right: 20px;
                /* Espaço entre texto e link */
            }

            .link {
                flex: 0 0 30%;
                /* 30% da largura do container */
            }
        }
    </style>
</head>

<body>
    <?php include_once "header.php" ?>
    <div class="sla">
        <div class="container">
            <div class="texto">
                <span class="txt">
                    <h2 class="titulohistoria">Nossa história | AVCC</h2>
                    <p class="textonoticia" style="text-align: justify;">
                        A Associação Venceslauense de Combate ao Câncer (AVCC) foi fundada no ano de 1983 no município
                        de
                        Presidente Venceslau, com o objetivo primordial de oferecer apoio e orientação a pacientes que
                        enfrentam dificuldades para iniciar o tratamento contra o câncer. Desde sua fundação, a AVCC tem
                        se
                        dedicado a prestar suporte às pessoas que necessitam de cuidados médicos e psicológicos,
                        promovendo
                        também ações educativas sobre a prevenção e o diagnóstico precoce da doença.
                        <br><br>
                        Atualmente, a AVCC é presidida por Nadir da Silva Almeida e tem sua sede localizada à Rua
                        Regente Feijó,
                        número 68, no centro de Presidente Venceslau. A entidade segue cumprindo sua missão de
                        proporcionar
                        um atendimento humanizado e de qualidade, contribuindo para o bem-estar e a recuperação dos
                        pacientes atendidos, além de incentivar a conscientização sobre a importância do tratamento
                        adequado
                        e da luta contra o câncer.
                        <br><br>
                        Desde sua fundação, a AVCC tem se consolidado como uma referência de assistência social e saúde
                        no
                        município e região. Ao longo dos anos, a associação desenvolveu diversas iniciativas para captar
                        recursos e garantir a continuidade de seus serviços, que incluem o fornecimento de medicamentos,
                        transporte para tratamentos em centros especializados, apoio psicológico e nutricional, além de
                        promover campanhas de conscientização sobre a doença. A atuação da AVCC também envolve a
                        parceria
                        com profissionais da saúde e organizações locais, permitindo um atendimento mais eficaz e
                        integrado
                        aos pacientes e suas famílias.
                        <br><br>
                        A associação, além de sua atuação voltada para o atendimento direto aos pacientes, também
                        realiza
                        ações educativas e preventivas, visando ampliar o conhecimento da comunidade sobre o câncer e a
                        importância do diagnóstico precoce. A AVCC é um exemplo de solidariedade e compromisso social,
                        contando com a colaboração de voluntários e parceiros que se engajam para que a entidade
                        continue
                        cumprindo seu papel fundamental na luta contra o câncer, proporcionando esperança e apoio a quem
                        mais precisa. Através de suas diversas atividades e serviços, a AVCC reafirma seu compromisso
                        com a
                        vida e com a promoção da saúde, desempenhando um papel indispensável na melhoria da qualidade de
                        vida dos pacientes que atendem.
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