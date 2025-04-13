<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="./img/icon.ico" sizes="64x64" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Valdeci Gandaio </title>
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
                    <h2 class="titulohistoria">Homenagem Dona Valdeci | Ex-Diretora da AVCC</h2>


                    <div style="text-align: center;">
                        <img src="img/valdeci.png" alt="Dona Valdeci" title="Dona Valdeci"
                            style="width: 100%; max-width: 400px; height: auto; border-radius: 20px;">
                    </div>

                    <p class="textonoticia" style="text-align: justify;">
                        <br>
                        Prestamos nossa homenagem à querida Valdeci Gandaio, que
                        partiu, deixando um legado de dedicação, amor e luta incansável em prol de tantas vidas. Sua
                        trajetória à frente da AVCC foi marcada pela força, sensibilidade e comprometimento, sendo uma
                        verdadeira inspiração para todos que tiveram a honra de conhecê-la.
                        <br> <br>
                        Ela não só administrou uma instituição, mas transformou a realidade de muitos, oferecendo apoio,
                        esperança e um sorriso acolhedor em momentos difíceis. Seu trabalho fez a diferença e continuará
                        vivo em cada gesto de carinho que ela deixou por onde passou.
                        <br><br>
                        Embora sua ausência seja sentida profundamente, sabemos que seu exemplo de humanidade e coragem
                        seguirá iluminando nossos caminhos. Sua memória será sempre uma fonte de força para todos nós, e
                        sua missão, uma chama que jamais se apagará.
                        <br> <br>
                        Descanse em paz, Valdeci Gandaio. Sua missão de amor e cuidado permanece em nossos
                        corações.
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