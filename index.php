<?php
//conexão
require_once 'db_connect.php';

//sessão
session_start();

    if(isset($_POST['entrar'])):
        $erros =  array();
        $email = mysqli_escape_string($connect, $_POST['email']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);
        
        if(empty($email) or empty($senha)):
            $erros[] = "Preencha os campos para fazer login.";
        else:
            $sql = "SELECT email FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0):
                $senha = md5($senha);
                $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
                $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('Location: home.php');
                else: 
                    $erros[] = "Email e senha não conferem.";
                endif;
            else:
                $erros[] = "Usuário não encontrado.";
            endif;
        endif;
    
    endif;
?>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body id="landing-page">
    <header>
        <img src="logo-temp.png" alt="Logo">
        <h3>SEUS CONTATOS</h3>
    </header>
    <div class="body">
        <div class="container-form">
                <div class="title">
                    <h1> Login </h1>
                </div>
                
                <?php
                    if(!empty($erros)):
                ?>
                <div class="info"> 
                    <?php
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                    ?>
                </div>
                <?php
                endif;
                ?>
                
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <label>Email:</label>
                    <input type="text" name="email">

                    <label>Senha:</label>
                    <input type="password" name="senha">

                    <button type="submit" name="entrar">Entrar</button>
                </form>
                <div class="footer">
                    <a href="cadastro.php">Não tem cadastro?</a>
                    <a href="">Esqueceu a senha?</a>
                </div>
            </div>
    </div>
    
</body>