<?php 
  require "./inc/db.php";
  $page_title = 'list';

  $query = pg_query($dbconnect,"SELECT id, name, price FROM products");
  $results = pg_fetch_all($query);
  $deleteId = (int)$_GET['id'];
  if ($deleteId) {
    $daleteQuery = pg_query($dbconnect, "DELETE FROM products WHERE id = '$deleteId'");
    if ($daleteQuery) {
      header('Location: ./list.php');
      exit;
    }
  }
  foreach ($results as $key => $val) {
    $html .= '<tr>';
    $html .= '<td>' . $val["name"]. '</td>';
    $html .= '<td>' . $val["price"]. '</td>';
    $html .= '<td><a href="./form.php?id=' . $val["id"] . '">変更</a></td>';
    $html .= '<td><a href="./list.php?id=' . $val["id"] . '">削除</a></td>';
    $html .= '</tr>';
  }

  require './inc/head.php';
?>
<body>
  <table>
    <tr>
      <th>商品名</th>
      <th>価格</th>
      <th>変更</th>
      <th>削除</th>
    </tr>   
    <?= $html ?>
  </table>
</body>
</html>