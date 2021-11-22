<?php session_start(); ?>
<?php
require_once('pdo_controller.php');

if (!empty($_POST['withdrawal_send'])) {
    $stmt = $pdo->prepare("UPDATE account SET balance = balance - :withdrawal_money WHERE name = :name");
    $stmt->bindValue('withdrawal_money',$_POST['withdrawal_money'],PDO::PARAM_INT);
    $stmt->bindValue('name',$_SESSION['name'],PDO::PARAM_STR);
    $stmt->execute();

    $stmt = $pdo->prepare("SELECT * FROM account WHERE name = :name");
    $stmt->execute(['name' => $_SESSION['name']]);
    $withdrawaled = $stmt->fetch(PDO::FETCH_ASSOC);
    
}

if ($_POST['logout']) {
    unset($_SESSION['name']);
    header('Location: ./atm.php');
} 
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>お引き出し</title>
    </head>
    <body>
            <?php if(!empty($_POST['withdrawal_send'])): ?>
                <p>¥<?= number_format($_POST['withdrawal_money']) ?>円引き出しました</p>
                <p>引き出し後の残高は ¥<?= number_format($withdrawaled['balance']) ?>円です</p>
                <form action="" method="post">
                    <input type="submit" name="logout" value="完了">
                </form>
            <?php elseif ($_SESSION['name']): ?>
                <form action='withdrawal.php' method=post>
                    <div>
                        <p>引き出し金額を入力してください</p><br>
                        <input type='number' name='withdrawal_money'>
                    </div>
                        <input type='submit' name='withdrawal_send' value='確定'> <input type="submit" name="logout" value="取消">
                </form>
            <?php else: ?>
                <?php header('Location: atm.php') ?>
            <?php endif ?>
    </body>
</html>