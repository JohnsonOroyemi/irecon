<?php
$host = 'localhost';
$dbname = 'rccgnegy_ireportconstruction';
$username = 'rccgnegy_ireportconstruction';
$password = 'iADENIYI1392@';

$con = mysqli_connect($host, $username,$password, $dbname);

if($con)
{
    echo "";
}else{
    echo "Server and Database Not Connected";
}


?>