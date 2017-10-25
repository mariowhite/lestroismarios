<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Les Trois Marios Inc.</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">

    <script type="text/javascript" src="../js/validation.js"></script>
    <script language="JavaScript" src="../js/rows.js"></script>
    <script type="text/javascript" src="../js/jquery-1.4.2.js" ></script>
    <script type="text/javascript" src="../js/cufon-yui.js"></script>
    <script type="text/javascript" src="../js/cufon-replace.js"></script>
    <script type="text/javascript" src="../js/Myriad_Pro_400.font.js"></script>
    <script type="text/javascript" src="../js/Myriad_Pro_300.font.js"></script>

    <!-- new library ------------------------------------------------  -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>

    <script type="text/javascript" src="../js/languages.js"></script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="../js/ie6_script_other.js"></script>
    <script type="text/javascript" src="../js/html5.js"></script>
    <![endif]-->


</head>

<body id="page3">


<?php

if(isset($_COOKIE["language"]))
{
    if($_COOKIE["language"]=="fr")
        include("fr.php");
    else
        include("en.php");
}
else
    include("en.php");
?>

<!-- START PAGE SOURCE -->
<div class="extra">
    <div class="body1">
        <div class="main">
            <header>
                <?php
                include"header.php";
                ?>
            </header>


            <section id="content">
                <div class="line1">
                    <!--left column -->
                    <article class="col1">

                        <h2><?php echo $calendar; ?></h2>


                        <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=lestroismarioscalendar%40gmail.com&amp;color=%231B887A&amp;ctz=America%2FToronto" style="border-width:0" width="650" height="600" frameborder="0" scrolling="no"></iframe>

                    </article>


                    <!--right column -->
                    <article class="col2 pad_left1">
                        <?php
                        include"right_menu.php";
                        ?>
                    </article>

                </div>
            </section>
        </div>
    </div>
    <div class="block"></div>
</div>
<div class="body2">
    <div class="main">
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </div>
</div>
<!-- END PAGE SOURCE -->
</html>




