<?php 
  require "./inc/db.php";
  $query = pg_query($dbconnect,"SELECT id, name, price FROM products");
  $results = pg_fetch_all($query);
  $deleteId = $_GET['id'];
  $daleteQuery = pg_query($dbconnect, "DELETE FROM products WHERE id = '$deleteId'");
  if ($daleteQuery) {
    header('Location: ./list.php');
    exit;
  }
  foreach ($results as $key => $val) {
    $html .= '<tr>';
    $html .= '<td>' . $val["name"]. '</td>';
    $html .= '<td>' . $val["price"]. '</td>';
    $html .= '<td><a href="./list.php?id=' . $val["id"] . '">削除</a></td>';
    $html .= '</tr>';
  }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>list</title>
</head>
<body>
  <table>
    <tr>
      <th>商品名</th>
      <th>価格</th>
      <th>削除</th>
    </tr>   
    <?= $html ?>
  </table>
</body>
</html>