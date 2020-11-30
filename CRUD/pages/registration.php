<div class="login-wrapper">
    <h1>Registration</h1>
    <?php
    if (!empty($_GET["e"])) {
        echo "<p class='err-log'>" . $_GET["e"] . "</p>";
    }
    ?>
    <form method="post" action="./php/registration.php">
        <div>
            <label>Login</label>
            <label>
                <input type="text" placeholder="login" name="login" required="required">
            </label>
        </div>
        <div>
            <label>Password</label>
            <label>
                <input type="password" placeholder="password" name="password" required="required">
            </label>
        </div>
        <div>
            <input value="sign up" class="submit" " type="submit">
        </div>
        <div class="sec-href">
            <a href="index.php?page=login">sign in</a>
        </div>
    </form>
</div>