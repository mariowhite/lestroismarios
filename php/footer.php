

<div class="footerlink">
    <?php

    if(isset($_SESSION['user'])) {
        echo "<p class='lf' align= 'center'><b>" . $welcome . ": </b>" . $_SESSION['user'] . " (" . $_SESSION['type'] . ")</p>";
    }
    ?>
    <p class="lf" align= "center">Copyright &copy; 2015 <a href="http://mariowhitewebsite.com">Les Trois Marios Inc.</a> - <?php echo $rights;?></p>
</div>