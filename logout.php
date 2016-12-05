<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 29/11/2016
 * Time: 12:05
 */

session_start();
if (isset($_SESSION['username']))
{
    unset($_SESSION['username']);
}

if (isset($_SESSION['shopper']))
{
    unset($_SESSION['shopper']);
}

if (isset($_SESSION['admin']))
{
    unset($_SESSION['admin']);
}

if (isset($_SESSION['photographer']))
{
    unset($_SESSION['photographer']);
}


header("location:home.php");
