<?php
    session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Les Trois Marios Inc.</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">

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

    <script>

        $(document).ready(function() {

            $("#login").submit(function(e){

                e.preventDefault();
                var name = $("#name").val();

                if(name != "") {
                    $.ajax({
                        url: 'check_contract_name.php',
                        type: 'POST',
                        data: {name : name},
                        success: function (result) {

                            if (!result.localeCompare("false")) {

                                if ($("#mylang").text() == "Contract Name: ")
                                    alert("This contract name is already in the database.");
                                else
                                    alert("Ce nom de contrat est déjà en cours d'utilisation.");
                            }
                            else {
                                $.ajax({
                                    url: 'newcontract.php',
                                    type: 'POST',
                                    data: {name: name},
                                    success: function () {


                                        if ($("#mylang").text() == "Contract Name: ")
                                            window.location.href = "edit_contract.php?msg=" + encodeURIComponent("Contract added successfully.");
                                        else
                                            window.location.href = "edit_contract.php?msg=" + encodeURIComponent("Contrat ajouté avec succès.");

                                    }
                                })

                            }
                        },
                        error: function (error) {
                            alert(error);
                            return false;
                        }

                    })
                }
                else
                {

                    if ($("#mylang").text() == "Contract Name: ")
                        alert("Please complete form correctly.");
                    else
                        alert("S'il vous plaît remplir le formulaire correctement.");
                }
            })




        })



    </script>


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
                        <h2><?php echo $contract_title;?>:</h2>

                        <div style="float: left; margin:0 40px 20px 50px;">

                            <img style='width:180px; height:180px;' src='../images/addcontract.png' alt=''>

                        </div>
                        <!--left column -->
                        <form id="login"  method="post" style="margin-top: 20px;">

                            <label id="mylang"><?php echo $contract_name;?>: </label>
                            <p>
                                <input type="text" name="name" id="name" value="" size="40" title="<?php echo $contract_name;?>"/>
                            </p>


                            <p>
                                <input type="submit" value="<?php echo $create_user;?>" class="button" title="<?php echo $add_new_contract;?>."/>
                                <input type="reset" value="<?php echo $reset;?>" class="button" title="<?php echo $clear;?>." />
                            </p>

                        </form>
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