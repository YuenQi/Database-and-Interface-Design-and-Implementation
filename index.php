<?php

include('config/connect.php');



?>




<!DOCTYPE html>
<html>
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #cbb09c;
    }

    li a {
        display: block;
        color: #ffffff;
        padding: 8px 8px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #555;
        color: white;
    }
    </style>
    <?php include('templates/header.php');?>

    <ul id="nav-mobile" class="center hide-on-small-and-down">
        <li><a href="create.php" >Create</a></li>
        <li><a href="read.php" >Read</a></li>
        <li><a href="update.php" >Update</a></li>
        <li><a href="delete.php" >Delete</a></li>
    </ul>

    <?php include('templates/footer.php');?>

</html>