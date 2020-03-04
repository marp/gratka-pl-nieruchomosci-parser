<?php
//THIS IS ONLY FOR DEBUG PURPOSE
    include_once('./connection.php');
    echo "<hr>";
    if(isset($_GET['offers'])){
       $sql = "TRUNCATE TABLE `offers`";
       $statement = $conn->prepare($sql);
       $statement->execute();
    }
    if(isset($_GET['photos'])){
       $sql = "TRUNCATE TABLE `photos`";
       $statement = $conn->prepare($sql);
       $statement->execute();
    }
    if(isset($_GET['links'])){
       $sql = "TRUNCATE TABLE `links`";
       $statement = $conn->prepare($sql);
       $statement->execute();
    }
    if(isset($_GET['details'])){
       $sql = "TRUNCATE TABLE `details`";
       $statement = $conn->prepare($sql);
       $statement->execute();
    }
    if(isset($_GET['users'])){
       $sql = "TRUNCATE TABLE `users`";
       $statement = $conn->prepare($sql);
       $statement->execute();
    }
    if(isset($_GET['all'])){
       $sql = "
       TRUNCATE TABLE `links`;
       TRUNCATE TABLE `photos`;
       TRUNCATE TABLE `offers`;
       TRUNCATE TABLE `details`;
       TRUNCATE TABLE `users`;
       ";
       $statement = $conn->prepare($sql);
       $statement->execute();
    }

    echo "<a href='?offers'>TRUNCATE TABLE `offers`</a><br>";
    echo "<a href='?photos'>TRUNCATE TABLE `photos`</a><br>";
    echo "<a href='?links'>TRUNCATE TABLE `links`</a><br>";
    echo "<a href='?details'>TRUNCATE TABLE `details`</a><br>";
    echo "<a href='?users'>TRUNCATE TABLE `users`</a><br>";
    echo "<br><br>";
    echo "<a href='?all'>TRUNCATE ALL TABLES</a>";
?>