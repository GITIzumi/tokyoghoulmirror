<?php
  session_start();
  include("_connected.php");
  include_once("langue.php");
  if (isset($_POST["force"]))
  {
    $valeur = $_POST["force"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["force"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["force"] = "0";
  }
  if (isset($_POST["faim"]))
  {
    $valeur = $_POST["faim"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["faim"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["faim"] = "0";
  }
  if (isset($_POST["courage"]))
  {
    $valeur = $_POST["courage"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["courage"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["courage"] = "0";
  }
  if (isset($_POST["charisme"]))
  {
    $valeur = $_POST["charisme"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["charisme"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["charisme"] = "0";
  }
  if (isset($_POST["eloquence"]))
  {
    $valeur = $_POST["eloquence"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["eloquence"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["eloquence"] = "0";
  }
  if (isset($_POST["intelligence"]))
  {
    $valeur = $_POST["intelligence"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["intelligence"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["intelligence"] = "0";
  }
  if (isset($_POST["culture"]))
  {
    $valeur = $_POST["culture"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["culture"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["culture"] = "0";
  }
  if (isset($_POST["dexterite"]))
  {
    $valeur = $_POST["dexterite"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["dexterite"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["dexterite"] = "0";
  }
  if (isset($_POST["agilite"]))
  {
    $valeur = $_POST["agilite"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["agilite"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["agilite"] = "0";
  }
  if (isset($_POST["vitalite"]))
  {
    $valeur = $_POST["vitalite"];
    if ($valeur >10)
    {
      $valeur = 10;
    }
    if ($valeur < 0)
    {
      $valeur = 0;
    }
    $_SESSION["crea-perso"]["stat"]["vitalite"] = $valeur;
  }
  else
  {
    $_SESSION["crea-perso"]["stat"]["vitalite"] = "0";
  }

  $data = [];
  foreach ($_SESSION["crea-perso"]["stat"] as $key => $value)
  {
    array_push($data,$value);
  }

if  (isset($_SESSION["crea-perso"]["nature"]))
{
  if  ($_SESSION["crea-perso"]["nature"] == 0)
  {
    $grostableau = array(
        array(
            "stats" => $langage_perso['creation_force'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["force"]
        ),
        array(
            "stats" => $langage_perso['creation_mental'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["faim"]
        ),
        array(
            "stats" => $langage_perso['creation_courage'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["courage"]
        ),
        array(
            "stats" => $langage_perso['creation_charisme'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["charisme"]
        ),
        array(
            "stats" => $langage_perso['creation_eloquence'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["eloquence"]
        ),
        array(
            "stats" => $langage_perso['creation_intelligence'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["intelligence"]
        ),
        array(
            "stats" => $langage_perso['creation_culture'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["culture"]
        ),
        array(
            "stats" => $langage_perso['creation_dexterite'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["dexterite"]
        ),
        array(
            "stats" => $langage_perso['creation_agilite'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["agilite"]
        ),
        array(
            "stats" => $langage_perso['creation_vitalite'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["vitalite"]
        ),
    );
  }
  else
  {
    $grostableau = array(
        array(
            "stats" => $langage_perso['creation_force'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["force"]
        ),
        array(
            "stats" => $langage_perso['creation_faim'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["faim"]
        ),
        array(
            "stats" => $langage_perso['creation_courage'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["courage"]
        ),
        array(
            "stats" => $langage_perso['creation_charisme'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["charisme"]
        ),
        array(
            "stats" => $langage_perso['creation_eloquence'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["eloquence"]
        ),
        array(
            "stats" => $langage_perso['creation_intelligence'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["intelligence"]
        ),
        array(
            "stats" => $langage_perso['creation_culture'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["culture"]
        ),
        array(
            "stats" => $langage_perso['creation_dexterite'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["dexterite"]
        ),
        array(
            "stats" => $langage_perso['creation_agilite'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["agilite"]
        ),
        array(
            "stats" => $langage_perso['creation_vitalite'][$user_langue],
            "valeur"=> $_SESSION["crea-perso"]["stat"]["vitalite"]
        ),
    );
  }

}
else
{
  $grostableau = array(
      array(
          "stats" => $langage_perso['creation_force'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["force"]
      ),
      array(
          "stats" => $langage_perso['creation_faim'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["faim"]
      ),
      array(
          "stats" => $langage_perso['creation_courage'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["courage"]
      ),
      array(
          "stats" => $langage_perso['creation_charisme'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["charisme"]
      ),
      array(
          "stats" => $langage_perso['creation_eloquence'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["eloquence"]
      ),
      array(
          "stats" => $langage_perso['creation_intelligence'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["intelligence"]
      ),
      array(
          "stats" => $langage_perso['creation_culture'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["culture"]
      ),
      array(
          "stats" => $langage_perso['creation_dexterite'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["dexterite"]
      ),
      array(
          "stats" => $langage_perso['creation_agilite'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["agilite"]
      ),
      array(
          "stats" => $langage_perso['creation_vitalite'][$user_langue],
          "valeur"=> $_SESSION["crea-perso"]["stat"]["vitalite"]
      ),
  );
}


echo json_encode($grostableau);
?>
