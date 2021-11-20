<?php
$balance = 1500;
$pdo = new PDO('mysql:charset=UTF8;dbname=ATM;host=localhost','root', 'root');


// SQL作成
$sql = "UPDATE account SET balance = :balance WHERE id = 1";
$stmt = $pdo->prepare($sql);
// INSERT INTO account (balance)values (:balance)

// SQLの :balance に　$balanceをセット　
$stmt->bindValue(':balance',$balance, PDO::PARAM_INT);
// INSERT INTO account (balance)values (1500)

// response boolean 
// SQLが正常に完了で true、エラーでfalse
$res = $stmt->execute();

if (!$res) {
    // error
}

$pdo = null;


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ATM</title>
</head>
<body>
<h1>ATM</h1>

</body>
</html>