<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
?>
<?php include "calculos.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .sub ol{list-style-type: lower-alpha}
            .sub{margin: 25px}
            .sub ol li{padding: 5px 0}
            label{font-weight: bolder}
            table, th, td, caption {
                border: 1px solid black;
            }
        </style>
        <script type="text/javascript" src="jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <h1>Trabalho de Probabilidade e Estatística</h1>
        <p><strong>Dados do exercício:</strong> 01 02 03 01 05 06 01 06 06 09 02 01 10 10 10 08 07 06 08 08 06 06 07 09 05 06 06 06 04 04</p>
        <form action="" method="POST">
            <label for="notas">Notas dos alunos de Estatística: </label><br />
            <textarea name="notas" id="notas"></textarea>
            <br />
            <input type="submit" value="Adicionar" />
        </form>
        
        <ol>
            <li class="sub">
                De acordo com os dados brutos responda?
                <ol>
                    <li><strong>Qual a Média?</strong> <br />
                        <?=@$media_bruto?>                    
                    </li>
                    <li><strong>Qual a Mediana?</strong><br />
                        <?=@$mediana_bruto?>
                    </li>
                    <li><strong>Qual a Moda?</strong><br />
                        <?=@$moda_bruto?>
                    </li>
                    <li><strong>Qual a Separatriz de 50%?</strong><br />
                        <?=@$separatriz_bruto?>
                    </li>
                </ol>
            </li>
            <li class="sub">
                Criar a tabela Nominal de acordo com os dados brutos e responda:                
                <ol>
                    <?=@$tabela_nominal?>
                    <li><strong>Qual a Média?</strong><br />
                        <?=@$media_nominal?>
                    </li>
                    <li><strong>Qual a Mediana?</strong><br />
                        <?=@$mediana_nominal?>
                    </li>
                    <li><strong>Qual a Moda?</strong><br />
                        <?=@$moda_nominal?>                    
                    </li>
                    <li><strong>Qual a Separatriz de 50%?</strong><br />
                        <?=@$separatriz_nominal?>
                    </li>
                </ol>
            </li>
            <li class="sub">
                Criar a tabela Intervalar de acordo com os dados brutos e responda:
                <ol>
                    <?=@$tabela_intervalar?>
                    <li><strong>Qual a Média?</strong><br />
                        <?=@$media_intervalar?>
                    </li>
                    <li><strong>Qual a Mediana?</strong><br />
                        <?=@$mediana_intervalar?>
                    </li>
                    <li><strong>Qual a Moda?</strong><br />
                        <?=@$moda_intervalar?>
                    </li>
                    <li><strong>Qual a Separatriz de 50%?</strong><br />
                        <?=@$separatriz_intervalar?>
                    </li>
                </ol>
            </li>
        </ol>
    </body>
</html>
