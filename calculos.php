<?php
if( isset($_POST['notas']) && !empty($_POST['notas']) ):
    
    $notas = explode( " ", $_POST['notas'] );
    
    $media_bruto = calculaMediaBruto($notas);
    $mediana_bruto = calcularMedianaBruto($notas);
    $moda_bruto = calcularModaBruto($notas);
    $separatriz_bruto = calcularSeparatrizBruto($notas, 50);
    
    $tabela_nominal = montaTabelaNominal($notas);
    $media_nominal = calcularMediaNominal($notas);
    $mediana_nominal = calcularMedianaNominal($notas);
    $moda_nominal = calcularModaNominal($notas);
    $separatriz_nominal = calcularSeparatrizNominal($notas, 50);
    
    $tabela_intervalar = montaTabelaIntervalar($notas);
    $media_intervalar = calcularMediaIntervalar($notas);
    $mediana_intervalar = calcularMedianaIntervalar($notas);
    $moda_intervalar = calcularModaIntervalar();
    $separatriz_intervalar = calcularSeparatrizIntervalar($notas, 50);
endif;

function formatNumber( $num ) {
    return intval(( $num * 100 ))/100;
}

//Dados Bruto

function calculaMediaBruto( $dados ) {
    $soma = array_sum($dados);
    $qtd = count($dados);
    $media = $soma / $qtd;
    
    return "Soma das notas: $soma <br />
    Quantidade de alunos: $qtd <br />
    Média: $soma / $qtd = ".number_format($media, 2)."";
    
}

function calcularMedianaBruto( $dados ) {
    asort( $dados );
    $qtd = count($dados);
    
    $i = 0;
    $tabela = "Deixando dados em ordem crescente<br />"
            . "<table><tr><th>Índice</th><th>Nota</th></tr>";
    foreach ( $dados as $nota ){
        $ordem[++$i] = $nota;
        $tabela .= "<tr id='{$i}' ><td>". $i  ."</td><td>$nota</td></tr>";
    }
    $tabela .= "</table><br />";
    
    $indice = ( ($qtd + 1) / 2 );    
    if( $qtd % 2 > 0 ) {
        $mediana = $ordem[$indice];
        $calculo = "Como a amostra é um valor ímpar procura-se o valor intermediário<br />";
        $calculo .= "($qtd + 1) / 2 = $indice";
        $mediana = "<p>Mediana = $mediana</p>";
        $javascript = '<script>$(document).ready(function(){'
                                  . '$(\'#'.$indice.'\').css(\'background\', \'#FFFF00\' );'
                             . '});'
                    . '</script>';
    } else {
        $mediana = ( $ordem[(int)$indice] + $ordem[ ( (int) $indice ) + 1] ) / 2;        
        $calculo = "Como a amostra é um valor par procura-se a media dos valores intermediário<br />";
        $calculo .= "($qtd + 1) / 2 = $indice";
        $mediana = "<p>Mediana = ( {$ordem[$indice]} + {$ordem[$indice + 1]} ) / 2 = $mediana</p>";
        $javascript = '<script>$(document).ready(function(){'
                                . '$(\'#'.(int)$indice.'\').css(\'background\', \'#FFFF00\' );'
                                . '$(\'#'.(((int)$indice) + 1).'\').css(\'background\', \'#FFFF00\' );'
                            . '});'
                     . '</script>';
    }
    
    return $tabela.$calculo.$mediana.$javascript;            
}

function calcularModaBruto( $dados ) {
    $dados_agrupados = array_count_values( $dados );
    
    $aux = 0;
    foreach ( $dados_agrupados as $i => $qtd ){
        if( $qtd > $aux ) {
            $moda = $i;
            $aux = $qtd;
        }
    }
    
    return "A moda é $moda por que aparece $aux vezes na amostra de ".  array_sum($dados_agrupados)." valores.";
}

