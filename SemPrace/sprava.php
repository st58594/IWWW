<?php
session_start();
function __autoload($class)
{
    require_once './classes/' . $class . '.php';
}

if (!empty($_POST) || !empty($_GET["action"])) {
    if (isset($_POST["stav"])) {
        include "./controller/c_objednavka.php";
    } elseif (isset($_POST["id_umelec"]) || $_GET["action"] == "unset") {
        include "./controller/c_emulator.php";
    } else {
        include "./controller/c_produkt.php";
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
            <a href="./sprava.php?page=objednavky"><i class="fa fa-list" aria-hidden='true'></i> Objednávky</a>
            <a href="./sprava.php?page=produkty"><i class="fa fa-archive" aria-hidden='true'></i> Produkty</a>
            <a href="./sprava.php?page=profil"><i class="fa fa-user" aria-hidden='true'></i> Profil</a>
            <?php
            if ($_SESSION["Umelec"]["opravneni"] == 'ADMIN') {
                ?>
                <a href="./sprava.php?page=emulator"><i class="fa fa-eye" aria-hidden='true'></i> Emulátor</a>
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
                $path = "./pages/sprava/" . $_GET["page"] . ".php";
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