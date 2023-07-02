<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css" />
</head>


<body style="background-image: url('bg1.png'); background-size: cover;">
<img src="MPP_Logo" alt="" style="width: 30%; height: 30%; display: flex; justify-content: center;">

 
  <?php
  require('connectdb.php');
  session_start();
  // If form submitted, insert values into the database.
  if (isset($_POST['MPP_name'])) {
    // removes backslashes
    $MPP_name = stripslashes($_REQUEST['MPP_name']);
    //escapes special characters in a string
    $MPP_name = mysqli_real_escape_string($conn, $MPP_name);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Checking if the user exists in the database or not
    $query = "SELECT * FROM `mpp_acc` WHERE MPP_name='$MPP_name' and MPP_password='$password'";
    $result = mysqli_query($conn, $query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
      $_SESSION['MPP_name'] = $MPP_name;
      // Redirect user to index.php
      header("Location: edit.php");
    } else {
      echo "<div class='form'>
            <h3>MPP_name/password is incorrect.</h3>
            <br/>Click here to <a href='login.php'>Login</a>
          </div>";
    }
  } else {
    ?>
    <div class="form">
      <h1>Log In</h1>
      <form action="" method="post" name="login">
        <input type="text" name="MPP_name" placeholder="MPP MPP_name" required />
        <input type="password" name="password" placeholder="Password" required />
        <input name="submit" type="submit" value="Login" />
      </form>
      
    </div>
  <?php } ?>
</body>
</html>
