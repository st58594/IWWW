<?php
require_once "../classes/Connection.php";
session_start();
try {
    if (empty($_POST["id"])) {
        $stmt = Connection::getPdoInstance()->prepare("Update uzivatele SET login = :login, password = md5(:password), competency = :competency, email = :email where login = :where");
        $stmt->bindParam(":where", $_SESSION["login"]);
        $stmt->bindParam(":login", $_POST["login"]);
        $stmt->bindParam(":password", $_POST["password"]);
        $page = "profile";
    }else{
        $stmt = Connection::getPdoInstance()->prepare("Update uzivatele SET competency = :competency, email = :email where id = :where");
        $stmt->bindParam(":where", $_POST["id"]);
        $page = "list";
    }
    $stmt->bindParam(":competency", $_POST["competency"]);
    $stmt->bindParam(":email", $_POST["email"]);
    $stmt->execute();

    if (empty($_POST["id"])){
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["competency"] = $_POST["competency"];
    }
    header("Location: ../index.php?page=".$page."&e=Success.");
} catch (PDOException $e) {
       header("Location: ../index.php?page=list&e=" . $e->getMessage());
}