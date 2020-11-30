<?php
require_once "../classes/Connection.php";
session_start();
try {
    $stmt = Connection::getPdoInstance()->prepare("select competency from uzivatele WHERE login = :login AND password = MD5(:password)");
    $stmt->bindParam(":login", $_POST["login"]);
    $stmt->bindParam(":password", $_POST["password"]);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["competency"] = $stmt->fetchColumn(0);
        header("Location: ../index.php");
    } else {
        header("Location: ../index.php?page=login&e=Login failed - wrong login or password");
    }
} catch (PDOException $e) {
    header("Location: ../index.php?page=login&e=" . $e->getMessage());
}

