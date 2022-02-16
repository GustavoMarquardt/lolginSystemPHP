<?php
//inicializa a sessão
session_start();
    // faz a verificação se existe a sessão com a chave id, e se não estiver vazia 
    if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
        echo "Usuário logado com sucesso!";
    } else {
        // caso a pessoa não esteja logada, redireciona para a página de login
        header("Location: login.php");
    }

?>