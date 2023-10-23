<?php
session_start();

if (isset($_POST['entrar'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifique as credenciais do administrador (substitua isso pelo seu próprio sistema de autenticação)
    if ($username === 'admin' && $password === 'senha') {
        $_SESSION['admin'] = $username;

        // Salve o nome do administrador em um cookie
        if (isset($_POST['remember'])) {
            setcookie('admin_name', $username, time() + 30 * 60);
        }

        header("Location: admin.php");
        exit;
    } else {
        $error = "Credenciais inválidas";
    }
}
?>


<?php 
  if (isset($_POST['btncadastro'])) {
    $usuario = $_POST['txtusuario'];
    $email = $_POST['txtemail'];
    $senha = $_POST['txtsenha'];
    $senha_confirm = $_POST['txtsenha_confirm'];

    if ($senha === $senha_confirm) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            include 'conexao.php';
            $sql = "INSERT INTO usuario(nm_usuario, nm_email, cd_senha)
                    VALUES (?, ?, ?);";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usuario, $email, $senha_hash]);
            echo "<script>alert('Cadastrado com Sucesso!');</script>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
    } else {
        echo "<script>alert('As senhas não coincidem!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/cf6fa412bd.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="buttonsForm">
      <div class="btnColor"></div>
      <button id="btnEntrar">Entrar</button>
      <button id="btnCadastro">Cadastre-se</button>
    </div>

    <form action="index.php" method="POST" id="entrar">
      <input type="text" placeholder="Email" required />
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" placeholder="Password" required />
      <i class="fas fa-lock senha"></i>
      <div class="divCheck">
        <input type="checkbox" />
        <span>Lembrar Login</span>
      </div>
      <button type="submit">Entrar</button>
    </form>

    <form action="index.php" method="POST" id="cadastro">
    <input type="text" placeholder="Nome de Usuário" name='txtusuario' required />
    <i class="fas fa-user iUser"></i>
    <input type="text" placeholder="Email" name='txtemail' required />
    <i class="fas fa-envelope iEmail"></i>
    <input type="password" placeholder="Password" name='txtsenha' required />
    <i class="fas fa-lock senha"></i>
    <input type="password" placeholder="Confirme a Senha" name='txtsenha_confirm' required />
    <i class="fas fa-lock senha2"></i>
    <div class="divCheck">
        <input type="checkbox" required />
        <span>Aceitar termos de privacidade</span>
    </div>
    <button type="submit" name="btncadastro">Cadastre-se</button>
</form>
  </div>

  <script src="login.js"></script>
</body>
</html>