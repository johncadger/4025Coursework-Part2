<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 29/11/2016
 * Time: 07:14
 */

include("header.php");

include("dbconnect.php");

session_start();

$username = $_SESSION['username'];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ID = $_POST['purchaseID'];

    if(isset($_POST['ccard'])){

        $sql = "SELECT * FROM photos WHERE ID = {$ID}";
        $result = $db->query($sql);

        while($row = $result->fetch_array()) {

            echo"<p>Congratulations {$username}, you've purchased {$row['title']}!</p>";

            echo"<img src={$row['URL']} id=\"image\"/>";
        }






    } else{

        $sql = "SELECT * FROM photos WHERE ID = {$ID}";
        $result = $db->query($sql);
        while($row = $result->fetch_array()){

            echo "
        <section id='purchasePhoto'
        <img src={$row['URL']} id=\"purchase_image\"/>
        <p>Title: {$row['title']}</p>
        <p>Price: £{$row['price']}</p>
        </section>

        <form action='purchase.php' method='post'>
            <label>Credit Card: <input type='text' name='ccard'></label>
            <button name=\"purchaseID\" type=\"submit\" value=\"{$row['ID']}\">Confirm Purchase</button>
        </form>
        ";



    }



    }




}