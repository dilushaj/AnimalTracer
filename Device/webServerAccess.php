<?php
include "DbAccess.php";

$dbAccess=new DbAccess();

$animal=$_GET['animal'];
$longitude=$_GET['longitude'];
$latitude=$_GET['latitude'];

$dbAccess->saveTowebServer($animal, $longitude, $latitude);