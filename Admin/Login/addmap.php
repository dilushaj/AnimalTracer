

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add park</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />

    <link rel="stylesheet" href="css/style.css">

    <script src="js/addmap.js"></script>
    <!-- Replace the value of the key parameter with your own API key. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnd_83H7sRNr3PBi3GyBwAtCL8seHFKso&callback=initialize&libraries=places,visualization" async defer></script>

</head>

<body>


<div id="map"></div>
<form>

    <div class="cont">


        <div class="demo ">
            <div class="login">
                <div class="box-header">
                    <div class="h2">Animal Tracer For Safari Drivers</div>
                    <div class="h2">Add Park</div>

                </div>

                <div class="login__form1">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M13.388,9.624h-3.011v-3.01c0-0.208-0.168-0.377-0.376-0.377S9.624,6.405,9.624,6.613v3.01H6.613c-0.208,0-0.376,0.168-0.376,0.376s0.168,0.376,0.376,0.376h3.011v3.01c0,0.208,0.168,0.378,0.376,0.378s0.376-0.17,0.376-0.378v-3.01h3.011c0.207,0,0.377-0.168,0.377-0.376S13.595,9.624,13.388,9.624z M10,1.344c-4.781,0-8.656,3.875-8.656,8.656c0,4.781,3.875,8.656,8.656,8.656c4.781,0,8.656-3.875,8.656-8.656C18.656,5.219,14.781,1.344,10,1.344z M10,17.903c-4.365,0-7.904-3.538-7.904-7.903S5.635,2.096,10,2.096S17.903,5.635,17.903,10S14.365,17.903,10,17.903z" />
                        </svg>
                        <input type="text" class="login__input name" placeholder="Add Park" id="place" name="place"/>
                    </div>
                    <br><br><br>
                    <button  class="login__submit" onclick="searchPlace()">Search Park</button>
                    <button type="submit" class="login__submit">Confirm Park</button>

                </div>

            </div>


        </div>
    </div>





</form>
</body>

</html>
<?php
if ((isset($_POST["place"]))){

    include '../../dbCon.php';

    if (!get_magic_quotes_gpc()){

        $place = addslashes($_POST["place"]);

    }
    else{
        $place = $_POST["username"];

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