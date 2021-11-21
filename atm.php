<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ATM</title>
</head>
<body>
<h1>暗証番号を入力してください</h1>
<form action='after_login.php' method='post'>
    <div>
        ID &thinsp; &thinsp; &ensp; &ensp; &ensp; &ensp; <input type='text' name = 'id'>
    </div>
    <div>
        パスワード&ensp; <input type='text' name='password'>
    </div>
    <br>
    <input type='submit' name='send' value='確認'>
</form>


</body>
</html>