<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

$db = new PDO('mysql:host=localhost;dbname=produto', 'root', '');

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $stmt = $db->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
    $stmt->execute([$name, $price]);
}

if (isset($_POST['delete'])) {
    $id = $_POST['product_id'];

    $stmt = $db->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
}

$products = $db->query("SELECT * FROM produtos")->fetchAll();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Produtos</title>
</head>
<body>
    <h2>Gerenciamento de Produtos</h2>
    <h3>Bem-vindo, <?php echo $_SESSION['admin']; ?>!</h3>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Nome do Produto" required><br>
        <input type="text" name="price" placeholder="Preço" required><br>
        <input type="submit" name="create" value="Adicionar Produto">
    </form>

    <h3>Produtos</h3>
    <table>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td><?php echo $product['nome']; ?></td>
                <td><?php echo $product['preco']; ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="submit" name="delete" value="Excluir">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="sair.php">Sair</a>
</body>
</html>
