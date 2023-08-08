<?php
ob_start();
include "autoloader.php";
$session = new \Admin\Libs\Session();
if ($session->isSignedIn()) {
  header("Location: home.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>SUN RISE ADMIN</title>



  <link rel="stylesheet" href="css/style.css">


</head>

<body>
  <div id="clouds">
    <div class="cloud x1"></div>
    <!-- Time for multiple clouds to dance around -->
    <div class="cloud x2"></div>
    <div class="cloud x3"></div>
    <div class="cloud x4"></div>
    <div class="cloud x5"></div>
  </div>

  <div class="container">


    <div id="login">

      <form method="post">

        <fieldset class="clearfix">

          <p><span class="fontawesome-user"></span><input type="text" name="user" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
          <p><span class="fontawesome-lock"></span><input type="password" name="pass" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
          <p><input class="btn" type="submit" name="login" value="Login"></p>

        </fieldset>

      </form>



    </div> <!-- end login -->

  </div>
  <div class="bottom mt-5">
    <h3 class="mt-5 pt-5"><a href="../index.php">SUN RISE HOMEPAGE</a></h3>
  </div>
  <?php
  if (isset($_POST['login'])) {
    $usname = $_POST['user'];
    $password = $_POST['pass'];


    $user = new \Admin\Libs\Users();
    $user = $user->verifyUser($usname, $password);

    if ($user) {

      $session->login($user);
      header("Location: home.php");
      exit();
    } else {
      $session->message("Your email or password is incorrect");
    }
  } else {
    $email = "";
    $password = "";
    // Assuming the 'message' method exists in the 'Session' class
    $session->message();
  }
  ?>

  <h5 class="bg-danger text-white pl-3">
    <?php
    if (!empty($session->message)) {
      echo $session->message;
    }
    ?>
  </h5>

  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- Bootstrap Js -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- Metis Menu Js -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- Custom Js -->
  <script src="assets/js/custom-scripts.js"></script>
</body>

</html>