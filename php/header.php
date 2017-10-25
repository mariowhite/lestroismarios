<div class="wrapper">

<!--    <h1><a href="../index.php" id="logo">Les Trois Marios Inc.</a></h1>  -->

    <img style='height: 70px;width: 340px; float: left' src='../images/cleaning-about-icons.png' alt=''>
    <img style='height: 70px;width: 340px float: left' src='../images/cleaning-about-icons.png' alt=''>

    <ul id="icons">
        <?php

        if(isset($_SESSION['user']))
        {

            echo "<li><a href='logout.php'><img class='css3' src='../images/logout4.ico' style='padding: 1px' width='35' height='35' alt='' Title='".$logout."'></a><li>";
        }
        ?>
        <li><a href="" onclick="change_to_EN();"><img class="css3" src="../images/en.png" width="36" height="36" alt="en"  Title="<?php echo $english;?>"></a></li>
        <li><a href="" onclick="change_to_FR();"><img class="css3" src="../images/fr.png" width="36" height="36" alt="fr"  Title="<?php echo $french;?>"></a></li>
    </ul>

</div>
<nav>
    <ul id="menu">
        <li><a href="../index.php"><?php echo $home;?></a></li>

        <?php

        $ads = $_SERVER['REQUEST_URI'];

        if(substr($ads,1,3) == "php")
            $ads = substr($ads,5,strlen($ads)-1);
        else
            $ads = substr($ads,20,strlen($ads)-1);


        ?>

        <li <?php if($ads == "services.php") echo "id='menu_active'"; ?>><a href="services.php"><?php echo $services;?></a></li>
        <li <?php if($ads == "contacts.php") echo "id='menu_active'"; ?>><a href="contacts.php"><?php echo $contact;?></a></li>

        <?php

        if(isset($_SESSION['user'])) {
            echo "<li ";
            if ($ads == "forum.php")
                echo "id='menu_active'";
            echo "><a href='forum.php'>" . $blog . "</a></li>";
        }
        else {
            echo "<li ";
            if ($ads == "customer.php")
                echo "id='menu_active'";
            echo "><a href='customer.php'>" . $customer . "</a></li>";
        }

        ?>



    </ul>
</nav>
<?php
   $nmessage = rand(5, 10);

    switch ($nmessage) {
        case 5:echo "<div class='text1'>".$message1."<span>".$message2."</span></div>"; break;
        case 6:echo "<div class='text1'>".$message3."<span>".$message4."</span></div>"; break;
        case 7:echo "<div class='text1'>".$message5."<span>".$message6."</span></div>"; break;
        case 8:echo "<div class='text1'>".$message7."<span>".$message8."</span></div>"; break;
        case 9:echo "<div class='text1'>".$message1."<span>".$message2."</span></div>"; break;
        case 10:echo "<div class='text1'>".$message9."<span>".$message10."</span> </div>";

    }

?>

