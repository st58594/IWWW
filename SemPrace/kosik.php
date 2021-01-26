<?php
session_start();
function __autoload($class)
{
    require_once './classes/' . $class . '.php';
}

if (!empty($_POST["dokoncit"])) {
    if (isset($_POST["dokoncit"]) && isset($_SESSION["cart"]) && isset($_SESSION["celkova_cena"]) && $_SESSION["id_umelec"]) {
        try {
            Objednavka::insert($_SESSION["cart"], $_POST["email"], $_POST["jmeno"], $_POST["prijmeni"], $_POST["adresa"], $_POST["mobil"], $_SESSION["celkova_cena"], $_SESSION["id_umelec"]);
            unset($_SESSION["id_umelec"]);
            unset($_SESSION["celkova_cena"]);
            unset($_SESSION["cart"]);
            header("Location:./kosik.php?page=prehled&action=zakoupeno");
        } catch (PDOException $exception) {
            header("Location:./kosik.php?page=prehled&err=" . $exception->getMessage());
        }
    }
}


?>

<html lang="cz">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/kosik.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome-4.7.0/css/font-awesome.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop</title>
</head>
<body>
<?php
include "pages/header.php";
?>
<section class="main-container">
    <?php
    if (!empty($_GET["page"])) {
        $path = "./pages/kosik/" . $_GET["page"] . ".php";
        if (file_exists($path)) {
            include $path;
        } else {
            echo "not page";
        }
    }
    ?>

</section>
</body>
</html>