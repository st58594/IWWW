<?php
session_start();
include_once "../classes/Pripojeni.php";
include_once "../classes/Produkt.php";
if (!empty($_POST)) {
    if (isset($_POST["id_kategorie"]) && $_POST["nazev"]) {
        if (isset($_SESSION["filtr"][$_POST["nazev"]])) {
            unset($_SESSION["filtr"][$_POST["nazev"]]);
        } else {
            $_SESSION["filtr"][$_POST["nazev"]] = number_format($_POST["id_kategorie"]);
        }
    }
}

if (!empty($_GET)) {
    if ($_GET["action"] == "add" && !empty($_GET["id"])) {
        addToCart($_GET["id"]);
    }

    if ($_GET["action"] == "remove" && !empty($_GET["id"])) {
        removeFromCart($_GET["id"]);
    }

    if ($_GET["action"] == "delete" && !empty($_GET["id"])) {
       deleteFromCart($_GET["id"]);
    }
}

function addToCart($productId)
{
    $produkt = Produkt::get($productId);
    if (!array_key_exists($productId, $_SESSION["cart"]) && $produkt["mnozstvi"] > 0) {
        $_SESSION["cart"][$productId]["amount"] = 1;
    } else {
        if ($_SESSION["cart"][$productId]["amount"]+1 <= $produkt["mnozstvi"]){
            $_SESSION["cart"][$productId]["amount"]++;
        }
    }

    if (!empty($_SESSION["cart"]) && $_GET["iu"]){
        $_SESSION["id_umelec"] = $_GET["iu"];
    }
}

function removeFromCart($productId)
{
    if (array_key_exists($productId, $_SESSION["cart"])) {
        if ($_SESSION["cart"][$productId]["amount"] <= 1) {
            unset($_SESSION["cart"][$productId]);
        } else {
            $_SESSION["cart"][$productId]["amount"]--;
        }
    }
}

function deleteFromCart($productId)
{
    unset($_SESSION["cart"][$productId]);

    if (empty($_SESSION["cart"])){
        unset($_SESSION["id_umelec"]);
    }
}

if (isset($_GET["page"])){
    header("Location:../kosik.php?page=prehled");
}else{
    header("Location:../index.php");
}
