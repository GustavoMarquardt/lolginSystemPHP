<?php
//verifica se a sessão existe
session_start();

    //verifica se o POST(campo) foi setado
    if (isset($_POST['email']) && empty($_POST['email']) == false) {
        
        // recebe o valor email do HTML  e armazena na variável $email, o addslahes é para evitar que o usuário insira caracteres especiais
        $email = addslashes($_POST['email']);
        //aqui a mesma coisa so que o MD5 é para criptografar o a senha
        $senha = md5(addslashes($_POST['senha']));

        //aqui é a conexão com o banco de dados
        $dns = "mysql:dbname=teste1;host=localhost";
        $user = "root";
        $pass = "";
    
        try {
            //aqui é a utilização do PDO para pegar os valores do banco de dados, é tipo uma permissão
            $db = new PDO($dns, $user, $pass);
           
            // faz a procura no banco de dados
            $sql = $db->query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");
            // aqui é a contagem de linhas, se for maior que 0, quer dizer que encontrou o usuário

            if($sql->rowCount() > 0){
                //pega o primeiro usuário encontrado da lista
                $dado = $sql->fetch();
                $_SESSION['id'] = $dado['id'];
                header("Location: index.php");
            }
        } catch (PDOException $e) {
            echo "Falhou a conexão: ".$e->getMessage();
        }
    }
?>

<form method="POST">
    Email: <br />
    <input type="text" name="email" placeholder="email" /> <br /><br />
    Senha: <br />
    <input type="text" name="senha" placeholder="senha"><br /><br />

    <input type="submit" value="Entrar">
</form>