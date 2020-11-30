<?php

require_once "../classes/Connection.php";
try {
    $stmt = Connection::getPdoInstance()->prepare("INSERT INTO uzivatele (login, password, competency) values(:login, md5(:password), 1)");
    $stmt->bindParam(":login", $_POST["login"]);
    $stmt->bindParam(":password", $_POST["password"]);
    $stmt->execute();

    session_start();
    $_SESSION["login"] = $_POST["login"];
    $_SESSION["competency"] = 1;
    header("Location: ../index.php");
} catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        header("Location: ../index.php?page=registration&e=Sorry, " . $_POST["login"] . " is sign up yet");
    }else{
        header("Location: ../index.php?page=registration&e=" . $e->getMessage());
    }
}