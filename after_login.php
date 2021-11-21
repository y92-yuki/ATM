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
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['name'] = $data[0]['name'];
    //$data[0]['password'];

    if(!empty($_POST['password'])){
        if ($data[0]['password'] == $_POST['password']) {
            $true_message = 'ログインに成功しました';
        }else {
        $false_message = 'ログインに失敗しました';
        }
    }else {
        $false_message = 'パスワードを入力してください';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ログイン後の画面</title>
    </head>
    <body>
        <?php if (!empty($true_message)): ?>
            <p>いらっしゃいませ <?= $data[0]['name'] ?> 様</p>
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
            <button type='button' onclick='history.back()'>ログアウト</button>
        <?php else: ?>
            <?= $false_message ?>
            <br>
            <br>
            <button type='button' onclick='history.back()'>戻る</button>
        <?php endif ?>

    </body>
</html>