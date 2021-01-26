<?php
?>
<h3>Emulator</h3>
<table class="emulator">
    <thead>
    <tr>
        <th>login</th>
        <th>Jmeno</th>
        <th>Prijmeni</th>
        <th>email</th>
        <th>oprávnění</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach (Umelec::getAll() as $item) {
        ?>
        <tr>
            <form class="table-view" method="post" action="./sprava.php">
                <input type="hidden" name="id_umelec" value="<?php echo $item["id_umelec"]; ?>">
                <td>
                    <label><?php echo $item["login"]; ?></label>
                </td>
                <td>
                    <label><?php echo $item["jmeno"]; ?></label>
                </td>
                <td>
                    <label><?php echo $item["prijmeni"]; ?></label>
                </td>
                <td>
                    <label><?php echo $item["email"]; ?></label>
                </td>
                <td>
                    <select name="opravneni" onchange="this.form.submit()">
                        <option value="ADMIN" <?php if ($item["opravneni"] == 'ADMIN') echo "selected"; ?>>Admin
                        </option>
                        <option value="UMELEC" <?php if ($item["opravneni"] == 'UMELEC') echo "selected"; ?>>Umělec
                        </option>
                    </select>
                </td>
                <td>
                    <button type="submit" name="emulator" class="submit-row">
                        <i class="fa fa-eye"></i>
                    </button>
                </td>
            </form>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
