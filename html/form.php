<?php
  require "./inc/db.php";
  $page_title = 'form';

  //SQLインジェクション対策
  $updateId = (int)$_REQUEST['id'];
  $name = pg_escape_string($_POST['name']);
  $price = (int)$_POST['price'];

  $formVal = pg_query_params($dbconnect, "SELECT name, price FROM products WHERE id = $1", array($updateId));
  $results = pg_fetch_assoc($formVal);
  
  $error_message = [];
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
      $error_message['name'] = "名前を入力してください";
    }
    if ((int)$_POST['price'] <= 0) {
      $error_message['price'] = "価格を入力してください";
    }
  }

  if (count($error_message) == 0  && ($_POST['submit'] == "編集" || $_POST['submit'] == "登録" ) ) {
    if ($updateId) {
      $sql = "UPDATE products SET name ='" .$name. "', price =" .$price. "WHERE id =" . $updateId;
      $res = pg_query($dbconnect, $sql);
    } else {
      $sql = "INSERT INTO products(name,price) VALUES('" . $name. "'," .$price. ")";
      $res = pg_query($dbconnect, $sql);
    }

    if ($res) {
      header('Location: ./list.php');
      exit;
    }
  }

  require './inc/head.php';
?>
<body>
  <form action="" method="POST">
    <p>商品名</p>
    <input type="text" name="name" value="<?=$results['name']?>">
    <?=$error_message['name']?>
    <p>価格</p>
    <input type="text" name="price" value="<?=$results['price']?>">
    <?=$error_message['price']?>
    <p>画像</p>
    <input type="file" name="image">
    <?php if ((int)$updateId > 0) { ?>
      <input type="submit" name="submit" value="編集">
      <input type="hidden" name="id" value="<?=$updateId?>">
    <?php } else { ?>
      <input type="submit" name="submit" value="登録">
    <?php } ?>
  </form>
</body>
</html>