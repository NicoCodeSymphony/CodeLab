<?php


function connections(){
    $con = mysqli_connect("localhost", "root", "", "flutterfinals");
    return $con;
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");
