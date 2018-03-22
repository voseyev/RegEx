<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 2/20/2018
 * Time: 11:19 AM
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function validPartRx($part) {
    $regexp = '/[AHS|ahs][WGP|wgp]-\d{1,2}-[a-z0-9][a-z0-9][a-z0-9][a-z0-9]/i';
    return preg_match($regexp, $part);
}

$parts = array("AP-12-3507", "  ap-99-X109  ", "SG-05-ab20",
    "ab-22-N250", "SG-xx-N250", "SG-22-250", "SG-22-250*");

echo "<p> -----Regex Version----- </p>";

foreach ($parts as $part) {
    if(validPartRx($part))
        echo "<p>$part is valid.</p>";
    else
        echo "<p>$part is not valid.</p>";
}
    echo "<p> -----Php Version----- </p>";

    foreach($parts as $part) {
        $data = explode('-', $part);
        $category = trim($data[0]);
        $warehouse = trim($data[1]);
        $alphanumeric = trim($data[2]);

        if (validCategory($category) == true & validWarehouse($warehouse) == true & validAlphanumeric($alphanumeric) == true) {
            echo "<p>$part is valid.</p>";
        } else {
            echo "<p>$part is not valid.</p>";
        }

        }


        function validCategory ($category)
        {

            if (strtoupper($category) == "HW" || strtoupper($category) == "SG" || strtoupper($category) == "AP") {
                return true;
            } else {
                return false;
            }
        }

        function validWarehouse($warehouse)
        {
            if (strlen($warehouse) == 2 & ctype_digit($warehouse) == true) {
                return true;
            } else {
                return false;
            }
        }

        function validAlphanumeric($alphanumeric)
        {
            if (strlen($alphanumeric) == 4 & ctype_alnum($alphanumeric) == true) {
                return true;
            } else {
                return false;
            }
        }

echo "<p> -----Javascript Version----- </p>";
?>

<label>Enter Part:
    <input type="text" id="part"></label><br>
<button id="btnCheck" >Check</button><br>
<p id="result"></p>

<script>
    //Grab our elements
    var btnCheck = document.getElementById("btnCheck");
    var txtPart = document.getElementById("part");
    var txtResult = document.getElementById("result");

    //Attach event handler to button
    btnCheck.onclick = fnCheck;

    //Define check function
    function fnCheck()
    {
        //Get the text box value
        var part = txtPart.value;
        if (validPart(part))
            txtResult.innerHTML = "Valid!";
        else
            txtResult.innerHTML = "Not valid";
    }


    function validPart(part)
    {
        var pattern = '[AHS|ahs][WGP|wgp]-\\d{1,2}-[a-z0-9][a-z0-9][a-z0-9][a-z0-9]';
        var regex = new RegExp(pattern, 'i');
        var n = part.search(regex);
        console.log(n);
        return n >= 0
    }
    </script>





