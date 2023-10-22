<?php
session_start();

if (isset($_POST['login'])) {
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

    <form action="login.php" method="POST" id="cadastro">
      <input type="text" placeholder="Email" required />
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" placeholder="Password" required />
      <i class="fas fa-lock senha"></i>
      <input type="password" placeholder="Password" required />
      <i class="fas fa-lock senha2"></i>
      <div class="divCheck">
        <input type="checkbox" required />
        <span>Aceitar termos de privacidade</span>
      </div>
      <button type="submit">Cadastre-se</button>
    </form>
  </div>

  <script src="login.js"></script>
</body>
</html>