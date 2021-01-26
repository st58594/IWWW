<div class="login-wrapper">
    <h1>Registrace</h1>
    <?php
    if ($_POST) {
        try {
            if ($_POST["mobil"] == '') $_POST["mobil"] = null;
            Umelec::insert($_POST["jmeno"], $_POST["prijmeni"], $_POST["email"], $_POST["login"], $_POST["heslo"], $_POST["mobil"]);
            header("Location: ./index.php?page=login");
        } catch (PDOException $exception) {
            echo "<p class='err-log'>" . $exception->getMessage() . "</p>";
        }
    }
    ?>
    <form class="registration-form" method="post" action="./index.php?page=registration">
        <div>
            <label class="label">Login:</label>
            <label>
                <input type="text" placeholder="login" name="login" required="required">
            </label>
        </div>
        <div>
            <label class="label">Heslo:</label>
            <label>
                <input type="password" placeholder="heslo" name="heslo" required="required">
            </label>
        </div>
        <div>
            <label class="label">Jméno:</label>
            <label>
                <input type="text" placeholder="jméno" name="jmeno" required="required">
            </label>
        </div>
        <div>
            <label class="label">Příjmení:</label>
            <label>
                <input type="text" placeholder="příjmení" name="prijmeni" required="required">
            </label>
        </div>
        <div>
            <label class="label">E-mail:</label>
            <label>
                <input type="email" placeholder="e-mail" name="email" required="required">
            </label>
        </div>
        <div>
            <label class="label">Telefonní číslo:</label>
            <label>
                <input type="text" pattern="[0-9]{9}" title="telefonni cislo bez mezer" placeholder="123456789"
                       name="mobil">
            </label>
        </div>
        <div>
            <label for="sign-up" class="submit">
                <input id="sign-up" value="Registrovat se" class="submit" type="submit">
                <i class="fa fa-plus-square"></i> Registrovat se
            </label>
        </div>
    </form>
    <div class="sec-href">
        <a href="./index.php?page=login">Přihlásit se</a>
    </div>
</div>