<?php
  require "./inc/db.php";
  $sql = "INSERT INTO products(name,price) VALUES('" . $_POST['name']. "'," .(int)$_POST['price']. ")";
  $res = pg_query($dbconnect, $sql);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <title>testApp</title>
</head>
<body>
  <form action="" method="POST">
    <p>商品名</p>
    <input type="text" name="name">
    <p>価格</p>
    <input type="text" name="price">
    <p>画像</p>
    <input type="file" name="image">
    <input type="submit" value="登録">
  </form>
</body>
</html>