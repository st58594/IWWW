<div class="login-wrapper">
    <h1>Profile</h1>
    <?php
    if (!empty($_GET["e"])) {
        echo "<p class='err-log'>" . $_GET["e"] . "</p>";
    }
    ?>
    <form method="post" action="./php/profile.php">
        <div>
            <label>Login</label>
            <label>
                <input type="text" placeholder="login" name="login" required="required" readonly="readonly"
                       value="<?php echo $_SESSION["login"]; ?>">
            </label>
        </div>
        <div>
            <label>Password</label>
            <label>
                <input type="password" placeholder="password" name="password" required="required">
            </label>
        </div>
        <div>
            <label>Email</label>
            <label>
                <input type="email" placeholder="email" name="email">
            </label>
        </div>
        <div>
            <label>Competency</label>
            <label>
                <?php
                if ($_SESSION["competency"] == 0) {
                    echo '<input type="number" placeholder="Competency" name="competency" required="required" value="'.$_SESSION["competency"].'">';
                }else{
                    echo '<input type="number" placeholder="Competency" name="competency" required="required" readonly="readonly" value="'.$_SESSION["competency"].'">';
                }
                ?>
            </label>
        </div>
        <div>
            <input value="edit" class="submit" type="submit">
        </div>
    </form>
</div>