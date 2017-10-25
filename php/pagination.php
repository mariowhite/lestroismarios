<?php
/**
 * Created by PhpStorm.
 * User: Mario A. Blanco
 * Date: 2016-02-12
 * Time: 9:34 AM
 */

if(isset($_COOKIE["language"]))
{
    if($_COOKIE["language"]=="fr")
        include("fr.php");
    else
        include("en.php");
}
else
    include("en.php");


$pages = ceil($qty / $itemPerPage);

if($pages > 1)
{
    echo "<div class='pagination' id='pagination'>
		<a href='' title='1'>&laquo; ".$firstpage."</a>";


    if(!isset($_POST['page']))
    {
        echo "<a href='' title='1'>&laquo; ".$previouspage."</a>";
        echo "<a href='' class='number current' title='1'>1</a>";

        for($i=2;$i<=$pages;$i++)
        {
            echo "<a href='' class='number' title='".$i."'>".$i."</a>";
        }
        echo "<a href='' title='2'>".$nextpage." &raquo;</a>";
    }
    else
    {
        //setting previous
        if($_POST['page'] != 1)
            $previous = $_POST['page']-1;
        else
            $previous = 1;

        //setting next
        if($_POST['page'] != $pages)
            $next = $_POST['page']+1;
        else
            $next = $pages;

        echo "<a href='' title='".$previous."'>&laquo; ".$previouspage."</a>";

        for($i=1;$i<=$pages;$i++)
        {
            if($i == $_POST['page'])
                echo "<a href='' class='number current' title='".$i."'>".$i."</a>";
            else
                echo "<a href='' class='number' title='".$i."'>".$i."</a>";
        }
        echo "<a href='' title='".$next."'>".$nextpage." &raquo;</a>";


    }

    echo "<a href='' title='".$pages."'>".$lastpage." &raquo;</a>

	</div> ";
    //<!-- End .pagination -->
    echo "<div class='clear'></div>";

}




?>