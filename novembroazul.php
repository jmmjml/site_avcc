<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notícia</title>
    <link rel="stylesheet" href="css/carousel.css" />
    <link rel="stylesheet" href="header.html" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />

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
            flex-wrap: nowrap;
            /* Impede que os itens se movam para a próxima linha em telas maiores */
        }

        h2 {
            color: black;
        }

        .texto {
            flex: 0 0 60%;
            /* Mantém o tamanho em telas maiores */
            background-color: white;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 4px;
            margin-right: 20px;
        }

        .txt {
            font-size: 23px;
            color: #747d88;
            padding: 40px;
            /* Adicionado espaço interno */
            display: block;
            /* Certifica que o span ocupa a largura disponível */
        }

        .link {
            flex: 0 0 30%;
            /* Mantém a largura da seção de links em telas maiores */
            margin-top: 20px;
            /* Espaçamento entre o texto e a seção de links */
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
            text-align: center;
            margin-bottom: 10px;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                /* Empilha os elementos verticalmente em telas menores */
                width: 90%;
                /* Aumenta a largura do container em telas menores */
            }

            .texto {
                flex: 0 0 100%;
                /* Faz com que o texto ocupe 100% da largura em telas menores */
                margin-right: 0;
                /* Remove a margem direita em telas menores */
            }

            .link {
                flex: 0 0 100%;
                /* Faz com que a seção de links ocupe 100% da largura em telas menores */
                margin-top: 20px;
                /* Espaçamento entre o texto e a seção de links */
            }

            .txt {
                padding: 20px;
                /* Reduz o padding em telas menores */
                font-size: 20px;
                /* Ajusta o tamanho da fonte em telas menores */
            }

            .link span {
                font-size: 20px;
                /* Ajusta o tamanho do título da seção de links em telas menores */
            }

            .link a {
                font-size: 16px;
                /* Ajusta o tamanho da fonte dos links em telas menores */
            }

            /* Diminui levemente o tamanho da fonte quando responsivo */
            h2 {
                font-size: 20px;
                /* Ajusta o tamanho do título em telas menores */
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
                        <h2 class="titulohistoria">Novembro Azul: Uma Campanha pela Saúde Masculina</h2>

                        <div style="display: flex; justify-content: center; text-align: center;">
                            <img src="img/novembroazul.png" alt="Descrição da Imagem" style="max-height: 50vh; max-width: 100%; height: auto; width: auto;" />
                        </div>

                        <div class="textonoticia" style="border: none; display: block; text-align: justify; background-color: white; width: 100%; height: auto; min-height: 200px; padding: 10px; overflow: hidden; box-sizing: border-box;">
                            <br>
                            O Novembro Azul, campanha mundial de conscientização sobre a saúde do homem, ganha força a cada ano. O objetivo principal é alertar sobre a importância do diagnóstico precoce do câncer de próstata, um dos tipos mais comuns entre a população masculina.
                            <br>
                            <br>
                            <h3>
                                Por que o Novembro Azul é tão importante?
                            </h3>
                            <br>
                            O câncer de próstata, quando detectado em estágios iniciais, possui altas chances de cura. No entanto, muitos homens ainda evitam ir ao médico por diversos motivos, como medo, vergonha ou falta de informação.
                            <br>
                            <br>
                            <h3>
                                O que você pode fazer?
                            </h3>
                            <br>
                            <b>
                                Marque uma consulta com seu urologista: 
                            </b>
                            O exame de toque retal e o exame de sangue para dosagem do PSA (Antígeno Prostático Específico) são fundamentais para a detecção precoce do câncer de próstata.
                            <br>
                            <b>
                                Incentive outros homens a fazerem o mesmo: 
                            </b>
                            Converse com seus amigos, familiares e colegas de trabalho sobre a importância da prevenção.
                            <br>
                            <b>
                                Busque informações confiáveis: 
                            </b>    
                            Existem diversas fontes confiáveis de informação sobre o câncer de próstata na internet e em materiais impressos.
                            <br>
                            <br>
                            
                            <h3>
                            Além do câncer de próstata, o Novembro Azul também aborda outras questões relacionadas à saúde masculina, como:
                            </h3>
                            <br>
                            <b>
                                Saúde mental: 
                            </b>
                            A depressão e a ansiedade são problemas de saúde mental que afetam muitos homens. É importante buscar ajuda profissional quando necessário.
                            <br>
                            <b>
                                Doenças cardiovasculares: 
                            </b>
                            Doenças do coração são uma das principais causas de morte entre os homens. Uma alimentação saudável, prática regular de atividade física e controle da pressão arterial são essenciais para prevenir essas doenças.
                            <br>
                            <b>
                                Prevenção de outras doenças: 
                            </b>
                            O Novembro Azul é uma oportunidade para os homens se conscientizarem sobre a importância de realizar exames periódicos para detectar outras doenças, como diabetes e hipertensão.
                        </div>

                        <p style="text-align: end;">27/09/2024</p>
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