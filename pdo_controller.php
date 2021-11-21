<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ATM;charset=utf8','root','root');
} catch(PDOException $e) {
    echo $e->getMessage();
}

?>