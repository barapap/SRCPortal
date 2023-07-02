<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>MPP Registration</title>
<link rel="stylesheet" href="registration.css" />
</head>
<body>
<?php
require('connectdb.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
    $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
    $username = mysqli_real_escape_string($conn,$username); 
    $fullname = stripslashes($_REQUEST['fullname']);
    $fullname = mysqli_real_escape_string($conn,$fullname);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn,$password);
    $exco = stripslashes($_REQUEST['exco']);
    $exco = mysqli_real_escape_string($conn,$exco);
    $faculty = stripslashes($_REQUEST['faculty']);
    $faculty = mysqli_real_escape_string($conn,$faculty);

        $query = "INSERT into `mpp_acc` (username, MPP_name, MPP_password, EXCO_id, FACULTY_id)
VALUES ('$username', '$fullname' ,'".md5($password)."', '$exco', '$faculty')";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<div class='form'>
<h3>MPP Account registered successfully.</h3>
<br/>Click here to <a href='registration.php'>Continue Register</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Account Username" required />
<input type="text" name="fullname" placeholder="MPP Full Name" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>
