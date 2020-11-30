<div class="login-wrapper">
    <h1>Login</h1>
    <?php
    if (!empty($_GET["e"])){
        echo "<p class='err-log'>".$_GET["e"]."</p>";
    }
    ?>
    <form method="post" action="./php/login.php">
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
            <input value="sign in" class="submit" " type="submit">
        </div>
        <div class="sec-href">
            <a href="index.php?page=registration" >sign up</a>
        </div>
    </form>
</div>