<?php
  session_start();
  require "./inc/db.php";
  $page_title = 'signup';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error_message = [];
    $name = pg_escape_string($_POST['name']);
    $email = pg_escape_string($_POST['email']);
    $password = pg_escape_string($_POST['password']);

    // 以下でバリデーション
    if (!$name) {
      $error_message["name"] = "名前が入力されていません。";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_message["email"] = "メールアドレスが正しくありません。";
    }
    if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $password)) {
      $error_message["password"] = "パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。";
    } 

    $query = pg_query($dbconnect, "SELECT * FROM users WHERE email = '$email'");
    $results = pg_fetch_assoc($query);
    if ($results) {
      $error_message["false"] = "このメールアドレスは既に使われています。";
    }

    if (count($error_message) == 0) {
      $password_hash = password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO users(name,email,password) VALUES('" . $name. "','" .$email. "','" .$password_hash."')";
      $res = pg_query($dbconnect, $sql);
      if ($res) {
        session_regenerate_id(true); 
        $_SESSION['EMAIL'] = $email;
        header('Location: ./list.php');
        exit;
      } else {
        $error_message["false"] = "登録に失敗しました。";
      }
    }
  }
  require "./inc/head.php";
?>
<body>
  <?= $error_message["false"] ?>
  <form action = "signup.php" method = "POST">
    <p>名前</p>
    <input type = "name" name = "name">
    <br>
    <?= $error_message["name"] ?>
    <p>メールアドレス</p>
    <input type = "email" name = "email">
    <br>
    <?= $error_message["email"] ?>
    <p>パスワード</p>
    <input type = "password" name = "password">
    <br>
    <?= $error_message["password"] ?>
    <br>
    <input type="submit" name="submit" value="サインアップ">
  </form>
</body>
</html>