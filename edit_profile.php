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

$sql = "SELECT * FROM users2 where username = '{$_SESSION['username']}'";
$result = $db->query($sql);

while($row = $result->fetch_array())
{
    $ID = $row['ID'];
}


if (isset($_SESSION['photographer'])){

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        echo "
        <main>
            <p>Edit Details Here:</p>
            <form action=\"edit_profile.php\" method=\"post\">

        ";

        //$sql = "SELECT * FROM users2 where username = '{$_SESSION['username']}'";
        //$result = $db->query($sql);

        //while($row = $result->fetch_array())
        //{
            //$ID = $row['ID'];
        //}

        $sql = "SELECT * FROM profiledetails where ID = '{$ID}'";
        $result = $db->query($sql);
        while($row = $result->fetch_array())
        {
            echo "<label>First Name: <input type=\"text\" name=\"firstname\" value=\"{$row['firstname']}\"></label></br>";
            echo "<label>Last Name: <input type=\"text\" name=\"lastname\" value=\"{$row['lastname']}\"></label></br>";
            echo "<label>Age: <input type=\"text\" name=\"age\" value=\"{$row['age']}\"></label></br>";
            echo "<label>Country: <input type=\"text\" name=\"country\" value=\"{$row['country']}\"></label>";


            //echo "<li>{$username} - <a href='admin.php?approve=$ID'>Approve</a></li>";
            //echo "<option value= {$ID}>{$username}</option>";
        }

        echo "
                    <p><input type=\"submit\" value=\"Update Details\"></p>
            </form>
            

            <a href='add_photo.php'>Add Photo</a>

            <p>Edit Photographs Here:</p>

            <section id='edit_photo'>
                ";

        $sql = "SELECT * FROM photos where pID = '{$ID}'";
        $result = $db->query($sql);
        while($row = $result->fetch_array())
        {
            echo"
                <img src={$row['URL']} id=\"edit_image\"/>
                <form action=\"edit_profile.php\" method=\"post\">
                    <label>Title: <input type=\"text\" name=\"title\" value=\"{$row['title']}\"></label></br>
                    <label>Description: <input type=\"text\" name=\"description\" value=\"{$row['description']}\"></label></br>
                    <label>Price: <input type=\"text\" name=\"price\" value=\"{$row['price']}\"></label></br>
                    <button name=\"ID\" type=\"submit\" value=\"{$row['ID']}\">Update Photograph</button>
                </form>

                 <form action=\"edit_profile.php\" method=\"post\">
                    <button name=\"deleteID\" type=\"submit\" value=\"{$row['ID']}\">Delete</button>
                </form>
            ";

            //<p><input type="submit" value="Update Photograph">Update P</p>
        }

echo "</section>

        </main>
        ";


    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['firstname'])){

            $firstname =  htmlspecialchars($_POST['firstname']);
            $lastname =  htmlspecialchars($_POST['lastname']);
            $age =  htmlspecialchars($_POST['age']);
            $country =  htmlspecialchars($_POST['country']);

            $sql = "UPDATE profiledetails SET firstname= '{$firstname}', lastname= '{$lastname}', age='{$age}', country= '{$country}' WHERE ID='{$ID}'";
            $db->query($sql);

        } else if(isset($_POST['title'])){

            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);

            $ID1 = $_POST['ID'];

            $sql = "UPDATE photos SET title= '{$title}', description= '{$description}', price='{$price}' WHERE ID='{$ID1}'";
            $db->query($sql);



        } else if(isset($_POST['deleteID'])){

            $deleteID = $_POST['deleteID'];

            $sql = "SELECT * FROM photos WHERE ID = {$deleteID}";
            $result = $db->query($sql);

            while($row = $result->fetch_array())
            {
                if(realpath($row['URL']) and is_writable($row['URL']))
                    unlink($row['URL']);
            }

            $sql = "DELETE FROM photos WHERE ID={$deleteID}";
            $db->query($sql);

        }



        header("location:profile.php?username=".$_SESSION['username']);




    }





} else{
    header('location:home.php');
}
