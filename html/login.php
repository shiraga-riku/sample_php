<?php
  session_start();
  require "./inc/db.php";
  $page_title = 'login';
  $email = pg_escape_string($_POST['email']);
  $password = pg_escape_string($_POST['password']);
  $query = pg_query($dbconnect, "SELECT * FROM users WHERE email = '$email'");
  $results = pg_fetch_assoc($query);
  if (password_verify($_POST['password'], $results['password'])) {
    session_regenerate_id(true); 
    $_SESSION['EMAIL'] = $results['email'];
    header('Location: ./list.php');
    exit;
  }
  require "./inc/head.php";
?>
<body>
  <form action = "login.php" method = "POST">
    <p>メールアドレス</p>
    <input type = "email" name = "email">
    <p>パスワード</p>
    <input type = "password" name = "password">
    <input type="submit" name="submit" value="ログイン">
  </form>
</body>
</html>