<?php
if (isset($_SESSION["Umelec"])) {

    if (isset($_GET["drop"])) {
        if ($_GET["drop"] == "avatar") {
            try {
                Umelec::updateAvatar($_SESSION["Umelec"]["id_umelec"], null);
                $_SESSION["Umelec"]["avatar"] = Umelec::getAvatar($_SESSION["Umelec"]["id_umelec"]);
                header('Location: ./sprava.php?page=profil');
            } catch (PDOException $exception) {
            }
        }
    }

    if (isset($_POST)) {
        if (isset($_FILES["avatar"])) {
            try {
                if ($_FILES["avatar"]["size"] > 64 * 1024) throw new PDOException("Moc velky avatar, max 64Kb");
                $image = fopen($_FILES["avatar"]["tmp_name"], "rb");
                Umelec::updateAvatar($_SESSION["Umelec"]["id_umelec"], $image);
                $_SESSION["Umelec"]["avatar"] = Umelec::getAvatar($_SESSION["Umelec"]["id_umelec"]);
                header('Location: ./sprava.php?page=profil');
            } catch (PDOException $exception) {
            }
        } elseif (!empty($_POST["edit-umelec"])) {
            try {
                if ($_POST["mobil"] == '') $_POST["mobil"] = null;
                Umelec::update($_SESSION["Umelec"]["id_umelec"], $_POST["jmeno"], $_POST["prijmeni"], $_POST["email"], $_POST["login"], $_POST["mobil"]);
                $_SESSION["Umelec"] = Umelec::getUmelec($_SESSION["Umelec"]["id_umelec"]);
                header('Location: ./sprava.php?page=profil');
            } catch (PDOException $exception) {

            }
        } elseif (!empty($_POST["edit-password"])) {
            try {
                if ($_POST["heslo1"] != $_POST["heslo2"]) throw new PDOException("Nové hesla se neshoduji");
                Umelec::loginUmelec($_SESSION["Umelec"]["login"], $_POST["oldpass"]);
                Umelec::updateHeslo($_SESSION["Umelec"]["id_umelec"], $_POST["heslo1"]);
                $_SESSION["Umelec"] = Umelec::getUmelec($_SESSION["Umelec"]["id_umelec"]);
            } catch (PDOException $exception) {
            }
        }
    }
} else {
    header("Location: ./index.php?page=login");
}
?>

<div class="login-wrapper">
    <h1>Profil</h1>
    <?php
    if (!empty($exception)) {
        echo "<p class='err-log'>" . $exception->getMessage() . "</p>";
    }
    ?>
    <div class="profile-image justify-center">
        <?php
        if ($_SESSION["Umelec"]["avatar"] == null) {
            echo '<i class="fa fa-4x fa-user"></i>';
        } else {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($_SESSION["Umelec"]["avatar"]) . '"/>';
        }
        ?>
    </div>
    <!--    Avatar-->
    <form method="post" name="avatar" action="./sprava.php?page=profil" enctype="multipart/form-data">
        <div>
            <label for="file-upload" class="submit">
                <input onchange="this.form.submit()" id="file-upload" type="file" name="avatar"
                       accept=".png, .jpeg, .jpg">
                <i class="fa fa-cloud-upload"></i> Vybrat avatara</label>
        </div>
        <div>
            <a class="submit" href="./sprava.php?page=profil&drop=avatar"><i class="fa fa-trash"></i> Smazat avatara</a>
        </div>
    </form>

    <!--Profil-->
    <form class="login-form" method="post" action="./sprava.php?page=profil">
        <div>
            <label class="label">Login:</label>
            <label>
                <input type="text" placeholder="login" name="login" value="<?php echo $_SESSION["Umelec"]["login"]; ?>"
                       required="required">
            </label>
        </div>
        <div>
            <label class="label">Jméno:</label>
            <label>
                <input type="text" placeholder="jméno" name="jmeno"
                       value="<?php echo $_SESSION["Umelec"]["jmeno"]; ?>"
                       required="required">
            </label>
        </div>
        <div>
            <label class="label">Příjmení:</label>
            <label>
                <input type="text" placeholder="příjmení" name="prijmeni"
                       value="<?php echo $_SESSION["Umelec"]["prijmeni"]; ?>" required="required">
            </label>
        </div>
        <div>
            <label class="label">E-mail:</label>
            <label>
                <input type="email" placeholder="e-mail" name="email"
                       value="<?php echo $_SESSION["Umelec"]["email"]; ?>"
                       required="required">
            </label>
        </div>
        <div>
            <label class="label">Mobil:</label>
            <label>
                <input type="tel" name="mobil" pattern="[0-9]{9}" placeholder="420123456789"
                       value="<?php echo $_SESSION["Umelec"]["mobil"]; ?>">
            </label>
        </div>
        <div>
            <label for="edit-umelec" class="submit">
                <input id="edit-umelec" class="submit" type="submit" name="edit-umelec" value="Uložit">
                <i class="fa fa-edit"></i> Uložit změny
            </label>
        </div>
    </form>

    <!--    Heslo-->
    <form method="post" class="login-form" action="./sprava.php?page=profil">
        <div>
            <label class="label">Staré heslo:</label>
            <label>
                <input type="password" placeholder="staré heslo" name="oldpass" required
            </label>
        </div>
        <div>
            <label class="label">Nové heslo:</label>
            <label>
                <input type="password" placeholder="nové heslo" name="heslo1" required
            </label>
        </div>
        <div>
            <label class="label">Nové heslo:</label>
            <label>
                <input type="password" placeholder="nové heslo" name="heslo2" required
            </label>
        </div>
        <div>
            <label for="update-password" class="submit">
                <input id="update-password" class="submit" type="submit" name="edit-password" value="Změnit Heslo">
                <i class="fa fa-edit"></i> Uložit nové heslo
            </label>
        </div>
    </form>
</div>