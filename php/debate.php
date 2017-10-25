<?php

include 'database.php';
include 'get_replys.php';

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

if (isset($_COOKIE["language"])) {
    if ($_COOKIE["language"] == "fr")
        include("fr.php");
    else
        include("en.php");
} else
    include("en.php");

//connect to database and check info
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno($con)) {
    echo $fail . mysqli_connect_error();
} else {

    $itemPerPage = 25;
    if (isset($_POST['items'])) {
        $itemPerPage = $_POST['items'];
    }

    $page = 0;
    if (isset($_POST['page'])) {
        $page = ($_POST['page'] - 1) * $itemPerPage;

    }


    $query1 = "";
    if (isset($_POST['from_date']))
    {
        //if a filter is applied
        //TODO
        //Check filtering when user != Director
        if ($_SESSION['type'] != "Director") {
            $query1 .= "SELECT * FROM complaints INNER JOIN users_autorized ON complaints.id_complaint = users_autorized.id_complaint
                                WHERE id_contract IN (SELECT id_name_contract FROM users_contracts WHERE username='" . $_SESSION['user'] . "') AND
                                (username = '" . $_SESSION['user'] . "' OR approve = 1) AND (date >= '" . $_POST['from_date'] . "' && date <= '" . $_POST['to_date'] . "') AND
                                (users_autorized.usertype = '" . $_SESSION['type'] . "') ORDER BY DATE DESC";

        } else {
            //if users is a director, show all complaints and all respective replies in the from - to limit
            $query1 .= "SELECT * FROM complaints WHERE date >= '" . $_POST['from_date'] . "' && date <= '" . $_POST['to_date'] . "'  ORDER BY date DESC";
        }

    }
    else {
        if ($_SESSION['type'] != "Director") {
            $query1 .= "SELECT * FROM complaints INNER JOIN users_autorized ON complaints.id_complaint = users_autorized.id_complaint
                                WHERE id_contract IN (SELECT id_name_contract FROM users_contracts WHERE username='" . $_SESSION['user'] . "') AND
                                (username = '" . $_SESSION['user'] . "' OR approve = 1)AND
                                (users_autorized.usertype = '" . $_SESSION['type'] . "') ORDER BY DATE DESC";

        } else {
            //if users is a director, show all complaints and all respective replies
            $query1 .= "SELECT * FROM complaints ORDER BY date DESC";
        }
    }

    $result1 = mysqli_query($con, $query1);

    //total number of elements for pagination
    $qty = mysqli_num_rows($result1);

    //set limits of pagination
    $query1 .= " LIMIT " . $page . "," . $itemPerPage;

    $result1 = mysqli_query($con, $query1);

    //check if there are complaints saved
    if (mysqli_num_rows($result1)) {
        ?>



        <div id="items_div" style="float: right; margin-top: -30px;">
            <label for="itemperpageselect"><?php echo $items; ?>:
                <select id="itemperpageselect">
                    <option value="5" <?php if ($itemPerPage == 5) echo " selected"; ?>>5</option>
                    <option value="10" <?php if ($itemPerPage == 10) echo " selected"; ?>>10</option>
                    <option value="25" <?php if ($itemPerPage == 25) echo " selected"; ?>>25</option>
                    <option value="50" <?php if ($itemPerPage == 50) echo " selected"; ?>>50</option>
                    <option value="100" <?php if ($itemPerPage == 100) echo " selected"; ?>>100</option>
                </select>
            </label>
        </div>


        <?php
        $querycontract = "SELECT id_name_contract FROM users_contracts WHERE username = '".$_SESSION['user']."'";
        $resultcontract = mysqli_query($con, $querycontract);

        ?>

        <div style="margin-top: -30px; float: left; margin-left: 10px;">
            <label for="contract"><?php echo $contract_name; ?>:
                <select id="contractselect" style="min-width: 300px;">
                        <option value="<?php echo $all;?>" selected><?php echo $all;?></option>
                    <?php
                        while ($rowcontract = mysqli_fetch_array($resultcontract))
                            echo "<option value='".$rowcontract['id_name_contract']."'>".$rowcontract['id_name_contract']."</option>";
                    ?>

                </select>
            </label>
        </div>

        <?php

        while ($row1 = mysqli_fetch_array($result1)) {

            //print a complaint
            echo "<div id='comment-top' class='comment-top'>
					        <div class='content-box-header'>";

            echo "<div class='optionsbottom'>";

            //add picture
            echo "<a class='quickreply3' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img title='" . $photo . "' class='replying' src='../images/camera3.png' alt='Photo'></a>";

            //reply button
            echo "<a class='quickreply4' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img title='" . $reply . "' class='replying' src='../images/reply.png' alt='Reply'></a>";

            if ($_SESSION['type'] == "Director") {

                //delete button
                echo "<a class='quickreply1' href='deletecomment.php?id=" . $row1['id_complaint'] . "' rel='nofollow' onclick='return confirm(\"$dialog3\");'><img title='" . $delete . "' class='replying' src='../images/delete2.png' alt='Delete'></a>";


                //modify button
                echo "<a class='quickreply2' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img title='" . $edit . "' class='replying' src='../images/modify.png' alt='Edit'></a>";


                //visibility button
                if ($row1['approve'] == 0)
                    echo "<a class='quickreply5' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img title='" . $authorize . "' class='replying' src='../images/no.png' alt='Authorize'></a>";
                else
                    echo "<a class='quickreply5' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img title='" . $deauthorize . "' class='replying' src='../images/yes.png' alt='Deauthorize'></a>";

            }
            echo "</div>";

            if ($_SESSION['type'] == "Director") {
                echo "<div class='optionsbottom2'>";

                $getauto = "SELECT * FROM users_autorized WHERE id_complaint = '" . $row1['id_complaint'] . "'";
                $autoresult = mysqli_query($con, $getauto);
                $autousers = array();

                while ($autrow = mysqli_fetch_array($autoresult)) {
                    array_push($autousers, $autrow['usertype']);
                }
                //users
                if (in_array("User", $autousers)) {
                    echo "<a class='quickreply6' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img name='User' title='" . $user_type_user . "' class='replying' src='../images/adduser.png' alt='User'></a>";

                } else {
                    echo "<a class='quickreply6' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img name='User' title='" . $user_type_user . "' class='replying' src='../images/deleteuser.png' alt='User'></a>";
                }

                //managers
                if (in_array("Manager", $autousers)) {
                    echo "<a class='quickreply6' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img name='Manager' title='" . $user_type_manager . "' class='replying' src='../images/adduser.png' alt='Manager'></a>";

                } else {
                    echo "<a class='quickreply6' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img name='Manager' title='" . $user_type_manager . "' class='replying' src='../images/deleteuser.png' alt='Manager'></a>";
                }

                //administrators
                if (in_array("Administrator", $autousers)) {
                    echo "<a class='quickreply6' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img name='Administrator' title='" . $user_type_administrator . "' class='replying' src='../images/adduser.png' alt='Administrator'></a>";

                } else {
                    echo "<a class='quickreply6' href='' name='" . $row1['id_complaint'] . "' rel='nofollow'><img name='Administrator' title='" . $user_type_administrator . "' class='replying' src='../images/deleteuser.png' alt='Administrator'></a>";
                }

                echo "</div>";
            }

            echo "<div class='headerinfo'>";

            $queryname = "select name from users where username = '".$row1['username']."'";
            $resultname = mysqli_query($con,$queryname);

            $rowname = mysqli_fetch_array($resultname);

            echo "<label>" . $from . ": </label>" . html_entity_decode(stripslashes($rowname['name']));
            echo "<br><label>" . $postedon . ": </label>" . $row1['date'];
            echo "</br>
								    <label>" . $subject . ": </label>" . html_entity_decode(stripslashes($row1['subject']));
            echo "</br>";
            echo "<label>" . $contract . ": </label>" . html_entity_decode(stripslashes($row1['id_contract']));
            echo "</div>";

            echo "</div>

                            <div class='content-box-content'>

                                    <p>" . nl2br($row1['text']) . "</p>";


            //show photos
            $query3 = "SELECT * FROM photo WHERE id= " . $row1['id_complaint'];
            $result3 = mysqli_query($con, $query3);

            echo "<div class='wrapper'>";

            if (mysqli_num_rows($result3) != 1)
            {
                while ($row3 = mysqli_fetch_array($result3)) {
                    echo "<div class='img'>";
                            if ($_SESSION['type'] == "Director") {
                                //delete buttom
                                echo "<a class='quickreply7' href='deletephoto.php?idc=" . $row1['id_complaint'] . "&idf=" . $row3['filename'] . "' rel='nofollow' onclick='return confirm(\"$dialog4\");'>
                                          <img title='" . $delete . "' class='deletephoto' src='../images/delete2.png' alt='" . $delete . "'></a>";
                            }

                            echo "<a target = '_blank' href='slider.php?idc=" . $row1['id_complaint'] . "'>
                                    <img class='photo' src='../photos/" . $row1['id_complaint'] . "/" . $row3['filename'] . "' alt='" . $row3['filename'] . "' title='" . $row3['description'] . "' style='";

                            if ($_SESSION['type'] != "Director") {
                                echo "margin-top: 0px;";
                            }
                            echo "'></a>";

                    echo "</div>";
                }
            }
            else
            {
                $row3 = mysqli_fetch_array($result3);
                echo "<div class='img'>";
                        if ($_SESSION['type'] == "Director") {
                            //delete buttom
                            echo "<a class='quickreply7' href='deletephoto.php?idc=" . $row1['id_complaint'] . "&idf=" . $row3['filename'] . "' rel='nofollow' onclick='return confirm(\"$dialog4\");'>
                                          <img title='" . $delete . "' class='deletephoto' src='../images/delete2.png' alt='" . $delete . "'></a>";
                        }

                        echo "<a target = '_blank' href='../photos/" . $row1['id_complaint'] . "/" . $row3['filename'] . "'>
                                    <img class='photo' src='../photos/" . $row1['id_complaint'] . "/" . $row3['filename'] . "' alt='" . $row3['filename'] . "' title='" . $row3['description'] . "' style='";

                        if ($_SESSION['type'] != "Director") {
                            echo "margin-top: 0px;";
                        }

                        echo "'></a>";

                echo "</div>";

            }
            echo "</div>";
            echo "</div>";

            echo "<div id=" . $row1['id_complaint'] . "></div>";

            get_replys($row1['id_complaint']);


            echo "</div>";


        }


        echo "<div style='text-align: center;''>";

        include 'pagination.php';

        echo "</div>";

    } else {
        //no complains to be shown
        echo "<h5 class='report'>" . $comments . ".</h5>";

    }


    mysqli_close($con);
}


?>