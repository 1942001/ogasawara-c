<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
               <link rel="stylesheet" href="login1.css" >
    </head>
<body>    
<h1 style="background-color: rgb(130, 131, 130);">
        <center>ログイン画面</center></h1>

        <form action="login1.php" method="post">
    <ul style="list-style-type: none;">
      <li><input type="text" name="userid" placeholder="ユーザ名" /></li>
      <li><input type="password" name="password" placeholder="パスワード" /></li>
      <li><input type="submit" value="ログイン" /></li>
    </ul>
  </form>
</body>

<?php
session_start(); 
if (isset($_POST['userid'], $_POST['password'])) {
  $username = $_POST['userid']; 
  $password = $_POST['password']; 
 //DBの接続とDBhへの登録//
 require 'db.php';

  $sql = 'select * from usertable where userid= "'.$username.'" && passwd="'.$password.'"';  
  $prepare = $db->prepare($sql);
  $prepare->execute();
  $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
  if($result != null){
    session_regenerate_id();
    $_SESSION['username'] = $username; 
    header('Location: program2.html');  
  } else {                          
    $message = 'ユーザ名またはパスワードが違います．'; 
  }
} else {
    $message = 'ユーザ名またはパスワードが入っていません．';
}
 
?>
<?php echo $message; ?>
</html> 