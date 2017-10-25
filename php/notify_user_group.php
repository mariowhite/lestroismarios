<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2016-02-29
 * Time: 10:53 AM
 */


include 'database.php';
include 'url.php';
include 'emails.php';

if(isset($_COOKIE["language"]))
{
    if($_COOKIE["language"]=="fr")
        include("fr.php");
    else
        include("en.php");
}
else
    include("en.php");

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

$sessiontype = $_SESSION['type'];


if($sessiontype == 'Director') {

    $con = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo $fail . mysqli_connect_error();
    } else {

        $id = $_POST['id']; //id of the complaint or reply to be authorized
        $type = $_POST['type'];


        //get contract name where this id_complaint belongs to
        $sql = "select id_contract, subject, text, username from complaints where id_complaint = ".$id;
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result))
        {
            //id was found in complaints table
            //get all user
            $temp = mysqli_fetch_array($result);
            $id_contract = $temp['id_contract'];

            $sql2 = "select name, email from users inner join users_contracts on users.username = users_contracts.username
                      where
                        users_contracts.id_name_contract = '".$id_contract."' and
                        notify = 1 AND
                        users.type != 'Director' and
                        users.type = '".$type."'";

            $result2 = mysqli_query($con, $sql2);

            if(mysqli_num_rows($result2))
            {
                echo $sent_to_email.": \n";
                while($row = mysqli_fetch_array($result2))
                {

                    $queryname = "SELECT name FROM users WHERE username = '".$temp['username']."'";
                    $resultname = mysqli_query($con, $queryname);
                    $rowname =  mysqli_fetch_array($resultname);
                    $userp = $rowname['name'];

                    $subjectp = $temp['subject'];
                    $contentp = $temp['text'];
                    $email_content = createMessage($userp,$subjectp,$contentp);

                    if(mail($row['email'], $subject1, $email_content,$header1))
                    //header($base_url."index.php/email/notify/".urlencode($row['email']));
                    //mail($row['email'], $subject1, $email_message1,$header1);           //************************************** uncomment
                    echo $row['name']."-";

                }
            }
            else
                echo $there_not.$type.$related.".\n";
        }
        else
        {
            //check this id in reply table
            $sql = "select id_contract, text, username from reply where id_reply = ".$id;
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result))
            {
                $temp = mysqli_fetch_array($result);
                $id_contract = $temp['id_contract'];

                $sql2 = "select name, email from users inner join users_contracts on users.username = users_contracts.username
                      where
                        users_contracts.id_name_contract = '".$id_contract."' and
                        notify = 1 AND
                        users.type != 'Director' and
                        users.type = '".$type."'";

                $result2 = mysqli_query($con, $sql2);

                if(mysqli_num_rows($result2))
                {
                    echo $sent_to_email.": \n";
                    while($row = mysqli_fetch_array($result2))
                    {

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
                        //mail($row['email'], $subject1, $email_message1,$header1);              //************************************** uncomment


                    }
                }
                else
                    echo $there_not.$type.$related.".\n";


            }

        }

    }

}

