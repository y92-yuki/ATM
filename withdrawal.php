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
    $withdrawaled = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($withdrawaled);
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>お引き出し</title>
    </head>
    <body>
            <?php if (empty($_POST['withdrawal_send'])): ?>
                <form action='withdrawal.php' method=post>
                    <div>
                        <p>引き出し金額を入力してください</p><br>
                        <input type='number' name='withdrawal_money'>
                    </div>
                        <input type='submit' name='withdrawal_send' value='確定'> <button type='button' onclick="location.href='atm.php'">取消</button>
                </form>
            <?php elseif(!empty($_POST['withdrawal_send'])): ?>
                <p>¥<?= number_format($_POST['withdrawal_money']) ?>円引き出しました</p>
                <p>引き出し後の残高は ¥<?= number_format($withdrawaled[0]['balance']) ?>円です</p>
                <button type='button' onclick="location.href='atm.php'">終了</button>
            <?php endif ?>
    </body>
</html>