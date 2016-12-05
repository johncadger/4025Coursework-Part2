<?php

include("header.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {



    ?>
    <main class="main">
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="username"></br>
            <input type="password" name="password" placeholder="password"></br>
            <select name="type">
                <option value="shopper">Shopper</option>
                <option value="photographer">Photographer</option>
            </select></br>
            <p><input type="submit" value="Submit"></p>
        </form>

        <p><a href="home.php"</a>Cancel Registration</p>

    </main>

    <?php

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //if (isset($_POST['err'])){
          //  echo $_POST['err'];
        //} else{


            include("dbconnect.php");

            $username = htmlspecialchars($_POST["username"]);
            $password = htmlspecialchars($_POST["password"]);
            $type = $_POST["type"];

            //$dup_check = 0;

            //$sql = "SELECT * FROM users2 WHERE username= {$username}";
            //$result = $db->query($sql);

            //while ($row = $result->fetch_array()) {
            //    $dup_check++;
            //}

            //if ($dup_check > 0) {
                //$_POST['err'] = 1;
            //    header("location:register.php");
            //}


            $highestID = 0;

            $sql = "SELECT * FROM users2";
            $result = $db->query($sql);
            while ($row = $result->fetch_array()) {
                if ($row['ID']>$highestID){
                    $highestID = $row['ID'];
                }
            }

            $highestID = $highestID + 1;

            $sql = "INSERT INTO users2 (ID, username, password, type, approved) VALUES ('". $highestID ."', '" .$username."', '".$password."', '".$type."', false)";
            $db->query($sql);

            $sql = "SELECT * FROM users2 WHERE ID=$highestID";
            $result = $db->query($sql);
            while ($row = $result->fetch_array()) {
                $sql = "INSERT INTO profiledetails (ID, firstname, lastname, age, country) VALUES ('". $highestID ."', '...', '...', 0, '...')";
                $db->query($sql);
            }

            header("location:login.php");
















        //}








}