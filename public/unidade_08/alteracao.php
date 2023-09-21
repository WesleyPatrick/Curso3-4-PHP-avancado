<?php require_once("../../conexao/conexao.php"); ?>

<?php
    if(isset($_POST["cidade"])){
            $nome           = $_POST["nometransportadora"];           
            $endereco       = $_POST["endereco"]; 
            $cidade         = $_POST["cidade"]; 
            $estado         = $_POST["estados"]; 
            $telefone       = $_POST["telefone"];
            $cep            = $_POST["cep"];
            $cnpj           = $_POST["cnpj"];
            $tid            = $_POST["transportadoraID"];
    
        //altera o banco de dados

        $altera_transp      = " UPDATE transportadoras ";
        $altera_transp      .= " SET ";
        $altera_transp      .= " nometransportadora = '{$nome}', ";
        $altera_transp      .= " endereco = '{$endereco}', ";
        $altera_transp      .= " cidade = '{$cidade}', ";
        $altera_transp      .= " estadoID = {$estado}, ";
        $altera_transp      .= " telefone = '{$telefone}', ";
        $altera_transp      .= " cep = '{$cep}', ";
        $altera_transp      .= " cnpj = '{$cnpj}' ";
        $altera_transp      .= " WHERE transportadoraID = {$tid} ";

        $operacao_alteracao = mysqli_query($conecta,$altera_transp);
            if (!$operacao_alteracao) {
                die("Erro no Banco de dados");
            } else {
                header ("location: listagem.php");
            }
    }

//consulta a tabela de estados
$estados = " SELECT estadoID, nome FROM estados";
$lista_estados = mysqli_query($conecta, $estados);
    if (!$lista_estados) {
        die ("Erro no banco de dados");
    }


//consulta a tabela de transportadora
$transp = "SELECT * FROM transportadoras ";
//

    if (isset($_GET["codigo"])){
        $id = $_GET["codigo"];
        $transp .= " WHERE transportadoraID = {$id}";
    } else {
        $transp .= " WHERE transportadoraID = 1"; 
        // header ("location: listagem.php");
    }

    $consulta_transp = mysqli_query($conecta, $transp);
    if (!$consulta_transp) {
        die ("erro na consulta ao banco de dados") ;
    } else {
        $info_transp = mysqli_fetch_assoc($consulta_transp);
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link rel="stylesheet" href="_css/alteracao.css">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
                <form method="post" action="alteracao.php">
                    <h2>Alteração de Transportadora</h2>

                    <label for="nometransportadora">Nome da transportadora</label>
                    <input type="text" value="<?php echo $info_transp["nometransportadora"]?>" name="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" value="<?php echo $info_transp["endereco"]?>" name="endereco">

                    <label for="cidade">Cidade</label>
                    <input type="text" value="<?php echo $info_transp["cidade"]?>" name="cidade">

                    <label for="estados">Estados</label>
                    <select id="estados" name="estados">
                        <?php 
                        $estado_selecionado = $info_transp["estadoID"];
                        while ( $linha_estados = mysqli_fetch_assoc($lista_estados) ) {
                            $estado_momento = $linha_estados["estadoID"];
                                if ($estado_selecionado == $estado_momento) {    
                        ?>
                            <option value="<?php echo $linha_estados["estadoID"]?>" selected>
                                <?php echo $linha_estados["nome"]?>
                            </option>
                            
                        <?php
                            } else {
                        ?>

                            <option value="<?php echo $linha_estados["estadoID"]?>">
                                <?php echo $linha_estados["nome"]?>
                            </option>

                        <?php
                            }
                        }
                        ?>
                    </select>

                    <label for="cep">CEP</label>
                    <input type="text" value="<?php echo $info_transp["cep"]?>" name="cep">

                    <label for="telefone">Telefone</label>
                    <input type="text" value="<?php echo $info_transp["telefone"]?>" name="telefone">

                    <label for="cnpj">Cnpj</label>
                    <input type="text" value="<?php echo $info_transp["cnpj"]?>" name="cnpj">

                    <input type="hidden" name="transportadoraID" value="<?php echo $info_transp["transportadoraID"]?>">

                    <input type="submit" value="Confirmar Alteração">



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