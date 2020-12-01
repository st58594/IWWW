<header>
    <div id="logo">logo</div>
    <nav>

        <?php
        if(empty($_SESSION["login"])){
            echo "<a href='index.php?page=login'>login</a>";
        }else{
            if ($_SESSION["competency"] == 0){
                echo "<a href='index.php?page=list'>list</a>";
            }
            echo "<a href='orders.php'>Orders</a>";
            echo "<a href='eshop.php'>Eshop</a>";
            echo "<a href='index.php?page=profile'>".$_SESSION["login"]." profile</a>";
            echo "<a href='./php/logout.php'>logout</a>";
        }
        ?>
    </nav>
</header>