<?php

try {
    $produkt = Produkt::get($_GET["id"]);
}catch (PDOException $exception){
    echo $exception->getMessage();
    exit();
}

?>
<section class="filtry-container">
    <h3>Kategorie</h3>
    <?php
    echo "<p>".$produkt["nazev"]."</p>";
    foreach (Kategorie::getAll() as $item) {
        ?>
        <form name="updateKategorie" method="post" action="./sprava.php?page=produkty>">
            <?php
            echo "<input type='hidden' name='id_kategorie' value='".$item["id_kategorie"]."'>";
            echo "<input type='hidden' name='id_produkt' value='".$_GET["id"]."'>";
            echo "<label class='filtr' for='check".$item["id_kategorie"]."'>";
            if (Kategorie::get($_GET["id"], $item["id_kategorie"])){
                echo "<input id='check".$item["id_kategorie"]."' type='checkbox' onchange='this.form.submit()' checked>";
            }else{
                echo "<input id='check".$item["id_kategorie"]."' name='insert' value='1' type='checkbox' onchange='this.form.submit()'> ";
            }
            echo $item["nazev"]."</label>";
            ?>
        </form>


        <?php
    }
    ?>
</section>
