<?php
if (isset($_GET["err"])){
    echo "<p>".$_GET["err"]."</p>";
}
?>

<table class="objednavka">
    <thead>
    <tr>
        <th>Datum objednání</th>
        <th>Doprava a Platba</th>
        <th>Zakaznik</th>
        <th>UI | název | množství | cena</th>
        <th>Stav a datum změny</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach (Objednavka::getAll($_SESSION["Umelec"]["id_umelec"]) as $item) {
        ?>
        <tr>
            <form class="table-view" method="post" action="./sprava.php">
                <input type="hidden" name="id_objednavky" value="<?php echo $item["id_objednavka"]; ?>">
                <td>
                    <label>
                        <?php echo date('d. m. Y | H:i', strtotime($item["datum_objednani"])); ?>
                    </label>
                </td>
                <td>
                    <label><?php echo $item["doprava"]; ?></label>
                    <label><?php echo $item["platba"]; ?></label>
                    <label><?php echo number_format($item["celkova_cena"], 2, '.', ''); ?></label>
                </td>
                <td>
                    <label><?php echo "" . $item["jmeno"] . " " . $item["prijmeni"]; ?></label>
                    <label><?php echo $item["email"]; ?></label>
                    <label><?php echo $item["adresa"]; ?></label>
                    <label><?php echo $item["mobil"]; ?></label>
                </td>
                <td>
                    <?php
                    foreach (Polozka::getAll($item["id_objednavka"]) as $polozka) {
                        echo "<label>";
                        echo $polozka["id_produkt"]. " | ";
                        echo $polozka["nazev"]." | ";
                        echo number_format($polozka["mnozstvi"],0, '', ' ')." ks | ";
                        echo number_format($polozka["cena"], 2 ,',', ' ') ." Kč/ks";
                        echo "</label>";
                    }
                    ?>
                </td>
                <td>
                    <select name="stav" onchange="this.form.submit()">
                        <option value="Zadáno" <?php if ($item["stav"] == "Zadáno") echo "selected"; ?>>Zadáno</option>
                        <option value="Vyřízeno" <?php if ($item["stav"] == "Vyřízeno") echo "selected"; ?>>Vyřízeno
                        </option>
                        <option value="Zrušeno" <?php if ($item["stav"] == "Zrušeno") echo "selected"; ?>>Zrušeno
                        </option>
                    </select>
                    <label>
                        <?php
                        if ($item["datum_zmeny"] != null) {
                            echo date('d. m. Y | H:i', strtotime($item["datum_zmeny"]));
                        } else {
                            echo date('d. m. Y | H:i', strtotime($item["datum_objednani"]));
                        }
                        ?>
                    </label>
                </td>
            </form>
        </tr>
        <?php
    }
    ?>
</table>
