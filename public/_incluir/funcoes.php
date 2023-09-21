<?php
    function real_format($valor) {
        $valor = number_format($valor,2,",",".");
        return "R$" . $valor;
    }

    function mostrarAviso($numero) {
        $array_erro = array(
            UPLOAD_ERR_OK => "Sem erro.",
            UPLOAD_ERR_INI_SIZE => "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
            UPLOAD_ERR_FORM_SIZE => "O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML",
            UPLOAD_ERR_PARTIAL => "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE => "Nenhum arquivo foi enviado.",
            UPLOAD_ERR_NO_TMP_DIR => "Pasta temporária ausente.",
            UPLOAD_ERR_CANT_WRITE => "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION => "Uma extensão do PHP interrompeu o upload do arquivo."
        ); 

        return $array_erro[$numero];
    }

    function uploadArquivo($arquivo_publicado, $minha_pasta) {
        if ($arquivo_publicado["error"] == 0) {

            $pasta_temporaria = $arquivo_publicado["tmp_name"];
            $arquivo          = alterarNome($arquivo_publicado["name"]);
            $tipo          = $arquivo_publicado["type"];
            $pasta            = $minha_pasta;
            $extensao         = strrchr($arquivo, ".");


        //postagem da imagem    
        if ($tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/gif" ){
            if (move_uploaded_file($pasta_temporaria, $pasta . "/" . $arquivo)) {
                $mensagem = "Arquivo enviado com sucesso";
            } else {
                $mensagem = "erro ao publicar";
            }

        } else {
            $mensagem = "ERRO! arquivo não pode ter a extensão " . $extensao;
        }

            } else {
                $mensagem = mostrarAviso([$arquivo_publicado["error"]]);
            }

        return array($mensagem, $arquivo);
    }

    function alterarNome($arquivo) {
        $extensao         = strrchr($arquivo, ".");
        $alfabeto = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $tamanho = 15;
        $letra   = "";
        $resultado = "";
        
        for ($i = 1; $i < $tamanho ; $i++){
        $letra = substr($alfabeto, rand(0, strlen($alfabeto)-1), 1);
        $resultado .= $letra;
        }    
    
        $agora = getdate();
        $codigo_ano = $agora["year"] . "_" . $agora["yday"];
        $codigo_data = $agora["hours"] . $agora["minutes"] .$agora["seconds"];
    
    
        return "img_" . $resultado . "_" . $codigo_ano . "_" .$codigo_data . $extensao;
    }

    function enviarMensagem($dados) {
        //dados do formulario
        $nome       = $dados['nome'];
        $email      =$dados['email'];
        $mensagem_usuario = $dados['mensagem'];

        //criar variaveis de envio
        $destino = "wesleypatrick0909@gmail.com";
        $remetente = "wesleypatrick0909@gmail.com";
        $assunto = "Mensagem do site";

        //monta o corpo da mensagem 
        $mensagem = "O usuário " . $nome . "enviou uma mensagem" . "<br>";

        $mensagem .= "Email do usuário: " . $email . "<br>";
        $mensagem .= "mensagem: " . "<br>";
        $mensagem .= $mensagem_usuario;

        return mail($destino, $assunto, $mensagem, $remetente);
    }

