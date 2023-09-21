<?php 
    require_once("../../conexao/conexao.php");


    //PASSO03 consulta (.= concatena com a linha de cima)
    $consulta_produtos = "SELECT nomeproduto, precounitario, tempoentrega ";
    $consulta_produtos .= " FROM produtos";
    $consulta_produtos .= " WHERE tempoentrega = 5";

    $produtos = mysqli_query($conecta, $consulta_produtos);

    if( !$produtos) {
        die("falha na consulta de banco de dados");
    }
    
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP - Integração com MySQL</title>
    </head>
    <body>
       <?php
            while( $registro = mysqli_fetch_array($produtos)) {
        ?>
        <ul>
            <li>
                <?php
                echo $registro["nomeproduto"] . " ";
                ?>
                </li>
        </ul>
        <?php
            }
       ?>

        <?php
            mysqli_free_result($produtos);
       ?>
    </body>
</html>


<?php
    
    mysqli_close($conecta);
    //fecha a conexão do banco de dados com o mysqli_close onde dentro do () se coloca a variavel que inicia a conexão
?>