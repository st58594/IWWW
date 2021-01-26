<header class="main-header" id="main-header">
    <nav id="left">
        <a href="./index.php">Eshop</a>
        <?php
        if (!empty($_SESSION["Umelec"])) {
            echo '<a href="./sprava.php?page=objednavky">Objednávky</a>';
        }
        ?>
    </nav>
    <nav id="right">
        <?php
        if (empty($_SESSION["Umelec"])) {
            echo "<a href='./index.php?page=login'><i class='fa fa-sign-in' aria-hidden='true'></i></a>";
        } else {
            echo "<a href='./sprava.php?page=profil'>";
            if ($_SESSION["Umelec"]["avatar"] == null) {
                echo '<i class="fa fa-user"></i>';
            } else {
                echo '<img class="thum-avatar" src="data:image/jpeg;base64,' . base64_encode($_SESSION["Umelec"]["avatar"]) . '"/>';
            }
            echo " <span class='umelec'>" . $_SESSION["Umelec"]["jmeno"] . " " . $_SESSION["Umelec"]["prijmeni"] . "</span></a>";

            if (isset($_SESSION["emulator"]) && !empty($_SESSION["emulator"])){
                echo "<a href='./sprava.php?action=unset'><i class='fa fa-eye-slash' aria-hidden='true'></i></a>";
            }

            echo "<a href='./index.php?page=login'><i class='fa fa-sign-out' aria-hidden='true'></i></a>";


        }

        ?>
        <a href="./kosik.php?page=prehled"><i class="fa fa-shopping-basket"></i></a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </nav>
</header>
<script>
    function myFunction() {
        var x = document.getElementById("main-header");
        var r = document.getElementById("right");
        var l = document.getElementById("left")
        if (x.className === "main-header") {
            x.className += " res";
            r.className += "responsive"
            l.className += "responsive"
        } else {
            x.className = "main-header";
            r.className = ""
            l.className = ""
        }
    }
</script>