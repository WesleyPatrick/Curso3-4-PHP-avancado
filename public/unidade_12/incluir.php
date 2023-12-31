<?php require_once("../../conexao/conexao.php"); ?>

<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if( isset($_POST['nomeproduto']) ) {
      $resultado1 = uploadArquivo($_FILES['foto_grande'], "images/product_images");
      $resultado2 = uploadArquivo($_FILES['foto_pequena'], "images/product_images");  

      $mensagem1 = $resultado1[0];
      $mensagem2 = $resultado2[0];
      
      //preenchimento das variaveis internas
      $nomeproduto = $_POST['nomeproduto'];
      $codigobarra = $_POST['codigobarra'];
      $tempoentrega = $_POST['tempoentrega'];
      $categoriaID = $_POST['categoriaID'];
      $fornecedorID = $_POST['fornecedorID'];
      $precounitario = $_POST['precounitario'];
      $precorevenda = $_POST['precorevenda'];
      $estoque = $_POST['estoque'];
      $imagemgrande = "images/product_images/" . $resultado1[1];
      $imagempequena = "images/product_images/" . $resultado2[1];
    

    //inserção no banco de dados

    $inserir = " INSERT INTO produtos ";
    $inserir .= " (nomeproduto, codigobarra, tempoentrega, categoriaID, fornecedorID, precounitario, precorevenda, estoque, imagemgrande, imagempequena) ";
    $inserir .= " VALUES ('$nomeproduto', '$codigobarra',  $tempoentrega, $categoriaID, $fornecedorID, $precounitario, $precorevenda, $estoque, '$imagemgrande','$imagempequena') ";


    $query_inserir = mysqli_query($conecta, $inserir);
        if(!$query_inserir) {
            die ("erro no banco de dados");
        } else {
            $mensagem = "inclusão realizada com sucesso!";
        }

    }
    // Consulta a tabela de categorias
    $categorias = "SELECT categoriaID, nomecategoria ";
    $categorias .= "FROM categorias ";
    $qCategorias = mysqli_query($conecta, $categorias);
    if(!$qCategorias) {
        die("Falha na consulta ao banco");   
    }

    // Consulta a tabela de fornecedores
    $fornecedores = "SELECT fornecedorID, nomefornecedor ";
    $fornecedores .= "FROM fornecedores ";
    $qFornecedores = mysqli_query($conecta, $fornecedores);
    if(!$qFornecedores) {
        die("Falha na consulta ao banco");   
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/inclusao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>  
        
        <main>
            <div id="janela_formulario">
                <form action="incluir.php" method="post" enctype="multipart/form-data">
                    <h2>Incluir Novo Produto</h2>
                    
                    <!-- campo de nome do produto e codigo de barra -->
                    <input type="text" name="nomeproduto" placeholder="Nome do Produto">
                    <input type="text" name="codigobarra" placeholder="Codigo de Barra">                      
                    
                    <!-- campo de tempo de entrega -->
                    <label>Tempo de Entrega</label>
                    <input type="radio" name="tempoentrega" value="5">5 dias
                    <input type="radio" name="tempoentrega" value="8">8 dias
                    <input type="radio" name="tempoentrega" value="15">15 dias
                    <input type="radio" name="tempoentrega" value="30">30 dias

                    <!-- campo de categorias -->
                    <label>Selecione a categoria do produto</label>
                    <select name="categoriaID">
                        <?php
                            while($linha = mysqli_fetch_assoc($qCategorias)) {
                        ?>
                            <option value="<?php echo $linha["categoriaID"];  ?>">
                                <?php echo $linha["nomecategoria"];  ?>
                            </option>
                        <?php
                            }
                        ?>                        
                    </select>
                    
                    <!-- campo de fornecedor -->
                    <label>Selecione o fornecedor do produto</label>
                    <select name="fornecedorID">
                        <?php
                            while($linha = mysqli_fetch_assoc($qFornecedores)) {
                        ?>
                            <option value="<?php echo $linha["fornecedorID"];  ?>">
                                <?php echo ($linha["nomefornecedor"]);  ?>
                            </option>
                        <?php
                            }
                        ?>                        
                    </select>                    
                    
                    <!-- campo de precos -->
                    <input type="text" name="precorevenda" placeholder="Preço Revenda">
                    <input type="text" name="precounitario" placeholder="Preço Unitário">                      
                    
                    <!-- campo de estoque -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="614400">
                    
                    <!-- campo de foto grande -->
                    <label>Foto Grande</label>
                    <input type="file"   name="foto_grande">
                    <span class="resposta">
                        <?php
                            if( isset($mensagem1) ) {
                                echo $mensagem1;
                            }    
                        ?>
                    </span>
                    
                    <!-- campo de foto pequena -->
                    <label>Foto Pequena</label>
                    <input type="file"   name="foto_pequena">
                    <span class="resposta">
                        <?php
                            if( isset($mensagem2) ) {
                                echo $mensagem2;
                            }
                        ?>
                    </span>
                    
                    <!-- campo escondido para iniciar estoque -->
                    <input type="hidden" name="estoque" value="0">
                    
                    <!-- botao submit -->
                    <input type="submit" value="Inserir novo produto">
                
                    <?php
                        if( isset($mensagem) ) {
                            echo "<p>" . $mensagem . "</p>";
                        }
                    ?>                                  
                </form>
                
              
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar as queries
    mysqli_free_result($qCategorias);
    mysqli_free_result($qFornecedores);
?>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>