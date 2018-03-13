

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
<form action="login.php" method="post">

    <div class="cont">


        <div class="demo ">
            <div class="login">
                <div class="box-header">
                    <div class="h2">Change Password</div>

                </div>

                <div class="login__form1">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                        </svg>
                        <input type="password" class="login__input name" placeholder="Current Password" name="currentPass"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                        </svg>
                        <input type="password" class="login__input pass" placeholder="New Password" name="newPassword"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                        </svg>
                        <input type="password" class="login__input pass" placeholder="Confirm Password" name="confPassword"/>
                    </div>
                    <button type="submit" class="login__submit">Change Password</button>

                </div>

            </div>


        </div>
    </div>





</form>
</body>

</html>
<?php
if ((isset($_POST["username"])) && (isset($_POST["password"]))){

    include 'dbCon.php';

    if (!get_magic_quotes_gpc()){

        $new_username = addslashes($_POST["username"]);
        $new_password1 = addslashes($_POST["password"]);
    }
    else{
        $new_username = $_POST["username"];
        $new_password1 = $_POST["password"];
    }
    echo "<br>";

    $new_password = md5($new_password1);
    session_start();
    $_SESSION['user']=$new_username;
    if (preg_match('^[0-9]{6}[A-Z]{1}^' ,$new_username )){
        $query="SELECT * FROM student WHERE stu_id='".$new_username."'";
        echo "Came here2";
        if ($is_query_run=mysqli_query($conn,$query)){
            while($row=mysqli_fetch_array($is_query_run,MYSQL_ASSOC)){
                if ($new_password == $row['password']){
                    $_SESSION['student_id'] = $new_username;
                    header("location: ../Hall_Management_warden/ui_student.php");
                }
                else{
                    echo "There is an error in username or password";
                }
            }
        }
    }
    else{
        $query="SELECT * FROM admin WHERE user_id='".$new_username."'";
        if ($is_query_run=mysqli_query($conn,$query)){
            while($row=mysqli_fetch_array($is_query_run,MYSQL_ASSOC)){
                if ($new_password == $row['password']){
                    $new_type = $row['position'];
                    if ("$new_type" == "Employee_Manager"){
                        $_SESSION['position'] = "Employee_Manager";
                        $_SESSION['user_id'] = $new_username;
                        header("location: ../Hall_Management_warden/emp_home.php");
                    }
                    else if ("$new_type" == "Accommodation_Manager"){
                        $_SESSION['position'] = "Accommodation_Manager";
                        $_SESSION['user_id'] = $new_username;
                        header("location: ../Hall_Management_warden/acc_home.php");
                    }
                    else{
                        $_SESSION['position'] = "Warden";
                        $_SESSION['user_id'] = $new_username;
                        header("location: ../Hall_Management_warden/ui_warden.php");
                    }
                }
                else{
                    echo "There is an error in username or password";
                }
            }
        }
    }
}
?>