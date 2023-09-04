<?php


$con = mysqli_connect("drinkki_opas-db-1","php_docker","password","php_docker");

if (!$con){
    echo "Connection Failed". mysqli_connect_error();
}
?>