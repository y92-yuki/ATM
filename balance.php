<?php session_start() ?>
<?php
require_once('pdo_controller.php');
$stmt = $pdo->prepare("SELECT * FROM account WHERE name = :name");
$stmt->execute(['name' => $_SESSION['name']]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_POST['logout']) {
    unset($_SESSION['name']);
    header('Location: ./atm.php');
} 
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>残高照会</title>
    </head>
    <body>
        <?php if (!empty($_SESSION['name'])): ?>
            <h3>残高照会</h3>
            <p><?= $data['name'] ?>　様の口座残高は ¥<?= number_format($data['balance']) ?>円です</p>
            <p>最終更新日時は<?= $data['updated_at'] ?>です</p>
            <form action="" method="post">
                <input type="submit" name="logout" value="完了">
            </form>
        <?php elseif(!$_SESSION['name']): ?>
            <?php header('Location: ./atm.php') ?>
        <?php endif ?>
    </body>
</html>