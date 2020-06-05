<?php
   $conn = new mysqli("localhost", "root", "seedubuntu", "dbtest");
   $pid = $mysqli->real_escape_string($_GET['PID']);
   $pwd = $mysqli->real_escape_string($_GET['Password']);
   $sql = "SELECT Name, Salary, SSN
           FROM employee
           WHERE pid= '$pid' and password='$pwd'";
?>

