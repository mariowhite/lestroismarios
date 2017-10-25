<?php


function get_replys($id)
{
    include "database.php";


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
        if ($_SESSION['type'] != "Director") {
            $query2 = "SELECT * FROM reply INNER JOIN users_autorized ON reply.id_reply = users_autorized.id_complaint
                                WHERE ((id_parent = " . $id . ") AND
                                (username = '" . $_SESSION['user'] . "' OR approve = 1)AND
                                (users_autorized.usertype = '" . $_SESSION['type'] . "'))
                                ORDER BY date DESC";
        } else
            $query2 = "SELECT * FROM reply WHERE id_parent = " . $id;

        $result2 = mysqli_query($con, $query2);
        //check if there are complaints saved
        if (mysqli_num_rows($result2)) {

            while ($row2 = mysqli_fetch_array($result2)) {

                echo "<div id='comment-reply' class='comment-top comment-reply'>
                              <div class='content-box-header'>";

                echo "<div class='optionsbottom'>";

                //add picture
                echo "<a class='quickreply3' name='" . $row2['id_reply'] . "' rel='nofollow'><img title='" . $photo . "' class='replying' src='../images/camera3.png' alt='" . $photo . "'></a>";

                //reply button
                echo "<a class='quickreply4' name='" . $row2['id_reply'] . "' rel='nofollow'><img title='" . $reply . "' class='replying' src='../images/reply.png' alt='" . $reply . "'></a>";

                if ($_SESSION['type'] == "Director") {

                    //delete button
                    echo "<a class='quickreply1' href='deletereply.php?id=" . $row2['id_reply'] . "' rel='nofollow' onclick='return confirm(\"$dialog3\");'><img title='" . $delete . "' class='replying' src='../images/delete2.png' alt='" . $delete . "'></a>";

                    //modify button
                    echo "<a class='quickreply2' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img title='" . $edit . "' class='replying' src='../images/modify.png' alt='" . $edit . "'></a>";

                    //visibility button
                    if ($row2['approve'] == 0)
                        echo "<a class='quickreply5' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img title='" . $authorize . "' class='replying' src='../images/no.png' alt='" . $authorize . "'></a>";
                    else
                        echo "<a class='quickreply5' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img title='" . $deauthorize . "' class='replying' src='../images/yes.png' alt='" . $deauthorize . "'></a>";

                }
                echo "</div>";

                if ($_SESSION['type'] == "Director") {
                    //authorized users
                    echo "<div class='optionsbottom2'>";

                    $getauto = "SELECT * FROM users_autorized WHERE id_complaint = '" . $row2['id_reply'] . "'";
                    $autoresult = mysqli_query($con, $getauto);
                    $autousers = array();

                    while ($autrow = mysqli_fetch_array($autoresult)) {
                        array_push($autousers, $autrow['usertype']);
                    }
                    //users
                    if (in_array("User", $autousers)) {
                        echo "<a class='quickreply6' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img name='User' title='" . $user_type_user . "' class='replying' src='../images/adduser.png' alt='User'></a>";

                    } else {
                        echo "<a class='quickreply6' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img name='User' title='" . $user_type_user . "' class='replying' src='../images/deleteuser.png' alt='User'></a>";
                    }

                    //managers
                    if (in_array("Manager", $autousers)) {
                        echo "<a class='quickreply6' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img name='Manager' title='" . $user_type_manager . "' class='replying' src='../images/adduser.png' alt='Manager'></a>";

                    } else {
                        echo "<a class='quickreply6' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img name='Manager' title='" . $user_type_manager . "' class='replying' src='../images/deleteuser.png' alt='Manager'></a>";
                    }

                    //administrators
                    if (in_array("Administrator", $autousers)) {
                        echo "<a class='quickreply6' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img name='Administrator' title='" . $user_type_administrator . "' class='replying' src='../images/adduser.png' alt='Administrator'></a>";

                    } else {
                        echo "<a class='quickreply6' href='' name='" . $row2['id_reply'] . "' rel='nofollow'><img name='Administrator' title='" . $user_type_administrator . "' class='replying' src='../images/deleteuser.png' alt='Administrator'></a>";
                    }

                    echo "</div>";
                }
                echo "<div class='headerinfo'>";

                $queryname = "select name from users where username = '".$row2['username']."'";
                $resultname = mysqli_query($con,$queryname);

                $rowname = mysqli_fetch_array($resultname);

                echo "<label>" . $from . ": </label>" . $rowname['name'];
                echo " </br>";
                echo "<label>" . $postedon . ": </label>" . $row2['date'];
                echo "</br>";
                echo "<label>" . $subject . ": </label> RE: ";
                echo "</div>";
                echo "</div>"; //closing header

                echo "<div class='content-box-content'>
                      <p>" . nl2br($row2['text']) . "<p>";

                //show photos
                $query3 = "SELECT * FROM photo WHERE id= " . $row2['id_reply'];
                $result3 = mysqli_query($con, $query3);

                echo "<div class='wrapper'>";

                if (mysqli_num_rows($result3) != 1) {
                    while ($row3 = mysqli_fetch_array($result3)) {
                        echo "<div class='img'>";
                        if ($_SESSION['type'] == "Director") {
                            //delete buttom
                            echo "<a class='quickreply7' href='deletephoto.php?idc=" . $row2['id_reply'] . "&idf=" . $row3['filename'] . "' rel='nofollow' onclick='return confirm(\"$dialog4\");'>
                                          <img title='" . $delete . "' class='deletephoto' src='../images/delete2.png' alt='" . $delete . "'></a>";
                        }

                        echo "<a target = '_blank' href='slider.php?idc=" . $row2['id_reply'] . "'>
                                    <img class='photo' src='../photos/" . $row2['id_reply'] . "/" . $row3['filename'] . "' alt='" . $row3['filename'] . "' title='" . $row3['description'] . "' style='";

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
                            echo "<a class='quickreply7' href='deletephoto.php?idc=" . $row2['id_reply'] . "&idf=" . $row3['filename'] . "' rel='nofollow' onclick='return confirm(\"$dialog4\");'>
                                              <img title='" . $delete . "' class='deletephoto' src='../images/delete2.png' alt='" . $delete . "'></a>";
                        }

                        echo "<a target = '_blank' href='../photos/" . $row2['id_reply'] . "/" . $row3['filename'] . "'>
                                        <img class='photo' src='../photos/" . $row2['id_reply'] . "/" . $row3['filename'] . "' alt='" . $row3['filename'] . "' title='" . $row3['description'] . "' style='";

                        if ($_SESSION['type'] != "Director") {
                            echo "margin-top: 0px;";
                        }
                        echo "'></a>";

                    echo "</div>";


                }
                    echo "</div>";
                    //end getting photos


                    echo "</div>";


                    get_replys($row2['id_reply']);


                    echo "<div id=" . $row2['id_reply'] . "></div>";
                    echo "</div>";


                }
            }

            //close mysql con


        }


    }

    ?>