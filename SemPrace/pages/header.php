<header class="main-header">
    <nav id="left">
        <a href="./index.php">Eshop</a>
        <!--        --><?php
        //        if (isset($_SESSION["Umelec"])){
        //            echo "<a href='./index.php'>předměty</a>";
        //            if ($_SESSION["Umelec"]["OPRAVNENI"] <= 1){
        //                echo "<a href='./sprava.php'>Správa</a>";
        //            }
        //            if ($_SESSION["Umelec"]["OPRAVNENI"] <= 2){
        //                echo "<a href='./index.php?page=hodnoceni'>Hodnoceni</a>";
        //            }
        //        }
        //        ?>

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
            echo " ".$_SESSION["Umelec"]["jmeno"]." ".$_SESSION["Umelec"]["prijmeni"] ."</a>";
            ?>
        <!--            <div class="dropdown" >-->
        <!--            <button class="dropbtn">-->
        <?php //echo $_SESSION["user"]["JMENO"]. " " . $_SESSION["user"]["PRIJMENI"];?><!--</button>-->
        <!--            <div class="dropdown-content">-->
        <!--                <a href="profile.php"><i class='fa fa-id-card' aria-hidden='true'></i> Profil </a>-->
        <!--                <a href="zpravy.php"><i class='fa fa-envelope' aria-hidden='true'></i> Zprávy </a>-->
        <!--                <a href="./logout.php"><i class='fa fa-sign-out' aria-hidden='true'></i> Odhlásit se </a>-->
        <!--            </div>-->
        <!--            </div >-->
        <!--            </div>-->
        <?php
        echo "<a href='./index.php?page=login'><i class='fa fa-sign-out' aria-hidden='true'></i></a>";
        }
        ?>
        <a href="#"><i class="fa fa-shopping-basket"></i></a>
    </nav>
</header>