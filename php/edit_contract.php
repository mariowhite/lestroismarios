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
                        <h2><?php echo $contract_edit_title1;?>:</h2>

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
                            $query = "SELECT * FROM contracts ORDER BY id_name";
                            $result = mysqli_query($con,$query);

                            if(mysqli_num_rows($result)) {

                                echo "<table class='altrowstable' id='alternatecolor' style='width: 70%;margin-left: 100px;'>";
                                echo "<tr>";
                                    echo "<th>".$contract_name."</th>";

                                    echo "<th style = 'width:60px;'>Options</th>";
                                echo"</tr>";

                                while ($row = mysqli_fetch_array($result))
                                {
                                    echo"<tr>";
                                        echo"<td>".$row['id_name']."</td>";


                                        echo "<td>
										    <a href='edit_contract_field.php?name=".$row['id_name']."'><img style='width:25px; heigth:25px;' src='../images/modify.png' alt='' Title='".$edit_contract_button."'></a>
							        	    <a href='delete_contract.php?name=".$row['id_name']."' onclick='return confirm(\"$dialog2\");'><img style='width:25px; heigth:25px;' src='../images/delete2.png' alt='' Title='".$delete_contract_button."'></a>
							        </td>";

                                    echo"</tr>";
                                }

                                echo"</table>";



                            }
                            else
                                echo "<h2 style='color: red;  font-size:18px; font-weight: 600;margin-left: 10px;'>There are no items at this time.</h2>";
                            mysqli_close($con);
                        }

                        ?>


                        <div style="text-align: center; margin-top: 30px;">

                            <a href='add_contracts.php'><img style='width:110px; heigth:110px;' src='../images/addcontract.png' alt='' Title='<?php echo $add_contract;?>'></a>

                        </div>
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