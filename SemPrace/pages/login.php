<?php
if (isset($_SESSION["Umelec"])) {
    unset($_SESSION["Umelec"]);
    ?>
    <script>
        window.location.reload();
    </script>
<?php
}
if (!empty($_POST)) {
    try {
        $_SESSION["Umelec"] = Umelec::loginUmelec($_POST["login"], $_POST["password"]);
        header("Location: ./index.php");
    } catch (PDOException $exception) {
    }
}

?>

<div class="login-wrapper">
    <h1>Login</h1>
    <?php
    if (!empty($exception)) {
        echo "<p class='err-log'>" . $exception->getMessage() . "</p>";
    }
    ?>
    <form class="login-form" method="post" action="./index.php?page=login">
        <div>
            <label class="label">Login:</label>
            <label>
                <input type="text" placeholder="login" name="login" required="required">
            </label>
        </div>
        <div>
            <label class="label">Heslo:</label>
            <label>
                <input type="password" placeholder="heslo" name="password" required="required">
            </label>
        </div>
        <div>
            <label for="sign-in" class="submit">
                <input id="sign-in" value="Přihlásit se" class="submit" type="submit">
                <i class="fa fa-sign-in"></i> Přihlásit se
            </label>
        </div>
        <div class="sec-href">
            <a href="./index.php?page=registration">Registrovat se</a>
        </div>
    </form>
</div>