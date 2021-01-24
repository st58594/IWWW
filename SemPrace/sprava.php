<?php
session_start();
function __autoload($class)
{
    require_once './classes/' . $class . '.php';
}

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
        } elseif(isset($_POST["insertKategorie"])) {
            Kategorie::insert($_POST["nazev"]);
        } elseif (isset($_POST["updateKategorie"])) {
            Kategorie::update($_POST["id"], $_POST["nazev"]);
        }

        if (isset($_POST["id_kategorie"])){
            header("Location: ./sprava.php?page=produkty&action=kategorie&id=".$_POST["id_produkt"]);
        }else{
            header("Location: ./sprava.php?page=".$_GET["page"]);
        }
    } catch (PDOException $exception) {
        header("Location: ./sprava.php?page=produkty&err=" . $exception->getMessage());
    }
}


if (!isset($_SESSION["Umelec"])) {
    header("Location: ./index.php?page=login");
}
?>

<html lang="cz">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/sprava.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<?php
include "pages/header.php";
?>
<div class="main-container">
    <aside class="aside-container">
        <nav class="side-nav">
            <a href="./sprava.php?page=#"><i class="fa fa-list" aria-hidden='true'></i> Objednávky</a>
            <a href="./sprava.php?page=produkty"><i class="fa fa-archive" aria-hidden='true'></i> Produkty</a>
            <a href="./sprava.php?page=profil"><i class="fa fa-user" aria-hidden='true'></i> Profil</a>
            <?php
            if ($_SESSION["Umelec"]["opravneni"] == 'ADMIN') {
                ?>
                <a href="./sprava.php?page=#"><i class="fa fa-user-times" aria-hidden='true'></i> Umělci</a>
                <a href="./sprava.php?page=#"><i class="fa fa-eye" aria-hidden='true'></i> Cenzurovat</a>
                <a href="./sprava.php?page=kategorie"><i class="fa fa-hashtag" aria-hidden='true'></i> Kategorie</a>
                <?php
            }
            ?>
        </nav>

        <?php
        if (isset($_GET["action"]) && isset($_GET["id"])) {
            if ($_GET["action"] == "kategorie") {
                include "./pages/filtry.php";
            }
        }
        ?>
    </aside>
    <section class="content-container">
        <?php
        if (!empty($_GET["page"])) {
            $path = "./pages/" . $_GET["page"] . ".php";
            if (file_exists($path)) {
                include $path;
            } else {
                $path = "./pages/sprava/content/" . $_GET["page"] . ".php";
                if (file_exists($path)) {
                    include $path;
                } else {
                    echo "not page";
                }
            }
        }
        ?>
    </section>
</div>
</body>
</html>