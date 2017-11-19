<?php
session_start();
include("_connected.php");
include_once("langue.php");

if (isset($_POST["perso"]))
{
  $id_perso = strip_tags(trim($_POST["perso"]));
  if (isset($_SESSION["crea-groupe"]["perso"]))
  {
    if (in_array($id_perso, $_SESSION["crea-groupe"]["perso"]))
    {
      $perso_key = array_search($id_perso, $_SESSION["crea-groupe"]["perso"]);
      unset($_SESSION["crea-groupe"]["perso"][$perso_key]);
    }
    else
    {
      array_push($_SESSION["crea-groupe"]["perso"],$id_perso);
    }
  }
  else
  {
    $_SESSION["crea-groupe"]["perso"] = array();
    array_push($_SESSION["crea-groupe"]["perso"],$id_perso);
  }
}

if (isset($_POST["nomFR"]))
{
  $nomfr = trim(strip_tags($_POST["nomFR"]));
  $_SESSION["crea-groupe"]["nomfr"] = $nomfr;
}
if (isset($_POST["nomJP"]))
{
  $nomjp = trim(strip_tags($_POST["nomJP"]));
  $_SESSION["crea-groupe"]["nomjp"] = $nomjp;
}

if (isset($_POST["descFR"]))
{
  $descfr = trim(strip_tags($_POST["descFR"]));
  $_SESSION["crea-groupe"]["descfr"] = $descfr;
}
if (isset($_POST["descJP"]))
{
  $descjp = trim(strip_tags($_POST["descJP"]));
  $_SESSION["crea-groupe"]["descjp"] = $descjp;
}

if (isset($_POST["couleur"]))
{
  $couleur = trim(strip_tags($_POST["couleur"]));
  $_SESSION["crea-groupe"]["couleur"] = $couleur;
}



?>