function calcularSeparatrizBruto( $dados, $k ) {
    asort( $dados );
    $qtd = count($dados);
    
    $ordem = "Dados em ordem crescente: ";
    $i = 0;
    foreach ( $dados as $dado ){
        $ordem_a[++$i] = $dado;
        $ordem .= "$dado, ";
    }
    
    $pos = ( $k * $qtd ) / 100;
    $posicao = "<br />Calcular posição: <br />";
    $posicao .= " ( $k * $qtd ) / 100 = $pos<br />";
    $separatriz = "O valor na posicao $pos é {$ordem_a[$pos]}";
    
    return $ordem.$posicao.$separatriz;
}

//Tabela nominal

function montaTabelaNominal( $dados ) {
    $dados_agrupados = array_count_values( $dados );
    ksort($dados_agrupados);
    
    $i = 0;
    $fa = 0;
    $tabela = "<br />Tabela nominal<br />"
            . "<table><caption>Notas dos Alunos da turma de Estatística </caption><tr><th>i</th>"
            . "<th>Notas (xi)</th><th>Frequencias (fi)</th><th>xi * fi</th><th>Fa</th></tr>";
    foreach ( $dados_agrupados as $nota => $freq ){
        $tabela .= "<tr><td>". ++$i  ."</td><td>$nota</td><td>$freq</td><td>". $nota * $freq."</td><td>".$fa += $freq."</td></tr>";
    }
    $tabela .= "<tr><td>TOTAL</td><td></td><td>".array_sum($dados_agrupados)."</td><td>".array_sum($dados)."</td><td></td></tr>";
    $tabela .= "</table><br />";
    
    return $tabela;
}

function calcularMediaNominal( $dados ) {
    $dados_agrupados = array_count_values( $dados );
    $media =  array_sum($dados) / array_sum($dados_agrupados);
    
    $calculo = "Média = ".array_sum($dados)." / ".array_sum($dados_agrupados)." = ".number_format($media, 2)."";
    
    return $calculo;
}

function calcularMedianaNominal( $dados ) {
    $dados_agrupados = array_count_values( $dados );
    ksort($dados_agrupados);
    $qtd = count($dados);
    $pos = ($qtd + 1) / 2;
    $fai = 0;
    
    $posicao = "Posição central = ( $qtd + 1 ) / 2 = $pos";
    
    foreach ( $dados_agrupados as $nota => $freq ){
        $fai += $freq;
        if( $fai >= $pos ) {
            $mediana = $nota;
            break;
        }
    }
    
    $mediana = "<br />Primeiro valor maior que $pos é $fai, logo a mediana é $mediana";
    
    return $posicao.$mediana;
    
}

function calcularModaNominal( $dados ) {
    $dados_agrupados = array_count_values( $dados );
    
    $moda = 0;
    $freq = 0;
    foreach ( $dados_agrupados as $dado => $key ) {
        if( $key >= $freq ) {
            $freq = $key;
            $moda = $dado;
        }
    }
    
    $moda = "A moda é $moda, por que tem frequência $freq.";
    
    return $moda;
}

function calcularSeparatrizNominal( $dados, $k ) {
    $dados_agrupados = array_count_values( $dados );
    ksort($dados_agrupados);
    $qtd = count($dados);
    
    $pos = ( $k * $qtd ) / 100;
    $posicao = "Posição central = ( $k * $qtd ) / 100 = $pos<br />";
    
    $fai = 0;
    foreach ( $dados_agrupados as $nota => $freq ){
        $fai += $freq;
        if( $fai >= $pos ) {
            $separatriz = $nota;
            break;
        }
    }
    
    $separatriz = "A separatriz é $separatriz.";
    
    return $posicao.$separatriz;    
}

