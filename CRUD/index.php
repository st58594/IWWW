<?php
require_once 'classes/Connection.php';
session_start();
if (!empty($_GET)) {
    if ($_GET["page"] != "registration") {
        if (empty($_SESSION["login"])) {
            $_GET["page"] = "login";
        }
    }
} else if(empty($_SESSION["login"])) {
    $_GET["page"] = "login";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<?php
include "./pages/header.php";


if (!empty($_GET)) {
    $path = "./pages/" . $_GET["page"] . ".php";
    if (file_exists($path)) {
        include $path;
    } else {

        echo "not page";
    }
}

?>
</body>
</html>