<?php

try {
    if (isset($_POST["stav"]) && isset($_POST["id_objednavky"])) {
        Objednavka::updateStav($_POST["stav"], $_POST["id_objednavky"]);
    }
    header("Location: ./sprava.php?page=objednavky");
} catch (PDOException $exception) {
    header("Location: ./sprava.php?page=objednavky&err=" . $exception->getMessage());
}
