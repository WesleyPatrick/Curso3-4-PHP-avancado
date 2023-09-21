
<header>
    <div id="header_central">
        <?php

            if (isset($_SESSION["user_portal"])){

            $user = $_SESSION["user_portal"];

            $saudacao = " SELECT nomecompleto ";
            $saudacao .= " FROM clientes ";
            $saudacao .= " WHERE clienteID = '{$user}'";

            $pesquisasaudacao = mysqli_query($conecta, $saudacao);
            if (!$pesquisasaudacao) {
                die ("falha no banco de dados");
            }

            $pesquisasaudacao = mysqli_fetch_assoc($pesquisasaudacao);
            $nome = $pesquisasaudacao["nomecompleto"]

            
        ?>
        <div id="header_saudacao">
            <h5>Seja bem vindo(a)  <b><?php echo $nome?></b> | <a href="logout.php">  fazer logout</a></h5>
        </div>

        <?php
         } 
        ?>


        <img src="/avancado/public/_assets/logo_andes.gif">
        <img src="/avancado/public/_assets/text_bnwcoffee.gif">
    </div>
</header>
