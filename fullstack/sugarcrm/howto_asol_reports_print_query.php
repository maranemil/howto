<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 13.07.16
 * Time: 12:18
 */


/**
Asol Reports Enterprise 4.4.9 - HowTo Print sqlQuery
---------------------------------------------------------
File: modules/asol_Reports/DetailView.php
Line 31:
*/

//print "<pre>"; print_r($_SESSION); print "</pre>";
$sqlQueryASOLXID = base64_encode($_POST['record']);
if(trim($_SESSION["sqlQueryASOLX"][$sqlQueryASOLXID])!="" ){
	echo '
    <br><br>
    <button id="sqlreportbtn">Show SQL</button>
    <div class="sqlreport" min-height: 5px; width="auto" style="background: #33ccff; padding: 15px 15px; ">
        <pre style="white-space: pre-wrap; word-wrap: break-word; ">
            <code>' . trim($_SESSION["sqlQueryASOLX"][$sqlQueryASOLXID]) . '</code>
        </pre>
    </div>
    <br /><br />

    <script>
        $( ".sqlreport" ).show();
        $( "#sqlreportbtn" ).click(function() { $( ".sqlreport" ).slideToggle( "slow" ); });
    </script>';

}

/*
---------------------------------------------------------
File: modules/asol_Reports/include_basic/generateReport.php
Line 1174 after: $sqlQuery = $sqlSelect.$sqlFrom.$sqlJoin.$sqlWhere.$sqlGroup.$sqlOrder.$sqlLimit;
*/


$sqlQueryASOLXID = base64_encode($_POST['record']);
//$sqlQueryASOLXID = base64_encode($recordId);
unset($_SESSION["sqlQueryASOLX"]);
$_SESSION["sqlQueryASOLX"][$sqlQueryASOLXID] = $sqlQuery;
$_SESSION["sqlQueryASOLXID"] = $_POST['record'];

