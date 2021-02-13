<?php 
  // 変数の書き方
  $mozi = "test"; // 文字列
  $num = 2; // 数字

  // 定数の書き方
  define('TEST', "定数");

  // 型変更の仕方
  $int = (int)$mozi; // 文字列→数値
  $str = (string)$num; // 数値→文字列

  // 文字列を結合する方法
  $merge = $mozi . $str; // パタ-ン1
  $merge2 = "test" . $str; // パタ-ン2

  // 配列の書き方
  $array = array(); //PHPの古いバ-ジョンから対応
  $array2 = []; // PHPの比較的新しい書き方

  $array = array("テスト", "山田", "山本");

  // 条件分岐(if)
  if ($num == 1) {
    $if_test = "OK";
  } else {
    $if_test = "NG";
  }

  // 繰り返し処理(foreach, for, switch, while)
  foreach ($array as $key => $val) {
    // echo $key;
    // echo $val;
  }

  for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == "テスト") {
      continue;
    }
    // echo $array[$i];
  }

  // switch ($num) {
  //   case 0:
  //       echo "iは0に等しい";
  //       break;
  //   case 1:
  //       echo "iは1に等しい";
  //       break;
  //   case 2:
  //       echo "iは2に等しい";
  //       break;
  //   default:
  //       echo "例外です";
  // }

  // while () {
  //   // echo $array[0];
  // }

  // フォ-ムからの情報を取得(GET, POST, REQUEST)
  // http://localhost:81/php_sample.php?page=1&text=4の場合,1が取得できる
  $page_num = $_GET['page'];

  $post_value = $_POST['text'];

  $requst_value = $_REQUEST['text'];
?>

<!-- 式展開の仕方 -->
<form action="" method="POST">
  <input type="text" name="text" value="<?=$post_value?>">
  <input type="submit" value="送信">
</form>

<a href="http://localhost:81/php_sample.php?page=1&text=4">test</a>