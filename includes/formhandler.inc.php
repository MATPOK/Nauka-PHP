<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usename = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try{
        require_once "dbh.inc.php";

        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $usename);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();
    } catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
}

