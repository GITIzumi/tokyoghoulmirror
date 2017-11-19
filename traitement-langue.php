<?php
session_start();
include("_connected.php");
if (isset($_GET["url"])) {
  $url = strip_tags(trim($_GET["url"]));
}
if ($user_langue == "fr" ) {
  $user_langue_changer = "jp";
}
if ($user_langue == "jp" ) {
    $user_langue_changer = "fr";
}
include_once("connexion.php");
$query = $mysqli->query("UPDATE user SET user_langue = '$user_langue_changer' WHERE user_id = $user_id");
header("location:$url");
?>
