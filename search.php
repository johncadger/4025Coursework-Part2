<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 28/11/2016
 * Time: 19:43
 */

include("header.php");

include("dbconnect.php");



$term = htmlspecialchars($_POST["search"]);

echo "
<p>{$term} returned these</p>

<p>Photographers: </p>
";

$sql = "SELECT * FROM users2 where username LIKE '%$term%' and type = 'photographer'";
$result = $db->query($sql);

while($row = $result->fetch_array())
{
    //$username = $row['username'];
    echo "<p><a href='profile.php?username={$row['username']}'>{$row['username']}</a></p>";
}

echo"<p>Photographs: </p>";
//change to photos



$sql = "SELECT * FROM photos where title LIKE '%$term%' OR description LIKE '%$term%'";
$result = $db->query($sql);

while($row = $result->fetch_array()) {

    echo "
        <section id='photoNode'>
            <img src={$row['URL']} id=\"image\"/>
            <p>Title: {$row['title']}</p>
            <p>Description: {$row['description']}</p>
            <p>Price: £{$row['price']}</p>";

    $purchaseID = $row['ID'];

    $sql1 = "SELECT * FROM users2 WHERE ID = {$row['pID']}";
    $result1 = $db->query($sql1);
    while($row = $result1->fetch_array()){

        echo "<p>Photographer: <a href='profile.php?username={$row['username']}'>{$row['username']}</a></p>";

    }


    if (isset($_SESSION['shopper'])) {
        echo "
        <form action='purchase.php' method='post'>
            <button name=\"purchaseID\" type=\"submit\" value=\"{$purchaseID}\">Purchase</button>
        </form>

        ";

        echo "
        </section>
    ";

    }
}