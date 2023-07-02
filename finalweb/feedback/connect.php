<?php
    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $matricNum = $_POST['matricNum'];
        $email = $_POST['email'];
        $message = $_POST['message'];
    }

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }
    // using sql to create a data entry query
    $sql = "INSERT INTO user (name, matricNum, email, message) VALUES ('$name', '$matricNum', '$email', '$message')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Your feedback was sent successfully!";
    }else {
        echo "Your feedback colud not be sent";
    }

    // close connection
    mysqli_close($con);

    ?>