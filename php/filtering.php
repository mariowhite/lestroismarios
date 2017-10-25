<?php
echo '

</br></br>
<h2>Filter Option:</h2>

<form id="filter" method="post" onsubmit="return checkDate();"  style="margin-left: 5px; margin-top: -15px;" >
    <p id="error" style="color:red; font-size:13px; padding-left:25px; margin-top: -15px; padding-bottom: 5px;"></p>
    <label>'.$from.': </label> </br>
    <input name="from_date" type="text" id ="from_date" onfocus="showCalendarControl(this);" size="22" maxlength="12" readonly/>
    </br></br>
    <label>'.$to.': </label></br>
    <input name="to_date" type="text" id ="to_date" onfocus="showCalendarControl(this);" size="22" maxlength="12" readonly/>
    </br>
    </br>
    <input style="margin-left: 20px;" type="submit" value="'.$filter.'" class="button" />
    <input type="reset" value="'.$reset.'" class="button" />
</form>


';
?>