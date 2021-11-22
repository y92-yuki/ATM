<?php
    session_start();
    header('Expires:-1');
    header('Cache-Control:');
    header('Pragma:');
?>
<?php

    require_once('pdo_controller.php');

    $data = null;

    $stmt = $pdo->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['name'] = $data['name'];
    $created_date = substr($data['created_at'],0,10);
    

    if ($_POST['logout']) {
        unset($_SESSION['name']);
        header('Location: ./atm.php');
    } 
    

            
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ログイン後の画面</title>
    </head>
    <body>
        <?php if ($_SESSION['name']): ?>
            <p>いらっしゃいませ  <?= $data['name'] ?> 様</p>
            <p>口座作成日は <?= $created_date ?>です</p>
            <p>ご希望のお取引を選択してください</p><br>
            <div>
                <a href='deposit.php'>お預け入れ</a>
            </div><br>
            <div>
                <a href='withdrawal.php'>お引き出し</a>
            </div><br>
            <div>
                <a href='balance.php'>残高照会</a>
            </div><br>
            <form action="" method="post">
                <input type="submit" name="logout" value="ログアウト">
            </form>
            
                
         <?php elseif (!$_SESSION['name']): ?>
            <?= 'ログインに失敗しました' ?>
            <br>
            <br>
            <button type='button' onclick='history.back()'>戻る</button>
        <?php endif ?>

    </body>
</html>