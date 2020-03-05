    <?php
    $configs = require('config.php');
    try{
       $conn = new PDO("mysql:host=".$configs["host"].";dbname=".$configs["db"], $configs["user"], $configs["pass"]);
       // set the PDO error mode to exception
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       echo "Connected successfully";
    }
    catch(PDOException $e){
       echo "Connection failed: " . $e->getMessage();
    }