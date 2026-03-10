<?php
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y H:i:s");/*Com "H" maiusculo ele fica no nosso formato de 24h*/
    echo "<p>Data: $data</p>";
    $valor = 1505.88888;/*Digitar um valor direto na variavel deve ser com "." */
    $valor_arredondado = round($valor);
    echo "<p>Valor Arredondado: $valor_arredondado</p>";
    $valor_formatado = number_format($valor, 2, ",", ".");
    echo "<p>Valor sem formatação: $valor</p>";
    echo "<p>Valor formatado: $valor_formatado</p>";
    //Exponenciação
    $exp = pow(3,4);
    //Raiz quadrada
    $raiz = sqrt(16);
    //Números aleatorios
    $aleatorio = rand(1, 100);
    if(isset($nome)){
        echo "<p>Nome infomado!</p>";
    }
    else{
        echo "<p>Nome não informado!</p>";
        die();//a partir daqui não executa mais nada
    }
    if (is_float($valor)){
        echo "<p>É um número flutuante!</p>";
    }

?>