//Intervalar
$GLOBALS['intervalar'];
function montaTabelaIntervalar( $dados ) {
    global $intervalar;
    $qtd = count($dados);
    //Amplitude amostral
    $aa = max($dados) - min($dados);
    //Número de classes
    $i = formatNumber( 1 + 3.3 * (log10($qtd)) );
    //Amplitude do intervalo da classe;
    $h = formatNumber($aa / $i );
    $i = ceil($i);
    
    $xifi = $fai = $li = 0;
    $tabela = "<br />Tabela Intervalar<br />"
            . "<table><caption>Notas dos Alunos da turma de Estatística </caption>"
            . "<tr><th>i</th><th>Notas</th><th>Frequencias (fi)</th><th>xi</th><th>xi * fi</th><th>Fai</th></tr>";
    for( $j = 1; $j <= $i; $j++ ){
        $fi = 0;
        ($j == 1) ? $li = min($dados) : $li += $h;
        $ls = ($li + $h);
        $xi = formatNumber( ($li + $ls) / 2 );
        
        foreach ($dados as $dado)
            if( $dado >= $li && $dado < $ls )
                $fi++;    
        
        $xifii = $xi * $fi;
        $xifi += $xifii;
        $fai += $fi;    
        
        $tabela .= "<tr><td>$j</td><td>$li |- $ls</td><td>$fi</td><td>$xi</td><td>$xifii</td><td>$fai</td></tr>";
        $intervalar[$j] = array(
            'li'        => $li, 
            'ls'        => $ls,
            'fi'        => $fi,
            'xi'        => $xi,
            'xifi'      => $xifii,
            'fai'       => $fai,
        );
    }    
    
    $tabela .= "<tr><td>TOTAL</td><td></td><td>".array_sum($dados)."</td><td></td><td>$xifi</td><td></td></tr>";
    $tabela .= "</table><br />";
    
    return $tabela;
}

function calcularMediaIntervalar( $dados ) {
    global $intervalar;
    
    $qtd = count($dados);
    $xifi = 0;
    foreach ($intervalar as $linha)
        $xifi += $linha['xifi'];
    
    $media = formatNumber($xifi / $qtd);
    
    $media = "Média = $xifi / $qtd = $media";
    
    return $media;
}

function calcularMedianaIntervalar( $dados ) {
    global $intervalar;
    
    $qtd = count($dados);
    $pos = ($qtd + 1) / 2;
    $posicao = "Posição central = ($qtd + 1) / 2 = $pos<br />";
    
    foreach ($intervalar as $i => $dado) {
        if( $dado['fai'] >= $pos ) {
            break;
        }
    }
    
    $classe = "A classe da mediana é $i, porque é o primeiro valor maior que $pos.<br />";
    $li = $intervalar[$i]['li'];
    $fi = $intervalar[$i]['fi'];
    $hi = $intervalar[$i]['ls'] - $li;
    $faa = $intervalar[$i-1]['fai'];
    
    $mediana = formatNumber( $li + ( ( (($qtd /2) - $faa) / $fi ) * $hi ) );
    $mediana = "Mediana = $li + ( ( (($qtd / 2) - $faa) / $fi ) * $hi ) = $mediana";
    
    return $posicao.$classe.$mediana;
}

function calcularModaIntervalar() {
    global $intervalar;
    
    $aux = $ir = 0;
    foreach ($intervalar as $i => $dado)
        if($dado['fi'] >= $aux) {
            $aux = $dado['fi'];
            $ir = $i;
        }
    
    $li = $intervalar[$ir]['li'];
    $hi = $intervalar[$ir]['ls'] - $li;
    $fi = $intervalar[$ir]['fi'];
    $d1 = $fi - $intervalar[$ir-1]['fi'];
    $d2 = $fi - $intervalar[$ir+1]['fi'];
    
    $moda = $li + ( $d1 / ($d1 + $d2 ) ) * $hi;
    $moda = "Moda = $li + ( $d1 / ($d1 + $d2 ) ) * $hi = $moda";
    
    return $moda;
}

function calcularSeparatrizIntervalar( $dados, $k ) {
    global $intervalar;
    
    $qtd = count($dados);
    $pos = ( $k * $qtd ) / 100;
    
    $posicao = "A posição central é ( $k * $qtd ) / 100 = $pos<br />";
    
    foreach ($intervalar as $i => $dado)
        if($dado['fai'] >= $pos)
            break;
    
    $li = $intervalar[$i]['li'];
    $faa = $intervalar[$i-1]['fai'];
    $fi = $intervalar[$i]['fi'];
    $hi = $intervalar[$i]['ls'] - $li;
     
    $separatriz = $li + ((((($k * $qtd) / 100) - $faa) / $fi)) * $hi;
    $separatriz = "Separatriz = $li + ((((($k * $qtd) / 100) - $faa) / $fi)) * $hi = $separatriz";
    
    return $posicao.$separatriz;
}