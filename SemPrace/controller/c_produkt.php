<?php
if (!empty($_POST)) {
    try {
        if (isset($_POST["insertProdukt"])) {
            if (!isset($_FILES["nahled"])) throw new PDOException("Vyberte nahed.");
            if ($_FILES["nahled"]["size"] > 16 * 1024 * 1024) throw new PDOException("Moc velky nahled, max 16Mb");
            $image = fopen($_FILES["nahled"]["tmp_name"], "rb");
            Produkt::insert($_SESSION["Umelec"]["id_umelec"], $_POST["nazev"], $_POST["cena"], $_POST["mnozstvi"], $image, $_POST["popis"]);
        } elseif (isset($_POST["updateProdukt"])) {
            Produkt::update($_POST["id"], $_POST["nazev"], $_POST["cena"], $_POST["mnozstvi"], $_POST["popis"]);
        } elseif (isset($_POST["id_kategorie"]) && isset($_POST["id_produkt"])) {
            if (isset($_POST["insert"])) {
                Produkt_Kategorie::insert($_POST["id_kategorie"], $_POST["id_produkt"]);
            } else {
                Produkt_Kategorie::delete($_POST["id_kategorie"], $_POST["id_produkt"]);
            }
        } elseif (isset($_POST["insertKategorie"])) {
            Kategorie::insert($_POST["nazev"]);
        } elseif (isset($_POST["updateKategorie"])) {
            Kategorie::update($_POST["id"], $_POST["nazev"]);
        }

        if (isset($_POST["id_kategorie"])) {
            header("Location: ./sprava.php?page=produkty&action=kategorie&id=" . $_POST["id_produkt"]);
        } else {
            header("Location: ./sprava.php?page=" . $_GET["page"]);
        }
    } catch (PDOException $exception) {
        header("Location: ./sprava.php?page=produkty&err=" . $exception->getMessage());
    }
}