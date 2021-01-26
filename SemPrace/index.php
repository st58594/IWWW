<?php
session_start();
function __autoload($class)
{
    require_once './classes/' . $class . '.php';
}

?>

<html lang="cz">
<head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/eshop.css">
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
<section class="main-container">
    <?php
    if (!empty($_GET["page"])) {
        $path = "./pages/" . $_GET["page"] . ".php";
        if (file_exists($path)) {
            include $path;
        } else {
            echo "not page";
        }
    } else {
        include "./pages/eshop.php";
    }
    ?>
</section>
</body>
</html>