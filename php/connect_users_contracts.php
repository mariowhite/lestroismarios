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
    <script type="text/javascript" src="../js/validation.js"></script>
    <script language="JavaScript" src="../js/rows.js"></script>

    <!-- new library ------------------------------------------------  -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>

    <script type="text/javascript" src="../js/cufon-yui.js"></script>
    <script type="text/javascript" src="../js/cufon-replace.js"></script>
    <script type="text/javascript" src="../js/Myriad_Pro_400.font.js"></script>
    <script type="text/javascript" src="../js/Myriad_Pro_300.font.js"></script>

    <script type="text/javascript" src="../js/languages.js"></script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="../js/ie6_script_other.js"></script>
    <script type="text/javascript" src="../js/html5.js"></script>
    <![endif]-->

    <script>

        $(document).ready(function() {

            //check and uncheck users from table
            $(".checker").click(function(e) {

                e.preventDefault();

                if ($("#contracts").val() != "default") {
                    if ($(this).attr('src') == "../images/unselect2.png") {
                        $(this).attr('src', '../images/select2.png');
                        if ($("#mylang").text() == "Contract Name:")
                            $(this).attr('title', 'Deselect');
                        else
                            $(this).attr('title', 'Décochez');
                    }
                    else {
                        $(this).attr('src', '../images/unselect2.png');
                        if ($("#mylang").text() == "Contract Name:")
                            $(this).attr('title', 'Select');
                        else
                            $(this).attr('title', 'Sélectionner');
                    }
                }
                else {
                    if ($("#mylang").text() == "Contract Name:")
                        alert("Please choose a contract before trying to add users.");
                    else
                        alert("S'il vous plaît choisir un contrat avant d'essayer d'ajouter des utilisateurs.");
                }

            });
            //---------------------------------------------------------------------------------------------
            //connect button
            $("#connect").click(function(){

                //contracts
                var contract = $("#contracts").val();

                //users
                var users = [];
                $("#alternatecolor tr:not(:first-child)").each(function () {
                    if ($(this).children().eq(0).children().eq(0).find('img')[0].title == 'Deselect' || $(this).children().eq(0).children().eq(0).find('img')[0].title == 'Décochez')
                        users.push($(this).children().eq(0).find('img')[0].alt);

                });

                if (users.length) {
                    $.ajax({
                        url: 'final_connect.php',
                        data: {contract: contract, users: users},
                        type: 'POST',
                        cache: false,
                        success: function (succ) {

                            alert(succ);
                            window.location.href = 'connect_users_contracts.php';
                        },
                        error: function (error) {
                            alert("Error: "+ error);
                        }
                    });

                }
            });

            //---------------------------------------------------------------------------------------------
            //change contract
            $('#contracts').change(function () {

                if ($(this).val() != "default") {
                    $.ajax({
                        url: 'get_users_contracts.php',
                        data: {contract: $(this).val()},
                        dataType: 'json',
                        type: 'POST',
                        cache: false,
                        success: function (succ) {

                            $("#alternatecolor tr:not(:first-child)").each(function () {

                                        $(this).children().eq(0).find('img')[0].src = '../images/unselect2.png';
                                        if ($("#mylang").text() == "Contract Name:")
                                            $(this).children().eq(0).find('img')[0].title = 'Select';
                                        else
                                            $(this).children().eq(0).find('img')[0].title = 'Sélectionner';

                                    })

                            $.each(succ, function (index, value) {

                                $("#alternatecolor tr:not(:first-child)").each(function () {
                                    if ($(this).children().eq(0).children().eq(0).find('img')[0].alt == value) {
                                        $(this).children().eq(0).find('img')[0].src = '../images/select2.png';
                                        if ($("#mylang").text() == "Contract Name:")
                                            $(this).children().eq(0).find('img')[0].title = 'Deselect';
                                        else
                                            $(this).children().eq(0).find('img')[0].title = 'Décochez';
                                    }

                                });

                            })


                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }

            });

            //---------------------------------------------------------------------------------------------




        });

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
                        <h2><?php echo $connecttitle;?>:</h2>

                        <h5 style="font-size: large; margin-left: 10px; font-weight: 100"><?php echo $connectexplain;?>.</h5>

                        <?php

                        if(isset($_GET['msg']))
                        {
                            $title = urldecode($_GET["msg"]);

                            echo "<h2 style='color: red;  font-size:18px; font-weight: 600;margin-left: 10px;'>".$title."</h2>";

                        }

                        ?>

                        <?php

                        include 'database.php';

                        //connect to database and check info
                        $con = mysqli_connect($host,$user,$password,$database);


                        // Check connection
                        if (mysqli_connect_errno($con))
                        {
                            echo $fail . mysqli_connect_error();
                        }
                        else
                        {

                        //--------------------------------------------------------------------------------------------------------
                        //contracts
                            $query = "SELECT * FROM contracts ORDER BY id_name";
                            $result = mysqli_query($con,$query);

                            if(mysqli_num_rows($result)) {

                            ?>
                                <label id="mylang" style="margin-left: 100px;"><?php echo $contract_name;?>:</label>
                                <select id="contracts" name="contracts" style="width:300px;">
                                    <option value="default"><?php echo $select_contract;?></option>

                                    <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['id_name'] . "'>" . $row['id_name'] . "</option>";

                                        }

                                        echo "</select>";

                                        }

                                        mysqli_close($con);
                        }
                         //--------------------------------------------------------------------------------------------------------
                        ?>


                                    <?php
                                    //--------------------------------------------------------------------------------------------------------
                                    //users
                                        include ("get_user_list.php");

                                    //----------------------------------------------------------------------------------------------------

                                    ?>



                        <input style="margin-top: 20px;margin-left:270px; width: 100px;" type="button" id="connect" value="<?php echo $connectbutton;?>" class="button" style="float:none "/>

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