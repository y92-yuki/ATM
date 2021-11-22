<?php session_start() ?>
<?php
require_once('pdo_controller.php');
$stmt = $pdo->prepare("SELECT * FROM account WHERE name = :name");
$stmt->execute(['name' => $_SESSION['name']]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>残高照会</title>
    </head>
    <body>
        <h3>残高照会</h3>
        <p><?= $data[0]['name'] ?>　様の口座残高は ¥<?= number_format($data[0]['balance']) ?>円です</p>
        <p>最終更新日時は<?= $data[0]['updated_at'] ?>です</p>
        <button type='button' onclick="location.href='atm.php'">完了</button>
    </body>
</html>