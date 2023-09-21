<?php require_once("../../conexao/conexao.php"); ?>

<?php
//insercao no banco
    if(isset($_POST["cidade"])){
        $nome           = $_POST["nometransportadora"];           
        $endereco       = $_POST["endereco"]; 
        $cidade         = $_POST["cidade"]; 
        $estado         = $_POST["estados"]; 
        $telefone       = $_POST["telefone"];
        $cep            = $_POST["cep"];
        $cnpj           = $_POST["cnpj"];
        

        $inserir        = " INSERT INTO transportadoras ";
        $inserir        .= " (nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj) ";
        $inserir        .= " VALUES ('$nome', '$endereco', '$telefone', '$cidade', $estado, '$cep', '$cnpj') ";

        $operacao_inserir = mysqli_query($conecta, $inserir);
        if (!$operacao_inserir){
            die("falha na inserção");
        } else {
            header("location: listagem.php");
        }
    }


//selecao de estados
    $estados = " SELECT nome, estadoID FROM estados ";
    $linhaestados = mysqli_query($conecta, $estados);

    if(!$linhaestados) {
        die ('Falha no banco de dados');
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link rel="stylesheet" href="_css/crud.css">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
                <form action="inserir.php" method="post">
                    <input type="text" name="nometransportadora" placeholder="Nome da transportadora">
                    <input type="text" name="endereco" placeholder="Endereço">
                    <input type="text" name="cidade" placeholder="Cidade">
                    <select name="estados">
                        <?php
                            while ($linha = mysqli_fetch_assoc($linhaestados)){
                        ?>
                        <option value="
                        <?php echo $linha["estadoID"]?>
                        ">
                        <?php echo $linha["nome"]?>
                            </option>
                        <?php
                            }
                        ?>
                    </select>

                    <input type="text" name="telefone" placeholder="Telefone">
                    <input type="text" name="cep" placeholder="CEP">
                    <input type="text" name="cnpj" placeholder="CNPJ">
                    <input type="submit" value="ADICIONAR">


                </form>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>