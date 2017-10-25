<?php

session_start();
if (!isset($_SESSION['user']))
    header("Location: customer.php");

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

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $titleslider;?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/thumbnail-slider.css" rel="stylesheet" type="text/css" />
    <link href="../css/ninja-slider.css" rel="stylesheet" type="text/css" />



    <!-- new library ------------------------------------------------  -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>

    <script type="text/javascript" src="../js/languages.js"></script>

    <script src="../js/thumbnail-slider.js" type="text/javascript"></script>
    <script src="../js/ninja-slider.js" type="text/javascript"></script>

    <!-- new library ------------------------------------------------  -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>


    <style>

        body {font: normal 0.9em Arial;margin:0;}
        a {color:#1155CC;}
        ul li {padding: 10px 0;}
        header {display:block;padding:60px 0 10px;background:rgba(0,0,0,0.8);text-align:center;}
        header a {
            font-family: sans-serif;
            font-size: 24px;
            line-height: 24px;
            padding: 8px 13px 7px;
            color: #555;
            text-decoration:none;
            transition: color 0.7s;
        }
        header a.active {
            font-weight:bold;
            width: 24px;
            height: 24px;
            padding: 4px;
            text-align: center;
            display:inline-block;
            border-radius: 50%;
            background: #4d5256;
            color: #191919;
        }
        code {display:block;white-space:pre; background-color:#f6f6f6;padding:8px; overflow:auto;border:1px dotted #999;margin:6px 0;}
    </style>

    <script>

        $(document).ready(function() {

            $(".inner li").click(function(){

                var id_photo = $(this).children("a").attr("href").substring(10);

                var n = id_photo.indexOf("/");
                var id = id_photo.substring(0,n);
                var photo = id_photo.substring(n+1);

                $.ajax({
                    url: 'getdescription.php',
                    type: 'POST',
                    async:false,
                    data: {id : id, photo : photo},
                    success: function(succ){

                        $("#desc").html(succ);

                    },
                    error: function(e){
                        console.log("Error: " + e);
                    }

                })


            });
/*
            $("#ninja-slider-next").click(function(){

            }

            $("#ninja-slider-prev").click(function(){

            }

            $(".slider-inner").change(function(){

                alert ("change");
            });

            */

            //end of document ready
        })

    </script>
</head>
<body>

<?php

    include 'database.php';


//connect to database and check info
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno($con))
{
    echo $fail . mysqli_connect_error();
}
else {
    $query = "SELECT * FROM photo WHERE id= " . $_GET['idc'];

    $result1 = mysqli_query($con, $query);
    $result2 = mysqli_query($con, $query);
    ?>
    <div id='ninja-slider' class='fullscreen'>
        <div>
            <div class="slider-inner">
                <ul>
                    <?php
                    while ($row1 = mysqli_fetch_array($result1)) {

                        echo "<li><a class='ns-img' href='../photos/" . $_GET['idc'] . "/" . $row1['filename'] . "'></a></li>";

                    }
                    ?>

                </ul>
                <div class="fs-icon" title="<?php echo $expand;?>"></div>
            </div>
            <div id="thumbnail-slider">
                <div class="inner">
                    <ul>
                        <?php
                        while ($row2 = mysqli_fetch_array($result2)) {

                            echo "<li>
                            <a class='thumb' href='../photos/" . $_GET['idc'] . "/" . $row2['filename'] . "'></a>";
                            //<span>".$row2['description']."</span>
                        echo"</li>";

                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <h2 id="desc" style="text-align: center"></h2>

    <?php
}
?>




</body>
</html>
