<?php


class DbAccess
{

    function saveToLocalDatabase($animal, $longitude, $latitude,$broadcasted)
    {
        $date = date("Y/m/d");
        date_default_timezone_set('	Asia/Colombo');
        //$time = time(time(),'localtime');

        $displayed = "locallyDisplayed";
        $conn1 = new SQLite3('device.sqlite');
        $sql = "INSERT INTO Animal (`animalName`, `longitude`, `latitude`,`date`,`globalStatus`,`localStatus`) VALUES ('$animal','$longitude','$latitude','$date','$broadcasted' ,'$displayed')";
        $conn1->query($sql);


    }

    function saveToWebServer($animal, $longitude, $latitude)
    {
        $conn2 = new mysqli("localhost", "root", "", "animal tracer");
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        date_default_timezone_set('	Asia/Colombo');
        $date = date("Y/m/d");
        $time = time();
        mysqli_query($conn2, "INSERT INTO animal (animalName,longitude,latitude,time,date)
				VALUES('$animal','$longitude','$latitude','$time','$date')");


    }

    function queryWebServer()
    {


    }
}

?>