<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2016-02-26
 * Time: 2:21 PM
 */

/*
 * receive the id of the parent that was deleted
 * 1.get the id_reply where id_parent is equal to the one passed by parameter
 * 2. delete where parent is equal to parameter
 * 3. delete folder
 * 4. call recursively delete_children(saved id)
 * */

function delete_children($id) //id of parent
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

        //1.get the id_reply where id_parent is equal to the one passed by parameter
        $query1 = "select id_reply from reply where id_parent = ".$id;
        $result = mysqli_query($con, $query1);
        if(mysqli_num_rows($result)) {

            while($row = mysqli_fetch_array($result)) {
                $newid = $row['id_reply'];

                //2. delete where parent is equal to parameter
                $query2 = "DELETE FROM reply WHERE id_reply = " . $newid;
                mysqli_query($con, $query2);


                //delete from table photo
                $query2 = "DELETE FROM photo WHERE id = '$newid'";
                mysqli_query($con, $query2);

                //3. delete folder
                // recursively remove a directory
                $dir = "../photos/" . $newid;
                foreach (glob($dir . '/*') as $file) {
                    if (is_dir($file))
                        rrmdir($file);
                    else
                        unlink($file);
                }
                if(is_dir($dir))
                    rmdir($dir);

                //4. call recursively delete_children(saved id)
                //recursively delete all replies and its respective photos
                delete_children($newid);
            }
        }

        mysqli_close($con);


    }

}



?>
