<?php defined('DS') OR die('No direct access allowed.');

$users = array(
 "matt" => "subnet",
 "bgibbons" => "beng1995",
 "richard" => "yang",
 "kewal" => "real",
 "ben" => "imabird"
);

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($users[$_POST['username']] !== NULL && $users[$_POST['username']] == $_POST['password']) {
  $_SESSION['username'] = $_POST['username'];
  header('Location:  ' . $_SERVER['PHP_SELF']);
    }else {
        //invalid login
  echo "<p> [ ! ] ERROR LOGGING IN [ ! ] </p>";
    }
}

echo '<form method="post" action="'.SELF.'">
  <h2>Login</h2>
  <p><label for="username">Username: </label> <input type="text" id="username" name="username" value="" /></p>
  <p><label for="password">Password: </label> <input type="password" id="password" name="password" value="" /></p>
  <p><input type="submit" name="submit" value="Login" class="button"/></p>
  </form>';
exit; 
?>