<?php
try {
    if (isset($_POST["emulator"])) {
        if (empty($_SESSION["emulator"]))
            $_SESSION["emulator"] = $_SESSION["Umelec"];
        $_SESSION["Umelec"] = Umelec::getUmelec($_POST["id_umelec"]);
        header("Location: ./index.php");
        exit();
    } elseif (isset($_POST["opravneni"])) {
        Umelec::updateOpravneni($_POST["id_umelec"], $_POST["opravneni"]);
    } elseif (!empty($_SESSION["emulator"])) {
        $_SESSION["Umelec"] = $_SESSION["emulator"];
        unset($_SESSION["emulator"]);
    }
    header("Location: ./sprava.php?page=emulator");
} catch (PDOException $exception) {
    header("Location: ./sprava.php?page=emulator&err=" . $exception->getMessage());
}


