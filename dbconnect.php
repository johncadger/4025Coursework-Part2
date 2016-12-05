<?php
/**
 * Created by PhpStorm.
 * User: michaelcrabb
 * Date: 18/11/2015
 * Time: 09:43
 */

$db = new mysqli(
    "br-cdbr-azure-south-a.cloudapp.net",
    "b8ed5106a0388c",
    "54abfd2d",
    "db_1204848"
);

// test if connection was established, and print any errors

if (!$db) {
    die('Connect Error: ' . mysqli_connect_errno());
}
