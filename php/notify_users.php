<?php

include 'database.php';
include 'url.php';
include 'emails.php';

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

$sessiontype = $_SESSION['type'];


if($sessiontype == 'Director') {

    $con = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo $fail . mysqli_connect_error();
    } else {

        $id = $_POST['id']; //id of the complaint or reply to be authorized
        //$type = $_POST['type'];

        //get all user type authorized to see this complaint or reply
        $userquery = "SELECT usertype FROM users_autorized WHERE id_complaint = " . $id;
        $userresult = mysqli_query($con, $userquery) or die($fail . mysqli_error($con));

        if (mysqli_num_rows($userresult)) {
            //if user where found
            while ($rowuser = mysqli_fetch_array($userresult)) {

                //get contract name where this id_complaint belongs to
                $sql = "SELECT id_contract, subject, text, username FROM complaints WHERE id_complaint = " . $id;
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result)) {
                    //id was found in complaints table
                    //get all user

                    $temp = mysqli_fetch_array($result);
                    $id_contract = $temp['id_contract'];

                    $sql2 = "SELECT name, email FROM users INNER JOIN users_contracts ON users.username = users_contracts.username
                              WHERE
                                users_contracts.id_name_contract = '" . $id_contract . "' AND
                                notify = 1 AND
                                users.type != 'Director' AND
                                users.type = '" . $rowuser['usertype'] . "'";

                    $result2 = mysqli_query($con, $sql2);

                    if (mysqli_num_rows($result2)) {
                        echo $sent_to_email.": \n";
                        while ($row = mysqli_fetch_array($result2)) {

                            $queryname = "SELECT name FROM users WHERE username = '".$temp['username']."'";
                            $resultname = mysqli_query($con, $queryname);
                            $rowname =  mysqli_fetch_array($resultname);
                            $userp = $rowname['name'];

                            $subjectp = $temp['subject'];
                            $contentp = $temp['text'];
                            $email_content = createMessage($userp,$subjectp,$contentp);

                            if(mail($row['email'], $subject1, $email_content,$header1))
                            echo $row['name']."-";
                            //header($base_url."index.php/email/notify/".urlencode($row['email']));
                            //mail($row['email'], $subject1, $email_message1, $header1);              //************************************** uncomment
                            //echo $row['name'];

                        }
                    }
                    else
                        echo $there_not.$rowuser['usertype'].$related.".\n";
                } else {
                    //check this id in reply table
                    $sql = "SELECT id_contract, text, username FROM reply WHERE id_reply = " . $id;
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result)) {
                        $temp = mysqli_fetch_array($result);
                        $id_contract = $temp['id_contract'];

                        $sql2 = "SELECT name, email FROM users INNER JOIN users_contracts ON users.username = users_contracts.username
                              WHERE
                                users_contracts.id_name_contract = '" . $id_contract . "' AND
                                notify = 1 AND
                                users.type != 'Director' AND
                                users.type = '" . $rowuser['usertype'] . "'";

                        $result2 = mysqli_query($con, $sql2);

                        if (mysqli_num_rows($result2)) {
                            echo $sent_to_email.": \n";
                            while ($row = mysqli_fetch_array($result2)) {

                                $queryname = "SELECT name FROM users WHERE username = '".$temp['username']."'";
                                $resultname = mysqli_query($con, $queryname);
                                $rowname =  mysqli_fetch_array($resultname);
                                $userp = $rowname['name'];

                                $subjectp = 'Reply';
                                $contentp = $temp['text'];
                                $email_content = createMessage($userp,$subjectp,$contentp);

                                if(mail($row['email'], $subject1, $email_content,$header1))

                                echo $row['name']."-";
                                //header($base_url."index.php/email/notify/".urlencode($row['email']));
                                //mail($row['email'], $subject1, $email_message1, $header1);             //************************************** uncomment


                            }
                        }
                        else
                            echo $there_not.$rowuser['usertype'].$related.".\n";


                    }

                }

            }

        }
        else
            echo $there_not.$rowuser['usertype'].$autho.".\n";
    }
}
