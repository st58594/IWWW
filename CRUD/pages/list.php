<?php
    if ($_SESSION["competency"] != 0){
        die();
    }
?>

<div class="list-wrapper">
    <h1>List of users</h1>
    <?php
    require_once "./classes/Connection.php";
    if (!empty($_GET["e"])) {
        echo "<p class='err-log'>" . $_GET["e"] . "</p>";
    }
    ?>
    <form>
        <label>
            <input type="text" placeholder="login" readonly="readonly">
        </label>
        <label>
            <input type="email" placeholder="email" readonly="readonly">
        </label>
        <label>
            <input class="list-competency" type="number" placeholder="competency" readonly="readonly">
        </label>
    </form>
    <?php
    try {
        $stmt = Connection::getPdoInstance()->prepare("select id, login, competency, email from uzivatele");
        $stmt->execute();
        while ($result = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            ?>

            <form method="post" action="./php/profile.php">
                <input type="hidden" name="id" value="<?php echo $result[0]; ?>">
                <label>
                    <input type="text" placeholder="login" name="login" required="required" readonly="readonly"
                           value="<?php echo $result[1]; ?>">
                </label>
                <label>
                    <input type="email" placeholder="email" name="email" value="<?php echo $result[3]; ?>">
                </label>
                <label>
                    <input class="list-competency" type="number" placeholder="Competency" name="competency"
                           required="required" value="<?php echo $result[2]; ?>">
                </label>
                <input value="edit" class="row-submit" type="submit">
            </form>

            <?php
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>
</div>