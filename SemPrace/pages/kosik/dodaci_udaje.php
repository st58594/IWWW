<?php
?>
<form method="post" action="./kosik.php?page=prehled">
    <div class="product-wrapper">
        <div class="dodaci_udaje">
            <h2>Dodací údaje</h2>

            <div>
                <label>Jméno:</label>
                <label>
                    <input type="text" name="jmeno" placeholder="Jméno" required>
                </label>
            </div>
            <div>
                <label>Příjmení:</label>
                <label>
                    <input type="text" name="prijmeni" placeholder="Přijmení" required>
                </label>
            </div>
            <div>
                <label>Email:</label>
                <label>
                    <input type="email" name="email" placeholder="Email" required>
                </label>
            </div>
            <div>
                <label>Adresa:</label>
                <label>
                    <input type="text" name="adresa" placeholder="Adresa" required>
                </label>
            </div>
            <div>
                <label>Mobil:</label>
                <label>
                    <input type="text" name="mobil" pattern="[0-9]{9}" title="telefonni cislo bez mezer"
                           placeholder="123456789">
                </label>
            </div>
        </div>
        <div class="doprava">
            <h2>Doprava</h2>
            <label>
                <input type="radio" name="doprava" value="Posta" checked>
                Pošta
            </label>
            <label>
                <input type="radio" name="doprava" value="PPL">
                PPL
            </label>
            <label>
                <input type="radio" name="doprava" value="DPP">
                DPP
            </label>
            <label>
                <input type="radio" name="doprava" value="Zasilkovna">
                Zasilkovna
            </label>
        </div>
        <div class="Platba">
            <h2>Platba</h2>
            <label>
                <input type="radio" name="platba" value="Zaplaceno">
                Brana
            </label>
            <label>
                <input type="radio" name="platba" value="Dobirka" checked>
                Dobírka
            </label>
            <label>
                <input type="radio" name="platba" value="Převod">
                Převod
            </label>
        </div>
    </div>
    <div class="continue">
        <div id='finish-order' class='product-btn continue'>
            <a href='./kosik.php?page=prehled'><i class='fa fa-list'></i> Přehled</a>
        </div>
        <div id='finish-order' class='product-btn continue'>
            <input type="submit" name="dokoncit" value="Dokoncit">
        </div>
    </div>
</form>
