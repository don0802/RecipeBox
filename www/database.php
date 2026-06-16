<?php
$dbhost = 'mariadb';
$dbname = 'RecipeBox';
$dbuser = 'root';
$dbpass = 'password';

$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
