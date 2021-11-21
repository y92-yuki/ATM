<?php session_start() ?>
<?php
    require_once('pdo_controller.php');
    if (!empty($_POST['deposit_send'])) {
        $stmt = $pdo->prepare("UPDATE account SET balance = balance + :deposit_money WHERE name = :name");
        $stmt->bindValue('deposit_money',$_POST['deposit_money'], PDO::PARAM_INT);
        $stmt->bindValue('name',$_SESSION['name'], PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt = $pdo->prepare("SELECT balance FROM account WHERE name = :name");
        $stmt->execute(['name' => $_SESSION['name']]);
        $deposited = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>お預け入れ</title>
    </head>
    <body>
        <?php if (empty($_POST['deposit_send'])): ?>
            <form action='deposit.php' method='post'>
                <div>
                    預け入れ金額を入力してください<br>
                    <input type='number' name='deposit_money'>
                </div>
                <input type='submit' value='確定' name='deposit_send'> <button type='button' onclick="location.href='atm.php'">取消</button>
            </form>
        <?php elseif (!empty($_POST['deposit_send'])): ?>
            <p>¥<?= number_format($_POST['deposit_money']) ?>円入金しました</p>
            <p>入金後残高は ¥<?= number_format($deposited['balance']) ?>円です</p>
            <button type='button' onclick="location.href='atm.php'">終了</button>
        <?php endif ?>

    </body>
</html>
