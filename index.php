<?php
require_once 'classes/autoload.php';
$db = new pdodatabase;

$rows = $db->query('SELECT * FROM users');
foreach($rows as $row)
{
	echo $row->username.'<br />';
}

$row = $db->singleRow("SELECT * FROM `users` WHERE `username`='guitarbeerchocolate@googlemail.com'");

echo 'username = '.$row->username.'<br />';

$db->crud("INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, 'cathredman5@googlemail.com', '81dc9bdb52d04dc20036dbd8313ed055')");

echo $db->lastInserted('users');
?>