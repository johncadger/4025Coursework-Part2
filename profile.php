<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 29/11/2016
 * Time: 07:14
 */

include("header.php");



session_start();
$username = $_GET["username"];
//$test = $_SESSION['test'];

if (isset($_SESSION['photographer'])){

    if($_SESSION['username'] == $username)
        echo"<p><a href='edit_profile.php'>Edit Profile</a></p>";

}



include("dbconnect.php");

$sql = "SELECT * FROM users2 where username = '$username'";
$result = $db->query($sql);
while($row = $result->fetch_array()){
    echo "<p>Username: ".$row['username'];
    $ID = $row['ID'];
}

$sql = "SELECT * FROM profiledetails where ID = '$ID'";
$result = $db->query($sql);
while($row = $result->fetch_array()){
    echo "<p>First Name: ".$row['firstname'];
    echo "<p>Last Name: ".$row['lastname'];
    echo "<p>Age: ".$row['age'];
    echo "<p>Country: ".$row['country'];
}

$sql = "SELECT * FROM photos where pID = '$ID'";
$result = $db->query($sql);
while($row = $result->fetch_array()){
    echo "
    <section id='photoNode'>
        <img src={$row['URL']} id=\"image\"/>
        <p>Title: {$row['title']}</p>
        <p>Description: {$row['description']}</p>
        <p>Price: £{$row['price']}</p>
        ";

    if(isset($_SESSION['shopper'])) {
        //echo "<a href='purchase.php?ID='{$row['ID']}>Purchase</a>";
        echo "
        <form action='purchase.php' method='post'>
            <button name=\"purchaseID\" type=\"submit\" value=\"{$row['ID']}\">Purchase</button>

        </form>

        ";

        //<a href='purchase.php'>Purchase</a>

    }

echo "</section>";

}

//echo "<p>Test: " . $_SESSION['test'];

//if (isset($_SESSION['test']))
    //echo "session lives!";
//else
    //echo "!";