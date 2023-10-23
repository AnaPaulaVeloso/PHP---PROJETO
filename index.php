<?php
session_start();

if (isset($_POST['entrar'])) {
  $email = $_POST['login'];
  $password = $_POST['senha'];


  // Verifique as credenciais do administrador (substitua isso pelo seu próprio sistema de autenticação)
  try {
    include 'conexao.php';
    $select = $conn->prepare("SELECT nm_email, cd_senha FROM usuario WHERE nm_email = '$email'");
    $select->execute();
    

    if ($select->rowCount() > 0) {
      $usuario = $select->fetch();
      
     
        
        // Salve o nome do administrador em um cookie
        if (isset($_POST['remember'])) {
          setcookie('admin_name', $email, time() + 30 * 60);
          }
          $_SESSION["email"] = $usuario["nm_email"];
          header("location:./admin.php"); 
    }




    $conn = null;
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  
}
?>


<?php
if (isset($_POST['btnCadastro'])) {
  include 'conexao.php';
  $email = $_POST['txtemail'];
  $senha = $_POST['txtsenha'];
  $senha_confirm = $_POST['txtsenha_confirm'];

  if ($senha === $senha_confirm) {


    try {
      include 'conexao.php';
      $stmt = $conn->prepare("INSERT INTO usuario(nm_email, cd_senha) VALUES (?, ?)");
      $stmt->execute([$email, $senha]);
      echo "<script>alert('Cadastrado com Sucesso!');</script>";
    } catch (PDOException $e) {
      echo $e->getMessage();
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
      <input type="text" placeholder="Email" required name="login"/>
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" placeholder="Password" required name="senha" />
      <i class="fas fa-lock senha"></i>
      <div class="divCheck">
        <input type="checkbox" />
        <span>Lembrar Login</span>
      </div>
      <button type="submit" name="entrar">Entrar</button>
    </form>

    <form action="index.php" method="POST" id="cadastro">
      <input type="text" placeholder="Email" name="txtemail" required />
      <i class="fas fa-envelope iEmail"></i>
      <input type="password" placeholder="Password" name="txtsenha" required />
      <i class="fas fa-lock senha"></i>
      <input type="password" placeholder="Password" name="txtsenha_confirm" required />
      <i class="fas fa-lock senha2"></i>
      <div class="divCheck">
        <input type="checkbox" required />
        <span>Aceitar termos de privacidade</span>
      </div>
      <button type="submit" name="btnCadastro">Cadastre-se</button>
    </form>
  </div>

  <script src="login.js"></script>
</body>

</html>