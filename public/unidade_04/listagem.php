
<?php
//conecta o arquivo conexao.php com o arquivo listagem.php
require_once("../../conexao/conexao.php"); ?>


<?php
    //consulta ao banco de dados
    $produtos = "SELECT produtoID, nomeproduto, tempoentrega, precounitario, imagempequena ";
    $produtos .= " FROM produtos ";

    //cria variavel para o resultado da consulta
    $resultado = mysqli_query($conecta, $produtos);
    //se não tiver resultado informa que ocorreu erro
    if (!$resultado) {
        die("falha na consulta de banco de dados");
    }
    
?>


<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/produtos.css" rel="stylesheet">
    </head>

    <body>
        
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>
        
        <main>
        <div id="listagem_produtos">  
            <?php
                //cria um while para listar cada linha do resultado do banco de dados, criando um array com os resultados, e colocando esses resultados da array dentro da variavel $linha
                while($linha = mysqli_fetch_assoc($resultado)){
            ?>
                <ul>
                    <li class="imagem"><img src="
                    <?php echo $linha["imagempequena"]?>" alt=""></li>

                    <li><h3><?php echo $linha["nomeproduto"]?></h3></li>

                    <li>Tempo entrega: <?php echo $linha["tempoentrega"]?></li>

                    <li>Preço unitário: <?php echo real_format($linha["precounitario"])?></li>


                </ul>
            <?php
                }
            ?>
            </div>   
        </main>
             
        <?php include_once("../_incluir/rodape.php"); ?> 
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>