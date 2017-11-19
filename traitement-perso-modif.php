<?php
  session_start();
  include("_connected.php");
  include_once("langue.php");

  if (isset($_POST["prenomFR"])){            $_SESSION["modif-perso"]["inputtext"]["prenomFR"] =            trim(strip_tags($_POST["prenomFR"]));}
  if (isset($_POST["prenomJP"])){            $_SESSION["modif-perso"]["inputtext"]["prenomJP"] =            trim(strip_tags($_POST["prenomJP"]));}
  if (isset($_POST["nomFR"])){               $_SESSION["modif-perso"]["inputtext"]["nomFR"] =               trim(strip_tags($_POST["nomFR"]));}
  if (isset($_POST["nomJP"])){               $_SESSION["modif-perso"]["inputtext"]["nomJP"] =               trim(strip_tags($_POST["nomJP"]));}
  if (isset($_POST["surnomFR"])){            $_SESSION["modif-perso"]["inputtext"]["surnomFR"] =            trim(strip_tags($_POST["surnomFR"]));}
  if (isset($_POST["surnomJP"])){            $_SESSION["modif-perso"]["inputtext"]["surnomJP"] =            trim(strip_tags($_POST["surnomJP"]));}
  if (isset($_POST["descriptionFR"])){       $_SESSION["modif-perso"]["inputtext"]["descriptionFR"] =       trim(strip_tags($_POST["descriptionFR"]));}
  if (isset($_POST["descriptionJP"])){       $_SESSION["modif-perso"]["inputtext"]["descriptionJP"] =       trim(strip_tags($_POST["descriptionJP"]));}
  if (isset($_POST["masqueFR"])){            $_SESSION["modif-perso"]["inputtext"]["masqueFR"] =            trim(strip_tags($_POST["masqueFR"]));}
  if (isset($_POST["masqueJP"])){            $_SESSION["modif-perso"]["inputtext"]["masqueJP"] =            trim(strip_tags($_POST["masqueJP"]));}
  if (isset($_POST["metierFR"])){            $_SESSION["modif-perso"]["inputtext"]["metierFR"] =            trim(strip_tags($_POST["metierFR"]));}
  if (isset($_POST["metierJP"])){            $_SESSION["modif-perso"]["inputtext"]["metierJP"] =            trim(strip_tags($_POST["metierJP"]));}
  if (isset($_POST["age"])){                 $_SESSION["modif-perso"]["inputtext"]["age"] =                 trim(strip_tags($_POST["age"]));}
  if (isset($_POST["jour"])){                $_SESSION["modif-perso"]["inputtext"]["jour"] =                trim(strip_tags($_POST["jour"]));}
  if (isset($_POST["mois"])){                $_SESSION["modif-perso"]["inputtext"]["mois"] =                trim(strip_tags($_POST["mois"]));}
  if (isset($_POST["taille"])){              $_SESSION["modif-perso"]["inputtext"]["taille"] =              trim(strip_tags($_POST["taille"]));}
  if (isset($_POST["poids"])){               $_SESSION["modif-perso"]["inputtext"]["poids"] =               trim(strip_tags($_POST["poids"]));}
  if (isset($_POST["descriptionKagunefr"])){ $_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"] = trim(strip_tags($_POST["descriptionKagunefr"]));}
  if (isset($_POST["descriptionKagunejp"])){ $_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"] = trim(strip_tags($_POST["descriptionKagunejp"]));}

  if (isset($_POST["ward"]))
  {
    $ward = strip_tags(trim($_POST["ward"]));
    if (isset($_SESSION["modif-perso"]["ward"]))
    {
      if (in_array($ward,$_SESSION["modif-perso"]["ward"]))
      {
        $tag_key = array_search($ward, $_SESSION["modif-perso"]["ward"]);
        unset($_SESSION["modif-perso"]["ward"][$tag_key]);
        echo "0";
      }
      else
      {
        array_push($_SESSION["modif-perso"]["ward"],$ward);
        echo "1";
      }
    }
    else
    {
      $_SESSION["modif-perso"]["ward"] = [];
      array_push($_SESSION["modif-perso"]["ward"],$ward);
      echo "1";
    }
  }

  if (isset($_POST["groupe"]))
  {
    $appa = strip_tags(trim($_POST["groupe"]));
    if (isset($_SESSION["modif-perso"]["groupe"]))
    {
      if (in_array($appa,$_SESSION["modif-perso"]["groupe"]))
      {
        $tag_key = array_search($appa, $_SESSION["modif-perso"]["groupe"]);
        unset($_SESSION["modif-perso"]["groupe"][$tag_key]);
        echo "0";
      }
      else
      {
        array_push($_SESSION["modif-perso"]["groupe"],$appa);
        echo "1";
      }
    }
    else
    {
      $_SESSION["modif-perso"]["groupe"] = [];
      array_push($_SESSION["modif-perso"]["groupe"],$appa);
      echo "1";
    }
  }

  if (isset($_POST["genre"]))
  {
    $numero = $_POST["genre"];
    if ($numero == '1')
    {
      // choseh
      if (isset($_SESSION["modif-perso"]["genre"]))
      {
        if ($_SESSION["modif-perso"]["genre"] == '0')
        {
          $_SESSION["modif-perso"]["genre"] = '2';
          echo "2";
        }
        else
        {
          $_SESSION["modif-perso"]["genre"] = '0';
        }
      }
      else
      {
        $_SESSION["modif-perso"]["genre"] = '0';
      }
    }
    if ($numero == '2')
    {
      if (isset($_SESSION["modif-perso"]["genre"]))
      {
        if ($_SESSION["modif-perso"]["genre"] == '1')
        {
          $_SESSION["modif-perso"]["genre"] = '2';
          echo "2";
        }
        else
        {
          $_SESSION["modif-perso"]["genre"] = '1';
        }
      }
      else
      {
        $_SESSION["modif-perso"]["genre"] = '1';
      }
    }
    if ($numero == '3')
    {
      if (isset($_SESSION["modif-perso"]["nature"]))
      {
        if ($_SESSION["modif-perso"]["nature"] == "0")
        {
          $_SESSION["modif-perso"]["nature"] = "2";
          echo "2";
        }
        else
        {
          $_SESSION["modif-perso"]["nature"] = '0';
        }
      }
      else
      {
        $_SESSION["modif-perso"]["nature"] = '0';
      }
    }
    if ($numero == '4')
    {
      if (isset($_SESSION["modif-perso"]["nature"]))
      {
        if ($_SESSION["modif-perso"]["nature"] == "1")
        {
          $_SESSION["modif-perso"]["nature"] = '2';
          echo "2";
        }
        else
        {
          $_SESSION["modif-perso"]["nature"] = '1';
        }
      }
      else
      {
        $_SESSION["modif-perso"]["nature"] = '1';
      }
    }
    if ($numero == '5')
    {
      if (isset($_SESSION["modif-perso"]["vivant"]))
      {
        if ($_SESSION["modif-perso"]["vivant"] == '1')
        {
          $_SESSION["modif-perso"]["vivant"] = "2";
          echo "2";
        }
        else
        {
          $_SESSION["modif-perso"]["vivant"] = '1';
        }
      }
      else
      {
        $_SESSION["modif-perso"]["vivant"] = '1';
      }
    }
    if ($numero == '6')
    {
      if (isset($_SESSION["modif-perso"]["vivant"]))
      {
        if ($_SESSION["modif-perso"]["vivant"] == '0')
        {
          $_SESSION["modif-perso"]["vivant"] = "2";
          echo "2";
        }
        else
        {
          $_SESSION["modif-perso"]["vivant"] = '0';
        }
      }
      else
      {
        $_SESSION["modif-perso"]["vivant"] = '0';
      }
    }
    if ($numero == '7')
    {
      // visible par tous
      $_SESSION["modif-perso"]["visibilite"] = '0';
    }
    if ($numero == '8')
    {
      // visible que par moi
      $_SESSION["modif-perso"]["visibilite"] = '1';
    }
  }
if (isset($_POST["kagune"]))
{
  $kagune = strip_tags(trim($_POST["kagune"]));
  if (isset($_SESSION["modif-perso"]["kagune"]))
  {
    if (in_array($kagune,$_SESSION["modif-perso"]["kagune"]))
    {
      $tag_key = array_search($kagune, $_SESSION["modif-perso"]["kagune"]);
      unset($_SESSION["modif-perso"]["kagune"][$tag_key]);
      echo "0";
    }
    else
    {
      array_push($_SESSION["modif-perso"]["kagune"],$kagune);
      echo "1";
    }
  }
  else
  {
    $_SESSION["modif-perso"]["kagune"] = [];
    array_push($_SESSION["modif-perso"]["kagune"],$kagune);
    echo "1";
  }
}
if (isset($_POST["quinqueadd"]))
{
  $quinqueadd = $_POST["quinqueadd"];

  if ($quinqueadd == 0){
    if (empty($_SESSION["modif-perso"]["quinque"]))
    {
      $_SESSION["modif-perso"]["quinque"]["liste"] = [];
      if (isset($_SESSION["modif-perso"]["nombrequinque"]))
      {
        $_SESSION["modif-perso"]["nombrequinque"]++;
        $nombrequinque = $_SESSION["modif-perso"]["nombrequinque"];
      }
      else
      {
        $nombrequinque = $_SESSION["modif-perso"]["nombrequinque"] = 1;
      }
      array_push($_SESSION["modif-perso"]["quinque"]["liste"], $nombrequinque);
    }
    else
    {
      $_SESSION["modif-perso"]["nombrequinque"]++;
      $nombrequinque = $_SESSION["modif-perso"]["nombrequinque"];
      array_push($_SESSION["modif-perso"]["quinque"]["liste"], $nombrequinque);
    }
  }
  else
  {
    if (isset($_POST["quinquesupp"]))
    {
      $ligne = $_POST["quinquesupp"];

      $key = array_search($ligne, $_SESSION["modif-perso"]["quinque"]["liste"]);
      unset($_SESSION["modif-perso"]["quinque"]["liste"][$key]);
    }
  }
  $quinquenombre = count($_SESSION["modif-perso"]["quinque"]["liste"]);
  foreach ($_SESSION["modif-perso"]["quinque"]["liste"] as $key => $value)
  {
    echo "<div class=\"col-xs-12 itemquinque itemquinque".$value."\" data-nombre=\"".$quinquenombre."\">";
    echo "<p class=\"pouvoirInput\">";
    echo "<label for=\"nomfr".$value."\">".$langage_perso["creation_nom_francais"][$user_langue]."</label>";
    echo "</p>";
    echo "<p>";
    if (isset($_SESSION["modif-perso"]["quinque"]["nomfr"][$value]))
    {
      $saisie = $_SESSION["modif-perso"]["quinque"]["nomfr"][$value];
      echo "<input data-loop=\"".$value."\" data-champ=\"nomfr\" class='quinquecontrol' name=\"nomfr".$value."\" id=\"nomfr".$value."\" type=\"text\" value=\"".$saisie."\">";
    }
    else
    {
      echo "<input data-loop=\"".$value."\" data-champ=\"nomfr\" class='quinquecontrol' name=\"nomfr".$value."\" id=\"nomfr".$value."\" type=\"text\">";
    }
    echo "</p>";

    echo "<p class=\"pouvoirInput\">";
    echo "<label for=\"nomjp".$value."\">".$langage_perso["creation_nom_japonais"][$user_langue]."</label>";
    echo "</p>";
    echo "<p>";
    if (isset($_SESSION["modif-perso"]["quinque"]["nomjp"][$value]))
    {
      $saisie = $_SESSION["modif-perso"]["quinque"]["nomjp"][$value];
      echo "<input data-loop=\"".$value."\" data-champ=\"nomjp\" class='quinquecontrol' name=\"nomjp".$value."\" id=\"nomjp".$value."\" type=\"text\" value=\"".$saisie."\">";
    }
    else
    {
      echo "<input data-loop=\"".$value."\" data-champ=\"nomjp\" class='quinquecontrol' name=\"nomjp".$value."\" id=\"nomjp".$value."\" type=\"text\">";
    }
    echo "</p>";
    echo "<p class=\"pouvoirInput\">";
    echo "<label for=\"descriptionquinquefr".$value."\">".$langage_perso['creation_description_kagune_fr'][$user_langue]."</label>";
    echo "</p>";
    echo "<p>";
    if (isset($_SESSION["modif-perso"]["quinque"]["descriptionquinquefr"][$value]))
    {
      $saisie = $_SESSION["modif-perso"]["quinque"]["descriptionquinquefr"][$value];
      echo "<input data-loop=\"".$value."\" data-champ=\"descriptionquinquefr\" class=\"quinquecontrol\" id=\"descriptionquinquefr".$value."\" style=\"width:80%\" type=\"text\" name=\"descriptionquinquefr".$value."\" value=\"".$saisie."\"";
    }
    else
    {
      echo "<input data-loop=\"".$value."\" data-champ=\"descriptionquinquefr\" class=\"quinquecontrol\" id=\"descriptionquinquefr".$value."\" style=\"width:80%\" type=\"text\" name=\"descriptionquinquefr".$value."\"";
    }
    echo "</p>";
    echo "<p class=\"pouvoirInput\">";
    echo "<label for=\"descriptionquinquejp".$value."\">".$langage_perso['creation_description_kagune_jp'][$user_langue]."</label>";
    echo "</p>";
    echo "<p>";
    if (isset($_SESSION["modif-perso"]["quinque"]["descriptionquinquejp"][$value]))
    {
      $saisie = $_SESSION["modif-perso"]["quinque"]["descriptionquinquejp"][$value];
      echo "<input data-loop=\"".$value."\" data-champ=\"descriptionquinquejp\" class='quinquecontrol' id=\"descriptionquinquejp".$value."\" style=\"width:80%\" type=\"text\" name=\"descriptionquinquejp".$value."\" value=\"$saisie\"";
    }
    else
    {
      echo "<input data-loop=\"".$value."\" data-champ=\"descriptionquinquejp\" class='quinquecontrol' id=\"descriptionquinquejp".$value."\" style=\"width:80%\" type=\"text\" name=\"descriptionquinquejp".$value."\"";
    }
    echo "</p>";
    echo "<p style=\"font-weight:bold\">".$langage_perso['creation_type'][$user_langue]."</p>";
    echo "<div class=\"col-xs-12 quinquetypecontainer\">";
    $query = $mysqli->query("SELECT * FROM type");
    $nb    = $query->num_rows;
    if ($nb > 0)
    {
      while ($row = $query->fetch_array())
      {
        $languetempo=array(
            'kagune'=>array(
                "fr"=>$row["type_type_fr"],
                "jp"=>$row["type_type_jp"],
            ),
            'id'=>$row["type_id"]
        );
        echo "<p class=\"btnarrond typequinque typequinque".$languetempo["id"]."".$value."\" data-idtype=\"".$languetempo["id"]."\" data-looptype=\"".$value."\">";
        if (isset($_SESSION["modif-perso"]["idtype"][$value]))
        {
          if (in_array($languetempo["id"],$_SESSION["modif-perso"]["idtype"][$value]))
          {
            echo "<i class=\"fa fa-check-square-o checkarrond\" aria-hidden=\"true\"></i> ".$languetempo['kagune'][$user_langue];
          }
          else
          {
            echo "<i class=\"fa fa-square-o checkarrond\" aria-hidden=\"true\"></i> ".$languetempo['kagune'][$user_langue];
          }
        }
        else
        {
          echo "<i class=\"fa fa-square-o checkarrond\" aria-hidden=\"true\"></i> ".$languetempo['kagune'][$user_langue];
        }
        echo "</p>";
      }
    }
    echo "<p data-id=\"".$value."\" class=\"quinquedelete\">".$language_chapitre["chapitre_crea_input_delete"][$user_langue]."</p>";
    echo "</div>";
    echo "</div>";
  }
}
if (isset($_POST["champquinque"]))
{
  $texte         = trim(strip_tags($_POST["texte"]));
  $loppquinque   = trim(strip_tags($_POST["loppquinque"]));
  $champquinque  = trim(strip_tags($_POST["champquinque"]));
  $_SESSION["modif-perso"]["quinque"][$champquinque][$loppquinque] = $texte;
}
if (isset($_POST["idtype"]))
{
  $idtype   = strip_tags(trim($_POST["idtype"]));
  $looptype = strip_tags(trim($_POST["looptype"]));
  if (isset($_SESSION["modif-perso"]["idtype"][$looptype]))
  {
    if (in_array($idtype,$_SESSION["modif-perso"]["idtype"][$looptype]))
    {
      $tag_key = array_search($idtype, $_SESSION["modif-perso"]["idtype"][$looptype]);
      unset($_SESSION["modif-perso"]["idtype"][$looptype][$tag_key]);
      echo "0";
    }
    else
    {
      array_push($_SESSION["modif-perso"]["idtype"][$looptype],$idtype);
      echo "1";
    }
  }
  else
  {
    $_SESSION["modif-perso"]["idtype"][$looptype] = [];
    array_push($_SESSION["modif-perso"]["idtype"][$looptype],$idtype);
    echo "1";
  }
}
if (isset($_POST["appa"]))
{
  $appa = strip_tags(trim($_POST["appa"]));
  if (isset($_SESSION["modif-perso"]["apparition"]))
  {
    if (in_array($appa,$_SESSION["modif-perso"]["apparition"]))
    {
      $tag_key = array_search($appa, $_SESSION["modif-perso"]["apparition"]);
      unset($_SESSION["modif-perso"]["apparition"][$tag_key]);
      echo "0";
    }
    else
    {
      array_push($_SESSION["modif-perso"]["apparition"],$appa);
      echo "1";
    }
  }
  else
  {
    $_SESSION["modif-perso"]["apparition"] = [];
    array_push($_SESSION["modif-perso"]["apparition"],$appa);
    echo "1";
  }
}
if (isset($_POST["rangg"]))
{
  $kagune = strip_tags(trim($_POST["rangg"]));
  if (isset($_SESSION["modif-perso"]["rangg"]))
  {
    if (in_array($kagune,$_SESSION["modif-perso"]["rangg"]))
    {
      $tag_key = array_search($kagune, $_SESSION["modif-perso"]["rangg"]);
      unset($_SESSION["modif-perso"]["rangg"][$tag_key]);
      echo "0";
    }
    else
    {
      array_push($_SESSION["modif-perso"]["rangg"],$kagune);
      echo "1";
    }
  }
  else
  {
    $_SESSION["modif-perso"]["rangg"] = [];
    array_push($_SESSION["modif-perso"]["rangg"],$kagune);
    echo "1";
  }
}

if (isset($_POST["rangc"]))
{
  $kagune = strip_tags(trim($_POST["rangc"]));
  if (isset($_SESSION["modif-perso"]["rangc"]))
  {
    if (in_array($kagune,$_SESSION["modif-perso"]["rangc"]))
    {
      $tag_key = array_search($kagune, $_SESSION["modif-perso"]["rangc"]);
      unset($_SESSION["modif-perso"]["rangc"][$tag_key]);
      echo "0";
    }
    else
    {
      array_push($_SESSION["modif-perso"]["rangc"],$kagune);
      echo "1";
    }
  }
  else
  {
    $_SESSION["modif-perso"]["rangc"] = [];
    array_push($_SESSION["modif-perso"]["rangc"],$kagune);
    echo "1";
  }
}
?>
