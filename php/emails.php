<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2016-02-29
 * Time: 10:41 AM
 */


function email_directors($userp,$subjectp,$contentp)
{

    //includes
    if(isset($_COOKIE["language"]))
    {
        if($_COOKIE["language"]=="fr")
            include("fr.php");
        else
            include("en.php");
    }
    else
        include("en.php");

    include 'database.php';
    include 'url.php';


    $con = mysqli_connect($host,$user,$password,$database);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo $fail . mysqli_connect_error();
    }
    else {

        $sql = "select email from users where type = 'Director'";
        $result = mysqli_query($con, $sql) or die("Error: ". mysqli_error($con));

        if(mysqli_num_rows($result))
        {

            while($row = mysqli_fetch_array($result))
            {
                $email_content = createMessage($userp,$subjectp,$contentp);
                mail($row['email'], $subject1, $email_content,$header1);


            }

        }
    }


}

//*******************************************************************************
//notify all users related to the contract where this complaint belongs to
function email_users($u,$idcomplaint, $userp,$subjectp,$contentp)
{
    //received parameters
    /*
     * $u = usertype
     * $idcomplaint = complaint id
     *
     * */

    //includes
    if(isset($_COOKIE["language"]))
    {
        if($_COOKIE["language"]=="fr")
            include("fr.php");
        else
            include("en.php");
    }
    else
        include("en.php");

    include 'database.php';
    include 'url.php';


    $con = mysqli_connect($host,$user,$password,$database);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo $fail . mysqli_connect_error();
    }
    else
    {

        //get the contract id which this complaint belongs to
        $sql = "select id_contract from complaints where id_complaint = ".$idcomplaint;
        $result = mysqli_query($con, $sql) or die("Error: ". mysqli_error($con));
        $temp = mysqli_fetch_array($result);
        $idcontract = $temp['id_contract'];

        //get all users related to this contracts
        $sql2 = "select email from users inner JOIN users_contracts ON users.username = users_contracts.username
                    WHERE users_contracts.id_name_contract = '".$idcontract."' and users.type = '".$u."'";
        $result2 = mysqli_query($con, $sql2) or die("Error: ". mysqli_error($con));

        if(mysqli_num_rows($result2))
            while($row = mysqli_fetch_array($result2))
            {

                $email_content = createMessage($userp,$subjectp,$contentp);
                mail($row['email'], $subject1, $email_content,$header1);

            }

    }

}


function mynl2br($text) {
    return stripslashes(str_replace('\r\n','<br/>',$text));
}

function createMessage($userp,$subjectp,$contentp)
{

    $email_test = mynl2br($contentp);

    $email_message = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8" />
                <title>Email Notification System</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />

                <style type="text/css">

                        body
                        {
                            font-family: Verdana, Arial, Helvetica, sans-serif;
                            color: #565656;
                        }

                    .text{
                        margin-top: 0;

                        font-size: 14px;
                        line-height: 25px;
                        margin-bottom: 25px
                    }

                    .logo{
                        border: 0;
                        -ms-interpolation-mode: bicubic;
                        display: block;

                        width: 250px;
                        height: auto;
                        margin-left: 70px;

                    }

                    .footer{

                        font-size: 11px;
                        margin-bottom: 1px;
                        margin-top: 1px;
                    }

                    hr.e {
                        border: 0;
                        height: 1px;
                        background: #333;
                        background-image: linear-gradient(to right, #ccc, #333, #ccc);
                    }

                </style>

            </head>
            <body>


                <div id="emb-email-header">
                    <img class="logo" src="http://www.lestroismarios.com/images/3marios_logo_v7.png" alt="L3M Logo">
                </div>

                <p class="text">A new comment has been posted, please visit <a href="http://www.lestroismarios.com/php/customer.php">lestroismarios.com</a> to review it.</p>
                    <hr class="e">
                    <p class="text">
                        <b>From: </b>'.$userp.'
                    <br>
                    <b>Subject: </b>'.$subjectp.'
                    <br>
                    <br>
                    <p class="text" style="margin-left: 20px;">'.$email_test.'</p>
                </p>

                <hr class="e">
                <p class="footer">You received this notification because you are registered as a user in lestroismarios.com.
                    To stop receiving these notification visit MY ACCOUNT and uncheck notify me by email of new comment posted.</p>

                <p class="footer">Please do not reply to this email which have been generated by our system. If you have questions regarding
                    this email please do not hesitate to contact us to the information provided in our website under the section CONTACT.</p>
                <hr class="e">

            </body>
            </html>
            ';

        if(isset($_COOKIE["language"]))
        {
            if($_COOKIE["language"]=="fr")
            {
                //french

                $email_message = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8" />
                    <title>Email Notification System</title>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

                    <style type="text/css">

                        body
                        {
                            font-family: Verdana, Arial, Helvetica, sans-serif;
                            color: #565656;

                        }

                        .text{
                            margin-top: 0;


                            font-size: 14px;

                            line-height: 25px;
                            margin-bottom: 25px
                        }

                        .logo{
                            border: 0;
                            -ms-interpolation-mode: bicubic;
                            display: block;

                            width: 250px;
                            height: auto;
                            margin-left: 70px;

                        }

                        .footer{

                            font-size: 11px;
                            margin-bottom: 1px;
                            margin-top: 1px;
                        }

                        hr.e {
                            border: 0;
                            height: 1px;
                            background: #333;
                            background-image: linear-gradient(to right, #ccc, #333, #ccc);
                         }



                    </style>

                </head>
                <body>


                    <div id="emb-email-header">
                        <img class="logo" src="http://www.lestroismarios.com/images/3marios_logo_v7.png" alt="L3M Logo">
                    </div>

                    <p class="text">Un nouveau commentaire a été publié, s\'il vous plaît visitez <a href="http://www.lestroismarios.com/php/customer.php">lestroismarios.com</a> pour l\'examiner.</p>
                    <hr class="e">
                        <p class="text">
                        <b>De: <b/>'.$userp.'
                        <br>
                        <b>Sujet: <b/>'.$subjectp.'
                        <br>
                        <br>
                        <p class="test" style="margin-left: 20px;">'.$email_test.'</p>
                        </p>
                    <hr class="e">
                    <p class="footer">Vous avez reçu cette notification parce que vous êtes enregistré comme utilisateur en lestroismarios.com.
                                    Pour cesser de recevoir ces notifications visite MON COMPTE et décochez Me prévenir par email de nouveau commentaire posté.</p>

                    <p class="footer">S\'il vous plaît ne pas répondre à cet e-mail qui ont été générés par votre système. Si vous avez des questions au sujet de cet e-mail s\'il
                                        vous plaît ne pas hésiter à nous contacter pour les informations fournies dans notre site dans la section CONTACTER.</p>

                    <hr class="e">
                </body>
                </html>
                ';

        }

    }



    return $email_message;
}

?>