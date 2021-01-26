<?php

if (isset($_POST)) {
    try {
        if (isset($_POST["insertKategorie"])) {
            Kategorie::insert($_POST["nazev"]);
        } elseif (isset($_POST["updateKategorie"])) {
            Kategorie::update($_POST["id"], $_POST["nazev"]);
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }

}

if (isset($_GET["action"]) && isset($_GET["id"])) {
    if ($_GET["action"] == "delete") {
        Kategorie::delete($_GET["id"]);
    }
}
?>
<h3>Kategorie</h3>
<table class="kategorie">
    <thead>
    <tr>
        <th>kategorie</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach (Kategorie::getAll() as $item) {
        ?>
        <tr>
            <form class="table-view" method="post" action="./sprava.php?page=kategorie">
                <input type="hidden" name="id" value="<?php echo $item["id_kategorie"]; ?>">
                <td>
                    <input type="text" name="nazev" value="<?php echo $item["nazev"]; ?>" required="required">
                </td>
                <td>
                    <button type="submit" name="updateKategorie" class="submit-row">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <div class="submit-row">
                        <a href="./sprava.php?page=kategorie&action=delete&id=<?php echo $item["id_kategorie"]; ?>"><i
                                    class="fa fa-trash" aria-hidden='true'></i></a>
                    </div>
                </td>
            </form>
        </tr>
        <?php
    }
    ?>
    <!--    Vlozeni-->
    <tr>
        <form class="table-view" method="post" action="./sprava.php?page=kategorie">
            <td>
                <input type="text" name="nazev" placeholder="Kategorie" required="required">
            </td>

            <td colspan="2">
                <button type="submit" name="insertKategorie" class="submit-row">
                    <i class="fa fa-plus-square"></i>
                </button>
            </td>
        </form>
    </tr>
    </tbody>
</table>