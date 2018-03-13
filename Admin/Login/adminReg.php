

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
<form action="adminReg.php" method="post">

    <div class="cont">


        <div class="demo ">
            <div class="login">
                <div class="box-header">
                    <div class="h2">Animal Tracer For Safari Drivers</div>
                    <div class="h2">Register Admin</div>

                </div>

                <div class="login__form1">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                        </svg>
                        <input type="text" class="login__input name" placeholder="Username" name="username"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                        </svg>
                        <input type="password" class="login__input pass" placeholder="Password" name="password"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M17.051,3.302H2.949c-0.866,0-1.567,0.702-1.567,1.567v10.184c0,0.865,0.701,1.568,1.567,1.568h14.102c0.865,0,1.566-0.703,1.566-1.568V4.869C18.617,4.003,17.916,3.302,17.051,3.302z M17.834,15.053c0,0.434-0.35,0.783-0.783,0.783H2.949c-0.433,0-0.784-0.35-0.784-0.783V4.869c0-0.433,0.351-0.784,0.784-0.784h14.102c0.434,0,0.783,0.351,0.783,0.784V15.053zM15.877,5.362L10,9.179L4.123,5.362C3.941,5.245,3.699,5.296,3.581,5.477C3.463,5.659,3.515,5.901,3.696,6.019L9.61,9.86C9.732,9.939,9.879,9.935,10,9.874c0.121,0.062,0.268,0.065,0.39-0.014l5.915-3.841c0.18-0.118,0.232-0.36,0.115-0.542C16.301,5.296,16.059,5.245,15.877,5.362z" />
                        </svg>
                        <input type="text" class="login__input pass" placeholder="Email" name="email"/>
                    </div>

                    <button type="submit" class="login__submit">Register Admin</button>

                </div>

            </div>


        </div>
    </div>





</form>
</body>

</html>
<?php
if ((isset($_POST["username"])) && (isset($_POST["password"])) && (isset($_POST["email"]))){

    include '../../dbCon.php';

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