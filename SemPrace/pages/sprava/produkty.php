<?php
if (isset($_GET["action"]) && isset($_GET["id"])) {
    if ($_GET["action"] == "delete") {
        Produkt::delete($_GET["id"]);
    }
    if ($_GET["action"] == "kategorie") {
    }
}
?>
<h3>Produkty</h3>
<?php
if (isset($_GET["err"])) echo $_GET["err"];
?>
<table class="produkty">
    <thead>
    <tr>
        <th>Název</th>
        <th>Cena</th>
        <th>Množství</th>
        <th>Popis</th>
        <th>Náhled</th>
        <th>Kategorie</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach (Katalog::getAll($_SESSION["Umelec"]["id_umelec"]) as $item) {
        ?>
        <tr>
            <form class="table-view" method="post" action="./sprava.php?page=produkty" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $item["id_produkt"]; ?>">
                <td>
                    <input type="text" name="nazev" placeholder="název" value="<?php echo $item["nazev"]; ?>" required>
                </td>
                <td>
                    <input type="number" name="cena" min="0" step="0.01" placeholder="cena"
                           value="<?php echo number_format($item["cena"], 2, '.', ''); ?>" required>
                </td>
                <td>
                    <input type="number" name="mnozstvi" min="1" placeholder="množství"
                           value="<?php echo number_format($item["mnozstvi"]); ?>" required>
                </td>
                <td>
                    <textarea name="popis" placeholder="Popis"><?php echo $item["popis"]; ?></textarea>
                </td>
                <td>
                    <?php
                    echo '<img class="thumb" src="data:image/jpeg;base64,' . base64_encode($item["nahled"]) . '"/>';
                    ?>
                </td>
                <td>
                    <div class="submit-row">
                        <a href="./sprava.php?page=produkty&action=kategorie&id=<?php echo $item["id_produkt"]; ?>"><i
                                    class="fa fa-search-plus" aria-hidden='true'></i> Kategorie</a>
                    </div>
                </td>
                <td>
                    <button type="submit" name="updateProdukt" class="submit-row">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <div class="submit-row">
                        <a href="./sprava.php?page=produkty&action=delete&id=<?php echo $item["id_produkt"]; ?>"><i
                                    class="fa fa-trash" aria-hidden='true'></i></a>
                    </div>
                </td>

            </form>
        </tr>
        <?php
    }
    ?>
    <tr>
        <form class="table-view" method="post" action="./sprava.php?page=produkty" enctype="multipart/form-data">
            <td>
                <input type="text" name="nazev" placeholder="název" value="Art" required>
            </td>
            <td>
                <input type="number" name="cena" min="0" step="0.01" value="99.9" placeholder="cena" required>
            </td>
            <td>
                <input type="number" name="mnozstvi" min="1" value="10" placeholder="množství" required>
            </td>
            <td>
                <textarea name="popis" placeholder="Popis"></textarea>
            </td>
            <td>
                <label class="file-upload" for="file-upload">
                    <input id="file-upload" type="file" name="nahled"
                           accept=".png, .jpeg, .jpg" required="required">
                    <i class="fa fa-cloud-upload"></i> Vybrat náhled</label>
            </td>
            <td colspan="3">
                <button type="submit" name="insertProdukt" class="submit-row">
                    <i class="fa fa-plus-square"></i>
                </button>
            </td>
        </form>
    </tr>
    </tbody>
</table>