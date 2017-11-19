<?php
  // ini_set('display_errors','on');
  // error_reporting(E_ALL);
session_start();
include("_connected.php");
include_once("langue.php");
if (isset($_GET["reset"]))
{
  unset($_SESSION["modif-perso"]);
  header('Location:mozaique.php');
  exit();
}
if (isset($_GET["id"]))
{
  $idperso = trim(strip_tags($_GET["id"]));

  $query2 = $mysqli->query("
    SELECT * FROM perso
    WHERE perso_id = $idperso
   ");
  $nb2 = $query2->num_rows;
  if ($nb2 == 0)
  {
    header('Location:mozaique.php');
  }

  if (isset($_SESSION["modif-perso"]["idcontrol"]))
  {
    if ($idperso !== $_SESSION["modif-perso"]["idcontrol"])
    {
      unset($_SESSION["modif-perso"]);
      $_SESSION["modif-perso"]["idcontrol"] = $idperso;
    }
  }
  else
  {
    $_SESSION["modif-perso"]["idcontrol"] = $idperso;
  }

  if (!isset($_SESSION["modif-perso"]["firstgo"]))
  {
    $query = $mysqli->query("SELECT * FROM perso WHERE perso_id = $idperso");
    $nb = $query->num_rows;
    if ($nb == 1)
    {
      $row = $query->fetch_array();

      $_SESSION["modif-perso"]["genre"]                   = htmlspecialchars_decode($row["perso_genre"],ENT_QUOTES);
      $_SESSION["modif-perso"]["nature"]                  = htmlspecialchars_decode($row["perso_nature"],ENT_QUOTES);
      $_SESSION["modif-perso"]["vivant"]                  = htmlspecialchars_decode($row["perso_vie"],ENT_QUOTES);
      $_SESSION["modif-perso"]["visibilite"]              = htmlspecialchars_decode($row["perso_visibilite"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["image"]      = htmlspecialchars_decode($row["perso_image"],ENT_QUOTES);

      $_SESSION["modif-perso"]["inputtext"]["prenomFR"]      = htmlspecialchars_decode($row["perso_prenom_fr"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["prenomJP"]      = htmlspecialchars_decode($row["perso_prenom_jp"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["nomFR"]         = htmlspecialchars_decode($row["perso_nom_fr"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["nomJP"]         = htmlspecialchars_decode($row["perso_nom_jp"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["surnomFR"]      = htmlspecialchars_decode($row["perso_surnom_fr"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["surnomJP"]      = htmlspecialchars_decode($row["perso_surnom_jp"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["descriptionFR"] = htmlspecialchars_decode($row["perso_description_fr"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["descriptionJP"] = htmlspecialchars_decode($row["perso_description_jp"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["masqueFR"]      = htmlspecialchars_decode($row["perso_masque_fr"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["masqueJP"]      = htmlspecialchars_decode($row["perso_masque_jp"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["metierFR"]      = htmlspecialchars_decode($row["perso_metier_fr"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["metierJP"]      = htmlspecialchars_decode($row["perso_metier_jp"],ENT_QUOTES);

      $_SESSION["modif-perso"]["inputtext"]["age"]    = htmlspecialchars_decode($row["perso_age"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["jour"]   = htmlspecialchars_decode($row["perso_age_jour"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["mois"]   = htmlspecialchars_decode($row["perso_age_mois"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["taille"] = htmlspecialchars_decode($row["perso_taille"],ENT_QUOTES);
      $_SESSION["modif-perso"]["inputtext"]["poids"]  = htmlspecialchars_decode($row["perso_poids"],ENT_QUOTES);

      $_SESSION["modif-perso"]["uploadimg"] = "img/persos/".htmlspecialchars_decode($row["perso_image"],ENT_QUOTES);
      $_SESSION["modif-perso"]["imgbdd"]    = htmlspecialchars_decode($row["perso_image"],ENT_QUOTES);

      $_SESSION["modif-perso"]["stat"]["force"]        = $row["perso_force"];
      $_SESSION["modif-perso"]["stat"]["faim"]         = $row["perso_faim"];
      $_SESSION["modif-perso"]["stat"]["courage"]      = $row["perso_courage"];
      $_SESSION["modif-perso"]["stat"]["charisme"]     = $row["perso_charisme"];
      $_SESSION["modif-perso"]["stat"]["eloquence"]    = $row["perso_eloquence"];
      $_SESSION["modif-perso"]["stat"]["intelligence"] = $row["perso_intelligence"];
      $_SESSION["modif-perso"]["stat"]["culture"]      = $row["perso_culture"];
      $_SESSION["modif-perso"]["stat"]["dexterite"]    = $row["perso_dexterite"];
      $_SESSION["modif-perso"]["stat"]["agilite"]      = $row["perso_agilite"];
      $_SESSION["modif-perso"]["stat"]["vitalite"]     = $row["perso_vitalite"];


      $_SESSION["modif-perso"]["firstgo"] = 1;

      $kaguneID = $row["kagune_id"];
      $idPerso  = $row["perso_id"];
    }
    /* ARRONDISSEMENTS */
    $query2 = $mysqli->query(" SELECT * FROM arrondissement
                                     JOIN perso_arrondissement
                                     WHERE arrondissement.arrondissement_id = perso_arrondissement.arrondissement_id
                                     AND perso_arrondissement.perso_id = $idperso
                                     ");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $_SESSION["modif-perso"]["ward"] = [];
      while($row = $query2->fetch_array())
      {
        $numeroarrondissement = $row["arrondissement_numero"];
        array_push($_SESSION["modif-perso"]["ward"],$numeroarrondissement);
      }

    }
    /* AFFILIATIONS */
    $query2 = $mysqli->query(" SELECT groupe.groupe_id
                                     FROM groupe
                                     JOIN perso_groupe
                                     WHERE groupe.groupe_id = perso_groupe.groupe_id
                                     AND perso_groupe.perso_id = $idperso");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $_SESSION["modif-perso"]["groupe"] = [];

      while($row = $query2->fetch_array())
      {
        $idgroupe = $row["groupe_id"];
        array_push($_SESSION["modif-perso"]["groupe"],$idgroupe);
      }
    }
    /* KAGUNE */
    if (!empty($kaguneID))
    {
      $query2 = $mysqli->query("  SELECT *
                                      FROM kagune
                                      WHERE kagune.kagune_id = $kaguneID");
      $nb2 = $query2->num_rows;
      if ($nb2 > 0)
      {
        while($row = $query2->fetch_array())
        {
          $_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"] = htmlspecialchars_decode($row["kagune_description_fr"],ENT_QUOTES);
          $_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"] = htmlspecialchars_decode($row["kagune_description_jp"],ENT_QUOTES);
        }
      }
      $query2 = $mysqli->query("  SELECT *
                                      FROM kagune
                                      JOIN kagune_type
                                      JOIN type
                                      WHERE kagune.kagune_id  = kagune_type.kagune_id
                                      AND kagune_type.type_id = type.type_id
                                      AND kagune.kagune_id = $kaguneID");
      $nb2 = $query2->num_rows;
      $_SESSION["modif-perso"]["kagune"] = [];
      if ($nb2 > 0)
      {
        while($row = $query2->fetch_array())
        {
          $idkagune = $row["type_id"];
          array_push($_SESSION["modif-perso"]["kagune"],$idkagune);
        }
      }

    }

    /* APPARITION */
    $query2 = $mysqli->query("  SELECT *
                                            FROM perso
                                            JOIN chapitre_perso
                                            JOIN chapitre
                                            WHERE perso.perso_id = chapitre_perso.perso_id
                                            AND chapitre_perso.chapitre_id = chapitre.chapitre_id
                                            AND perso.perso_id = $idPerso");
    $nb2    = $query2->num_rows;
    if ($nb2 > 0)
    {
      $_SESSION["modif-perso"]["apparition"] = [];
      while($row = $query2->fetch_array())
      {
        $idchapitre = $row["chapitre_id"];
        array_push($_SESSION["modif-perso"]["apparition"],$idchapitre);
      }
    }
    /* RANG GOULE*/
    $query2 = $mysqli->query(" SELECT *
      FROM rang
      JOIN perso_rang
      WHERE rang.rang_id = perso_rang.rang_id
      AND perso_rang.perso_id = $idPerso
      AND rang.rang_categorie = 1
      ");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $_SESSION["modif-perso"]["rangg"] = [];
      while($row = $query2->fetch_array())
      {
        $idrang = $row["rang_id"];
        array_push($_SESSION["modif-perso"]["rangg"],$idrang);
      }
    }
    /* RANG CCG*/
    $query2 = $mysqli->query(" SELECT *
     FROM rang
     JOIN perso_rang
     WHERE rang.rang_id = perso_rang.rang_id
     AND perso_rang.perso_id = $idPerso
     AND rang.rang_categorie = 0
     ");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $_SESSION["modif-perso"]["rangc"] = [];
      while($row = $query2->fetch_array())
      {
        $idrang = $row["rang_id"];
        array_push($_SESSION["modif-perso"]["rangc"],$idrang);
      }
    }
    /* QUINQUE */
    $query2 = $mysqli->query("
      SELECT *
      FROM quinque_perso
      INNER JOIN quinque
        ON quinque_perso.quinque_id = quinque.quinque_id
      WHERE quinque_perso.perso_id = $idPerso
        AND quinque_valide = 1
     ");
    $nb2 = $query2->num_rows;
    $nombrequinque = 0;
    if ($nb2 > 0)
    {
      $_SESSION["modif-perso"]["idtype"] = [];
      $_SESSION["modif-perso"]["quinque"]["liste"] = [];
      while($row = $query2->fetch_array())
      {
        $nombrequinque++;
        $iduqinque = $row["quinque_id"];
        array_push($_SESSION["modif-perso"]["quinque"]["liste"],$nombrequinque);
        $_SESSION["modif-perso"]["idtype"][$nombrequinque] = [];
        $_SESSION["modif-perso"]["quinque"]["nomfr"][$nombrequinque]                = $row["quinque_nom_fr"];
        $_SESSION["modif-perso"]["quinque"]["nomjp"][$nombrequinque]                = $row["quinque_nom_jp"];
        $_SESSION["modif-perso"]["quinque"]["descriptionquinquefr"][$nombrequinque] = $row["quinque_description_fr"];
        $_SESSION["modif-perso"]["quinque"]["descriptionquinquejp"][$nombrequinque] = $row["quinque_description_jp"];

        $query3 = $mysqli->query("
          SELECT *
          FROM quinque_type
          INNER JOIN type
            ON quinque_type.type_id = type.type_id
          WHERE quinque_type.quinque_id = $iduqinque
         ");
        $nb3 = $query3->num_rows;
        while($row3 = $query3->fetch_array())
        {
          $idtypequinque = $row3["type_id"];
          array_push($_SESSION["modif-perso"]["idtype"][$nombrequinque],$idtypequinque);
        }
      }
    }
    $_SESSION["modif-perso"]["nombrequinque"] = $nombrequinque;
  }
}

if (isset($_FILES["imgpersomodif"]))
{
  $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
  //1. strrchr renvoie l'extension avec le point (« . »).
  //2. substr(chaine,1) ignore le premier caractère de chaine.
  //3. strtolower met l'extension en minuscules.
  $extension_upload = strtolower(  substr(  strrchr($_FILES['imgpersomodif']['name'], '.')  ,1)  );
  if ( in_array($extension_upload,$extensions_valides) )
  {
    $id_membre  = md5(uniqid(rand(), true));
    $nombdd     = "{$id_membre}.{$extension_upload}";
    $nom        = "img/tempo/{$id_membre}.{$extension_upload}";
    $resultat   = move_uploaded_file($_FILES['imgpersomodif']['tmp_name'],$nom);
    if ($resultat)
    {
      $_SESSION["modif-perso"]["uploadimg"] = $nom;
      $_SESSION["modif-perso"]["imgbdd"]    = $nombdd;
    }
    else
    {
      echo "Transfert echoué";
    }
  }
  else
  {
    echo "Erreur d'extension";
  }
}
if (isset($_POST["valide"]))
{
  $idPerso = $_SESSION["modif-perso"]["idcontrol"];
  $genre  = NULL;
  $nature = NULL;
  $vivant = NULL;

  $prenom_fr      = NULL;
  $prenom_jp      = NULL;
  $nom_fr         = NULL;
  $nom_jp         = NULL;
  $surnom_fr      = NULL;
  $surnom_jp      = NULL;
  $description_fr = NULL;
  $description_jp = NULL;
  $masque_fr      = NULL;
  $masque_jp      = NULL;
  $metier_fr      = NULL;
  $metier_jp      = NULL;

  $age    = NULL;
  $jour   = NULL;
  $mois   = NULL;
  $taille = NULL;
  $poids  = NULL;

  if (isset($_SESSION["modif-perso"]["genre"]))  $genre  = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["genre"])));
  if (isset($_SESSION["modif-perso"]["nature"])) $nature = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["nature"])));
  if (isset($_SESSION["modif-perso"]["vivant"])) $vivant = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["vivant"])));

  if (isset($_SESSION["modif-perso"]["inputtext"]["prenomFR"]))      $prenom_fr      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["prenomFR"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["prenomJP"]))      $prenom_jp      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["prenomJP"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["nomFR"]))         $nom_fr         = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["nomFR"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["nomJP"]))         $nom_jp         = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["nomJP"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["surnomFR"]))      $surnom_fr      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["surnomFR"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["surnomJP"]))      $surnom_jp      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["surnomJP"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionFR"])) $description_fr = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["descriptionFR"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionJP"])) $description_jp = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["descriptionJP"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["masqueFR"]))      $masque_fr      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["masqueFR"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["masqueJP"]))      $masque_jp      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["masqueJP"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["metierFR"]))      $metier_fr      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["metierFR"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["metierJP"]))      $metier_jp      = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["metierJP"],ENT_QUOTES,"UTF-8")));

  if (isset($_SESSION["modif-perso"]["inputtext"]["age"]))       $age = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["age"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["jour"]))     $jour = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["jour"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["mois"]))     $mois = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["mois"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["taille"])) $taille = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["taille"],ENT_QUOTES,"UTF-8")));
  if (isset($_SESSION["modif-perso"]["inputtext"]["poids"]))  $poids  = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["poids"],ENT_QUOTES,"UTF-8")));

  if (isset($_SESSION["modif-perso"]["stat"]["force"]))
  {
    $force = $_SESSION["modif-perso"]["stat"]["force"];
  }
  else
  {
    $force = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["faim"]))
  {
    $faim = $_SESSION["modif-perso"]["stat"]["faim"];
  }
  else
  {
    $faim = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["courage"]))
  {
    $courage = $_SESSION["modif-perso"]["stat"]["courage"];
  }
  else
  {
    $courate = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["charisme"]))
  {
    $charisme = $_SESSION["modif-perso"]["stat"]["charisme"];
  }
  else
  {
    $charisme = 0 ;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["eloquence"]))
  {
    $eloquence = $_SESSION["modif-perso"]["stat"]["eloquence"];
  }
  else
  {
    $eloquence = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["intelligence"]))
  {
    $intelligence = $_SESSION["modif-perso"]["stat"]["intelligence"];
  }
  else
  {
    $intelligence = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["culture"]))
  {
    $culture = $_SESSION["modif-perso"]["stat"]["culture"];
  }
  else
  {
    $culture = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["dexterite"]))
  {
    $dexterite = $_SESSION["modif-perso"]["stat"]["dexterite"];
  }
  else
  {
    $dexterite = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["agilite"]))
  {
    $agilite = $_SESSION["modif-perso"]["stat"]["agilite"];
  }
  else
  {
    $agilite = 0;
  }
  if (isset($_SESSION["modif-perso"]["stat"]["vitalite"]))
  {
    $vitalite = $_SESSION["modif-perso"]["stat"]["vitalite"];
  }
  else
  {
    $vitalite = 0;
  }

  $visibilite = 0;
  $image      = NULL;
  if (isset($_SESSION["modif-perso"]["visibilite"]))         $visibilite = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["visibilite"])));

  // Si la session de l'image existe on récupére sa valeur
  if (isset($_SESSION["modif-perso"]["imgbdd"]))
  {
    $image = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["imgbdd"])));
    // On récupére la valeur que le perso à en bdd
    $query2 = $mysqli->query("
       SELECT perso_image
       FROM perso
       WHERE perso_id = $idPerso
    ");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $row2   = $query2->fetch_array();
      $oldimg = $row2["perso_image"];
      // Si ce n'est pas la même valeur
      if ($oldimg != $image)
      {
        // on déplace la nouvelle image
        $oldpath = $_SESSION["modif-perso"]["uploadimg"];
        $newpath = "img/persos/".$_SESSION["modif-perso"]["imgbdd"];
        rename($oldpath, $newpath);
        // on supprime l'ancienne  (on la déplace dans tempo)
        $oldpath = "img/persos/".$oldimg;
        $newpath = "img/tempo/".$oldimg;
        rename($oldpath, $newpath);
      }
    }
  }

  // Récupérer le kagune et le supprimer pour ensuite ajouter le nouveau
  $query2 = $mysqli->query("
     SELECT *
     FROM perso
     JOIN kagune
       ON perso.kagune_id = kagune.kagune_id
     WHERE perso.perso_id = $idPerso
  ");
  $nb2 = $query2->num_rows;
  if ($nb2 > 0)
  {
    $row = $query2->fetch_array();
    $idkagunesupp = $row["kagune_id"];
  }
  // S'il y a un kagune on l'update
  if (isset($idkagunesupp))
  {
    if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"]) || isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"]))
    {
      if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"]))
      {
        $descriptionKagunefr = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"],ENT_QUOTES,"UTF-8")));
      }
      else
      {
        $descriptionKagunefr = NULL;
      }
      if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"]))
      {
        $descriptionKagunejp = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"],ENT_QUOTES,"UTF-8")));
      }
      else
      {
        $descriptionKagunejp = NULL;
      }

      $query = $mysqli->query("UPDATE kagune
        SET
        kagune_description_fr='$descriptionKagunefr',
        kagune_description_jp='$descriptionKagunejp'
        WHERE kagune_id = $idkagunesupp
      ");
    }
  }
  else
    //sinon on le crée
  {
    if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"]) || isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"]))
    {
      if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"]))
      {
        $descriptionKagunefr = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"],ENT_QUOTES,"UTF-8")));
      }
      else
      {
        $descriptionKagunefr = NULL;
      }
      if (isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"]))
      {
        $descriptionKagunejp = trim(strip_tags(htmlspecialchars($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"],ENT_QUOTES,"UTF-8")));
      }
      else
      {
        $descriptionKagunejp = NULL;
      }

      $query = $mysqli->query("
        INSERT INTO kagune
        (
          kagune_id,
          kagune_description_fr,
          kagune_description_jp
        ) VALUES (
          NULL,
          '$descriptionKagunefr',
          '$descriptionKagunejp'
        )
      ");
      $idkagunesupp = $mysqli->insert_id;
    }
  }
  $query2 = $mysqli->query("
      DELETE FROM kagune_type
      WHERE kagune_id = $idkagunesupp
  ");

  // Ajout des liens
  if (isset($_SESSION["modif-perso"]["kagune"]))
  {
    foreach ($_SESSION["modif-perso"]["kagune"] as $key => $value)
    {
      $query = $mysqli->query("INSERT INTO kagune_type (
        kagune_type_id,
        kagune_id,
        type_id
      ) VALUES (
        NULL,
        '$idkagunesupp',
        '$value')");
    }
  }

  // Préparation de la notification
  if ($visibilite == 0)
  {
    $query2 = $mysqli->query("
       SELECT *
       FROM perso
       WHERE perso_id = $idPerso
    ");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $row = $query2->fetch_array();
      $visibilitecontrol = $row["perso_visibilite"];

      if ($visibilitecontrol > 0)
      {
        $actionnotif = 9;
      }
      else
      {
        $actionnotif = 2;
      }
    }
  }
  else
  {
    $query2 = $mysqli->query("
       SELECT *
       FROM perso
       WHERE perso_id = $idPerso
    ");
    $nb2 = $query2->num_rows;
    if ($nb2 > 0)
    {
      $row = $query2->fetch_array();
      $visibilitecontrol = $row["perso_visibilite"];

      if ($visibilitecontrol > 0)
      {
        $actionnotif = 3;
      }
      else
      {
        // Le personnage disparaît, on supprime les notifcations et on n'en crée pas
        $actionnotif = 0;
      }
    }
  }

  // Arrondissement
  //Supprimer les liens existants
  $query2 = $mysqli->query("
      DELETE FROM perso_arrondissement
      WHERE perso_id = $idPerso
  ");
  // Ajout ARRONDISSEMENTS
  if (isset($_SESSION["modif-perso"]["ward"]))
  {
    $arrondissemnts = $_SESSION["modif-perso"]["ward"];
    foreach ($arrondissemnts as $key => $value)
    {
      if ($value >0)
      {
        $query = $mysqli->query("
          INSERT INTO perso_arrondissement
          (
            perso_arrondissement_id,
            perso_id,
            arrondissement_id
          )
          VALUES
          (
            NULL,
            $idPerso,
            $value
          )
        ");
      }
    }
  }

  //Affiliation
  //Supprimer les liens existants
  $query2 = $mysqli->query("
      DELETE FROM perso_groupe
      WHERE perso_id = $idPerso
  ");
  // Ajout GROUPES
  if (isset($_SESSION["modif-perso"]["groupe"]))
  {
    $groupe = $_SESSION["modif-perso"]["groupe"];
    foreach ($groupe as $key => $value)
    {
      if ($value >0)
      {
        $query = $mysqli->query("INSERT INTO perso_groupe (
          perso_groupe_id,
          perso_id,
          groupe_id
        ) VALUES (
          NULL,
          $idPerso,
          $value
        )");
      }
    }
  }

  // Apparition
  $query2 = $mysqli->query("
      DELETE FROM chapitre_perso
      WHERE perso_id = $idPerso
  ");
  // Ajout APPARITIONS
  if (isset($_SESSION["modif-perso"]["apparition"]))
  {
    $appa = $_SESSION["modif-perso"]["apparition"];
    foreach ($appa as $key => $value)
    {
      if ($value >0)
      {
        $query = $mysqli->query("INSERT INTO chapitre_perso (
          chapitre_perso_id,
          chapitre_id,
          perso_id
        ) VALUES (
          NULL,
          $value,
          $idPerso
        )");
      }
    }
  }
  //Suppression de tous les rangs
  //rang goule
  $query2 = $mysqli->query("
      DELETE FROM perso_rang
      WHERE perso_id = $idPerso
  ");
  // Ajout RANG GOULE
  if (isset($_SESSION["modif-perso"]["rangg"]))
  {
    foreach($_SESSION["modif-perso"]["rangg"] as $key => $value)
    {
      $query = $mysqli->query("
        INSERT INTO perso_rang
        (
          id_perso_rang,
          perso_id,
          rang_id
        )
        VALUES
        (
        NULL,
          '$idPerso',
          '$value'
        )
      ");
    }
  }
  // Ajout RANG INSPECTEUR
  if (isset($_SESSION["modif-perso"]["rangc"]))
  {
    foreach($_SESSION["modif-perso"]["rangc"] as $key => $value)
    {
      $query = $mysqli->query("
        INSERT INTO perso_rang
        (
          id_perso_rang,
          perso_id,
          rang_id
        )
        VALUES
        (
          NULL,
          '$idPerso',
          '$value'
        )
      ");
    }
  }

  //QUINQUES
  $query2 = $mysqli->query("
    SELECT *
    FROM quinque_perso
    WHERE perso_id = $idPerso
  ");
  $query3 = $mysqli->query("
    DELETE FROM quinque_perso
    WHERE perso_id = $idPerso
  ");
  $query3 = $mysqli->query("
    DELETE FROM quinque_type
    WHERE perso_id = $idPerso
  ");
  $nb2 = $query2->num_rows;
  if ($nb2 > 0)
  {
    while($row2 = $query2->fetch_array())
    {
      $idquninque = row2["quinque_id"];
      $query3 = $mysqli->query("
        DELETE FROM quinque
        WHERE quinque_id = $idquninque
      ");
    }
  }
  // Ajout QUINQUES
  if (isset($_SESSION["modif-perso"]["quinque"]))
  {
    $tableauchamp=array(
        'nomfr',
        'nomjp',
        'descriptionquinquefr',
        'descriptionquinquejp'
    );
    foreach ($_SESSION["modif-perso"]["quinque"]["liste"] as $key => $value)
    {
      $requeteprepa = "INSERT INTO quinque (quinque_id, quinque_nom_fr, quinque_nom_jp, quinque_description_fr, quinque_description_jp, quinque_valide) VALUES ( NULL";
      foreach ($tableauchamp as $key2 => $value2)
      {
        $requeteprepa .= ", ";
        if (isset($_SESSION["modif-perso"]["quinque"][$value2][$value]))
        {
          $requeteprepa .= "'".$_SESSION["modif-perso"]["quinque"][$value2][$value]."'";
        }
        else
        {
          $requeteprepa .= "NULL";
        }
      }
      $requeteprepa .= " , 1)";
      $query     = $mysqli->query($requeteprepa);
      $idquinque = $mysqli->insert_id;
      // remplir la table associative persos
      $query = $mysqli->query ("INSERT INTO quinque_perso (quinque_perso_id, quinque_id, perso_id) VALUES (NULL, '$idquinque', '$idPerso')");
      // remplir la table associative type
      if (isset($_SESSION["modif-perso"]["idtype"][$value]))
      {
        foreach ($_SESSION["modif-perso"]["idtype"][$value] as $key2 => $value2)
        {
          $query = $mysqli->query ("INSERT INTO quinque_type (quinque_type_id, quinque_id, type_id) VALUES (NULL, '$idquinque', '$value2')");
        }
      }
    }
  }

  //Mise à jour du personnage
  $query = $mysqli->query("
   UPDATE perso
   SET
    perso_visibilite='$visibilite',
    perso_prenom_fr='$prenom_fr',
    perso_prenom_jp='$prenom_jp',
    perso_nom_fr='$nom_fr',
    perso_nom_jp='$nom_jp',
    perso_genre='$genre',
    perso_nature='$nature',
    perso_age='$age',
    perso_age_jour='$jour',
    perso_age_mois='$mois',
    perso_poids='$poids',
    perso_taille='$taille',
    perso_surnom_fr='$surnom_fr',
    perso_surnom_jp='$surnom_jp',
    perso_description_fr='$description_fr',
    perso_description_jp='$description_jp',
    perso_masque_fr='$masque_fr',
    perso_masque_jp='$masque_jp',
    perso_metier_fr='$metier_fr',
    perso_metier_jp='$metier_jp',
    perso_image='$image',
    perso_force='$force',
    perso_faim='$faim',
    perso_courage='$courage',
    perso_charisme='$charisme',
    perso_eloquence='$eloquence',
    perso_intelligence='$intelligence',
    perso_culture='$culture',
    perso_dexterite='$dexterite',
    perso_agilite='$agilite',
    perso_vitalite='$vitalite',
    perso_vie='$vivant',
    kagune_id='$idkagunesupp',
    perso_actif=1
    WHERE perso_id = $idPerso
  ");

  $_SESSION["animID"] = $idPerso;


  // Création notification
  if (isset($actionnotif))
  {
    if($actionnotif == 0)
    {
      $query2 = $mysqli->query("
         DELETE FROM notification
         WHERE perso_id = $idPerso
      ");
    }
    elseif($actionnotif != "3")
    {
      $date   = strtotime("now");
      $query = $mysqli->query("
        INSERT INTO notification
        (
          notification_id,
          notification_action,
          notification_date,
          user_id,
          chapitre_id,
          perso_id
        )
        VALUES
        (
          NULL,
          $actionnotif,
          '$date',
          '$user_id',
          0,
          $idPerso
        )
      ");
    }
  }
  unset($_SESSION["modif-perso"]);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tokyo Goul Mirror</title>
    <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/perso-creation.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">

    <!-- CHARTS -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/radar.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1><?php
          $tempolangueperso=array(
              'prenom'=>array('fr'=>$_SESSION["modif-perso"]["inputtext"]["prenomFR"], 'jp'=>$_SESSION["modif-perso"]["inputtext"]["prenomJP"]),
              'nom'   =>array('fr'=>$_SESSION["modif-perso"]["inputtext"]["nomFR"],    'jp'=>$_SESSION["modif-perso"]["inputtext"]["nomJP"])
          );
          if ((empty($tempolangueperso["nom"][$user_langue])) OR (empty($tempolangueperso["prenom"][$user_langue])))
          {
            echo $langage_perso['ficheperso_titre']["fr"]." : ".$tempolangueperso["nom"]["fr"]." ".$tempolangueperso["prenom"]["fr"];
          }
          else
          {
            echo $langage_perso['ficheperso_titre'][$user_langue]." : ".$tempolangueperso["nom"][$user_langue]." ".$tempolangueperso["prenom"][$user_langue];
          }
        ?></h1>
    </div>
    <div class="col-xs-12 general">
      <form id="formpersomodif" action="#" method="post" enctype="multipart/form-data">
        <div class="col-xs-12 col-md-2">
          <div class="contentarrond contentvalidator">
            <div class="btnvalider validationform">
              <i class="fa fa-floppy-o" aria-hidden="true"></i>
              <br>
              <p><?php echo $langage_perso['creation_valider'][$user_langue]; ?></p>
            </div>
            <hr>
            <a href="perso.php?reset">
              <div class="btnvalider">
                <i class="fa fa-undo" aria-hidden="true"></i>
                <br>
                <?php echo $langage_perso['creation_annuler'][$user_langue]; ?>
              </div>
            </a>
          </div>
        </div>

        <div class="col-xs-12 col-md-2">
          <h2><?php echo $langage_perso['creation_genre'][$user_langue]; ?></h2>
          <div style="overflow:hidden" class="contentarrond">
            <?php
            if (isset($_SESSION["modif-perso"]["genre"]))
            {
              if ($_SESSION["modif-perso"]["genre"] == '0')
              {
                echo "<p class=\"btnarrond choseh\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_homme'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond chosef\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_femme'][$user_langue];
                echo "</p>";
              }
              elseif($_SESSION["modif-perso"]["genre"] == '1')
              {
                echo "<p class=\"btnarrond choseh\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_homme'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond chosef\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_femme'][$user_langue];
                echo "</p>";
              }
              else
              {
                echo "<p class=\"btnarrond choseh\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_homme'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond chosef\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_femme'][$user_langue];
                echo "</p>";
              }
            }
            else
            {
              echo "<p class=\"btnarrond choseh\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_homme'][$user_langue];
              echo "</p>";

              echo "<p class=\"btnarrond chosef\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_femme'][$user_langue];
              echo "</p>";
            }
            ?>
            <hr>
            <?php
            if (isset($_SESSION["modif-perso"]["nature"]))
            {
              if ($_SESSION["modif-perso"]["nature"] == "0")
              {
                echo "<p class=\"btnarrond chosehu\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_human'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond choseg\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_goul'][$user_langue];
                echo "</p>";
              }
              elseif ($_SESSION["modif-perso"]["nature"] == "1")
              {
                echo "<p class=\"btnarrond chosehu\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_human'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond choseg\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_goul'][$user_langue];
                echo "</p>";
              }
              else
              {
                echo "<p class=\"btnarrond chosehu\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_human'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond choseg\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_goul'][$user_langue];
                echo "</p>";
              }
            }
            else
            {
              echo "<p class=\"btnarrond chosehu\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_human'][$user_langue];
              echo "</p>";

              echo "<p class=\"btnarrond choseg\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_goul'][$user_langue];
              echo "</p>";
            }
            ?>
            <hr>
            <?php
            if (isset($_SESSION["modif-perso"]["vivant"]))
            {
              if ($_SESSION["modif-perso"]["vivant"] == "1")
              {
                echo "<p class=\"btnarrond chosev\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_vivant'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond chosem\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_mort'][$user_langue];
                echo "</p>";
              }
              elseif ($_SESSION["modif-perso"]["vivant"] == "0")
              {
                echo "<p class=\"btnarrond chosev\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_vivant'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond chosem\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_mort'][$user_langue];
                echo "</p>";
              }
              else
              {
                echo "<p class=\"btnarrond chosev\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_vivant'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond chosem\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_mort'][$user_langue];
                echo "</p>";
              }
            }
            else
            {
              echo "<p class=\"btnarrond chosev\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_vivant'][$user_langue];
              echo "</p>";

              echo "<p class=\"btnarrond chosem\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_mort'][$user_langue];
              echo "</p>";
            }
            ?>
          </div>
        </div>

        <div class="col-xs-12 col-md-2 controltext">
          <h2><?php echo $langage_perso['creation_enfrancais'][$user_langue]; ?></h2>
          <p>
            <label for="prenom_fr"><?php echo $langage_perso['creation_prenom'][$user_langue]; ?></label>
            <input id="prenom_fr" type="text" name="prenom_fr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["prenomFR"])){ echo $_SESSION["modif-perso"]["inputtext"]["prenomFR"]; } ?>">
          </p>
          <p>
            <label for="nom_fr"><?php echo $langage_perso['creation_nom'][$user_langue]; ?></label>
            <input id="nom_fr" type="text" name="nom_fr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["nomFR"])){ echo $_SESSION["modif-perso"]["inputtext"]["nomFR"]; } ?>">
          </p>
          <p>
            <label for="surnom_fr"><?php echo $langage_perso['creation_surnom'][$user_langue]; ?></label>
            <input id="surnom_fr" type="text" name="surnom_fr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["surnomFR"])){ echo $_SESSION["modif-perso"]["inputtext"]["surnomFR"]; } ?>">
          </p>
          <p>
            <label for="masque_fr"><?php echo $langage_perso['creation_masque'][$user_langue]; ?></label>
            <input id="masque_fr" type="text" name="masque_fr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["masqueFR"])){ echo $_SESSION["modif-perso"]["inputtext"]["masqueFR"]; } ?>">
          </p>
          <p>
            <label for="metier_fr"><?php echo $langage_perso['creation_metier'][$user_langue]; ?></label>
            <input id="metier_fr" type="text" name="metier_fr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["metierFR"])){ echo $_SESSION["modif-perso"]["inputtext"]["metierFR"]; } ?>">
          </p>
          <p>
            <label for="description_fr"><?php echo $langage_perso['creation_description'][$user_langue]; ?></label>
            <input id="description_fr" type="text" name="description_fr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["descriptionFR"])){ echo $_SESSION["modif-perso"]["inputtext"]["descriptionFR"]; } ?>">
          </p>
        </div>

        <div class="col-xs-12 col-md-2 controltext">
          <h2><?php echo $langage_perso['creation_enjaponais'][$user_langue]; ?></h2>
          <p>
            <label for="prenom_jp"><?php echo $langage_perso['creation_prenom'][$user_langue]; ?></label>
            <input id="prenom_jp" type="text" name="prenom_jp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["prenomJP"])){ echo $_SESSION["modif-perso"]["inputtext"]["prenomJP"]; } ?>">
          </p>
          <p>
            <label for="nom_jp"><?php echo $langage_perso['creation_nom'][$user_langue]; ?></label>
            <input id="nom_jp" type="text" name="nom_jp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["nomJP"])){ echo $_SESSION["modif-perso"]["inputtext"]["nomJP"]; } ?>">
          </p>
          <p>
            <label for="surnom_jp"><?php echo $langage_perso['creation_surnom'][$user_langue]; ?></label>
            <input id="surnom_jp" type="text" name="surnom_jp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["surnomJP"])){ echo $_SESSION["modif-perso"]["inputtext"]["surnomJP"]; } ?>">
          </p>
          <p>
            <label for="masque_jp"><?php echo $langage_perso['creation_masque'][$user_langue]; ?></label>
            <input id="masque_jp" type="text" name="masque_jp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["masqueJP"])){ echo $_SESSION["modif-perso"]["inputtext"]["masqueJP"]; } ?>">
          </p>
          <p>
            <label for="metier_jp"><?php echo $langage_perso['creation_metier'][$user_langue]; ?></label>
            <input clas="formcontrol" id="metier_jp" type="text" name="metier_jp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["metierJP"])){ echo $_SESSION["modif-perso"]["inputtext"]["metierJP"]; } ?>">
          </p>
          <p>
            <label for="description_jp"><?php echo $langage_perso['creation_description'][$user_langue]; ?></label>
            <input id="description_jp" type="text" name="description_jp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["descriptionJP"])){ echo $_SESSION["modif-perso"]["inputtext"]["descriptionJP"]; } ?>">
          </p>
        </div>

        <div class="col-xs-12 col-md-2 controltext">
          <h2><?php echo $langage_perso['creation_detail'][$user_langue]; ?></h2>
          <p>
            <label for=""><?php echo $langage_perso['creation_age'][$user_langue]; ?></label>
            <input id="" type="text" name="age" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["age"])){ echo $_SESSION["modif-perso"]["inputtext"]["age"]; } ?>">
          </p>
          <p>
            <label for=""><?php echo $langage_perso['creation_jour'][$user_langue]; ?></label>
            <input id="" type="text" name="jour" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["jour"])){ echo $_SESSION["modif-perso"]["inputtext"]["jour"]; } ?>">
          </p>
          <p>
            <label for=""><?php echo $langage_perso['creation_mois'][$user_langue]; ?></label>
            <input id="" type="text" name="mois" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["mois"])){ echo $_SESSION["modif-perso"]["inputtext"]["mois"]; } ?>">
          </p>
          <p>
            <label for=""><?php echo $langage_perso['creation_taille'][$user_langue]; ?></label>
            <input id="" type="text" name="taille" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["taille"])){ echo $_SESSION["modif-perso"]["inputtext"]["taille"]; } ?>">
          </p>
          <p>
            <label for=""><?php echo $langage_perso['creation_poids'][$user_langue]; ?></label>
            <input id="" type="text" name="poids" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["poids"])){ echo $_SESSION["modif-perso"]["inputtext"]["poids"]; } ?>">
          </p>
        </div>

        <div class="col-xs-12 col-md-2 ">
          <h2><?php echo $langage_perso['creation_arrondissement'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <?php
            $a = 1;
            foreach ($arrondissement as $key => $value)
            {
              echo "<p class=\"btnarrond ward ward".$key."\" data-ward=\"".$key."\">";
              if (isset($_SESSION["modif-perso"]["ward"]))
              {
                if (in_array($key,$_SESSION["modif-perso"]["ward"]))
                {
                  echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                }
                else
                {
                  echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                }
              }
              else
              {
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              }
              if ($user_langue == "fr")
              {
                echo $key;
                if ($a == 1)
                {
                  echo "er -";
                }
                else
                {
                  echo "ème - ";
                }
                echo $value['fr'];
              }
              else
              {
                echo $key;
                echo " : ";
                echo $value['jp'];
              }
              echo "</p>";
              $a++;
            }
            ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-2 ">
          <h2><?php echo $langage_perso['creation_affiliation'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <?php
            $query = $mysqli->query("SELECT * FROM groupe");
            $nb    = $query->num_rows;
            if ($nb > 0)
            {
              while($row = $query->fetch_array())
              {
                $id_groupe = $row["groupe_id"];
                $languetempo=array(
                    'titre'=>array(
                        'fr'=>$row["groupe_nom_fr"],
                        'jp'=>$row["groupe_nom_jp"],
                    ),
                );
                echo "<p class=\"btnarrond groupe groupe".$id_groupe."\" data-groupe=\"".$id_groupe."\">";
                if (isset($_SESSION["modif-perso"]["groupe"]))
                {
                  if (in_array($id_groupe,$_SESSION["modif-perso"]["groupe"]))
                  {
                    echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                  }
                  else
                  {
                    echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                  }
                }
                else
                {
                  echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                }
                if (!isset($languetempo["titre"][$user_langue]))
                {
                  echo $languetempo["titre"]["fr"];
                }
                else
                {
                  echo $languetempo["titre"][$user_langue];
                }
                echo "</p>";
              }
            }
            ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-2 controltext">
          <h2><?php echo $langage_perso['creation_kagune'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <p class="pouvoirInput">
              <label for="descriptionKagunefr"><?php echo $langage_perso['creation_description_kagune_fr'][$user_langue]; ?></label>
            </p>
            <p>
              <input style="width:80%" type="text" id="descriptionKagunefr" name="descriptionKagunefr" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"])){ echo $_SESSION["modif-perso"]["inputtext"]["descriptionKagunefr"]; } ?>">
            </p>
            <p class="pouvoirInput">
              <label for="descriptionKagunejp"><?php echo $langage_perso['creation_description_kagune_jp'][$user_langue]; ?></label>
            </p>
            <p class="">
              <input style="width:80%" type="text" id="descriptionKagunejp" name="descriptionKagunejp" value="<?php if(isset($_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"])){ echo $_SESSION["modif-perso"]["inputtext"]["descriptionKagunejp"]; } ?>">
            </p>
            <p style="font-weight:bold"><?php echo $langage_perso['creation_type'][$user_langue]; ?></p>
            <div class="col-xs-12">
              <?php
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
                  echo "<p class=\"btnarrond chkagune kagune".$languetempo['id']."\" data-kagune=\"".$languetempo['id']."\">";
                  if (isset($_SESSION["modif-perso"]["kagune"]))
                  {
                    if (in_array($languetempo["id"],$_SESSION["modif-perso"]["kagune"]))
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
              ?>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-2">
          <h2><?php echo $langage_perso['creation_quinque'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <?php echo "<p class=\"addquinque\"> <i class=\"fa fa-plus-square-o\" aria-hidden=\"true\"></i>".$langage_perso['creation_ajouter_quinque'][$user_langue]."</p>"; ?>
            <div class="containerquinque">
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-2">
          <h2><?php echo $langage_perso['creation_apparition'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <?php
            $query = $mysqli->query("SELECT * FROM chapitre ORDER BY chapitre_numero_fr DESC");
            $nb    = $query->num_rows;
            if ($nb > 0)
            {
              while($row = $query->fetch_array())
              {
                $id_chapitre=$row["chapitre_id"];
                $languetempo=array(
                    'titre'=>array(
                        'fr'=>$row["chapitre_titre_fr"],
                        'jp'=>$row["chapitre_titre_jp"],
                    ),
                    'numero'=>array(
                        'fr'=>$row["chapitre_numero_fr"],
                        'jp'=>$row["chapitre_numero_jp"],
                    ),
                );
                echo "<p class=\"btnarrond appa appa".$id_chapitre."\" data-appa=\"".$id_chapitre."\">";
                if (isset($_SESSION["modif-perso"]["apparition"]))
                {
                  if (in_array($id_chapitre,$_SESSION["modif-perso"]["apparition"]))
                  {
                    echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                  }
                  else
                  {
                    echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                  }
                }
                else
                {
                  echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                }
                if ($languetempo["numero"][$user_langue] == '0')
                {
                  echo "Spin-off : ";
                  if (empty($languetempo["titre"][$user_langue]))
                  {
                    echo $languetempo["titre"]['fr'];
                  }
                  else
                  {
                    echo $languetempo["titre"][$user_langue];
                  }
                }
                else
                {
                  if (empty($languetempo["numero"][$user_langue]))
                  {
                    echo $languetempo["numero"]['fr'];
                  }
                  else
                  {
                    echo $languetempo["numero"][$user_langue];
                  }
                  echo " : ";
                  if (empty($languetempo["titre"][$user_langue]))
                  {
                    echo $languetempo["titre"]['fr'];
                  }
                  else
                  {
                    echo $languetempo["titre"][$user_langue];
                  }
                }
                echo "</p>";
              }
            }
            ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-2">
          <h2><?php echo $langage_perso['creation_rang_goul'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <?php
            $query = $mysqli->query("SELECT * FROM rang WHERE rang_categorie = 1 ORDER BY rang_ordre DESC");
            $nb    = $query->num_rows;
            if ($nb > 0)
            {
              while($row = $query->fetch_array())
              {
                echo "<p class=\"btnarrond rangg rangg".$row["rang_id"]."\" data-rangg=\"".$row["rang_id"]."\">";
                if (isset($_SESSION["modif-perso"]["rangg"]))
                {
                  if (in_array($row["rang_id"],$_SESSION["modif-perso"]["rangg"]))
                  {
                    echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                    echo $row["rang_nom_fr"];
                  }
                  else
                  {
                    echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                    echo $row["rang_nom_fr"];
                  }
                }
                else
                {
                  echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                  echo $row["rang_nom_fr"];
                }
                echo "</p>";
              }
            }
            ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-2">
          <h2><?php echo $langage_perso['creation_rang_ccg'][$user_langue]; ?></h2>
          <div class="contentarrond">
            <?php
            $query = $mysqli->query("SELECT * FROM rang WHERE rang_categorie = 0 ORDER BY rang_ordre DESC");
            $nb    = $query->num_rows;
            if ($nb > 0)
            {
              while($row = $query->fetch_array())
              {
                echo "<p class=\"btnarrond rangc rangc".$row["rang_id"]."\" data-rangc=\"".$row["rang_id"]."\">";
                if (isset($_SESSION["modif-perso"]["rangc"]))
                {
                  if (in_array($row["rang_id"],$_SESSION["modif-perso"]["rangc"]))
                  {
                    if ($user_langue == "fr")
                    {
                      echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                      echo $row["rang_nom_fr"];
                    }
                    else
                    {
                      echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                      echo $row["rang_nom_jp"];
                    }
                  }
                  else
                  {
                    if ($user_langue == "fr")
                    {
                      echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                      echo $row["rang_nom_fr"];
                    }
                    else
                    {
                      echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                      echo $row["rang_nom_jp"];
                    }
                  }
                }
                else
                {
                  if ($user_langue == "fr")
                  {
                    echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                    echo $row["rang_nom_fr"];
                  }
                  else
                  {
                    echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                    echo $row["rang_nom_jp"];
                  }
                }
                echo "</p>";
              }
            }
            ?>
          </div>
        </div>
        <div class="col-xs-12 col-md-2 controltext">
          <h2><?php echo $langage_perso['creation_hrp'][$user_langue]; ?></h2>
          <div class="contentarrond contentarrondspec">
            <?php
            if (isset($_SESSION["modif-perso"]["visibilite"]))
            {
              if ($_SESSION["modif-perso"]["visibilite"] == 0)
              {
                echo "<p class=\"btnarrond choseall\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_visibleall'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond choseme\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_visibleame'][$user_langue];
                echo "</p>";
              }
              else
              {
                echo "<p class=\"btnarrond choseall\">";
                echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_visibleall'][$user_langue];
                echo "</p>";

                echo "<p class=\"btnarrond choseme\">";
                echo "<i class=\"fa checkarrond fa-check-square-o\" aria-hidden=\"true\"></i>";
                echo $langage_perso['creation_visibleame'][$user_langue];
                echo "</p>";
              }
            }
            else
            {
              echo "<p class=\"btnarrond choseall\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_visibleall'][$user_langue];
              echo "</p>";

              echo "<p class=\"btnarrond choseme\">";
              echo "<i class=\"fa checkarrond fa-square-o\" aria-hidden=\"true\"></i>";
              echo $langage_perso['creation_visibleame'][$user_langue];
              echo "</p>";
            }
            ?>
            <hr>
            <p>
              <input type="file" id="imgpersomodif" name="imgpersomodif">
              <label for="imgpersomodif" class="addimg"><i class="fa fa-upload" aria-hidden="true"></i><?php echo $language_perso_crea["ficheperso_img_add"][$user_langue]?></label>
              <?php
                if(isset($_SESSION["modif-perso"]["uploadimg"]))
                {
                  $imgtempo = $_SESSION["modif-perso"]["uploadimg"];
                  echo "<div class=\"imgpreview\" style=\"background-image:url(".$imgtempo.");\"></div>";
                }
              ?>
            </p>
          </div>
        </div>

        <div class="col-xs-12 col-md-2 statsinput">
          <h2><?php echo $langage_perso['creation_stats'][$user_langue]; ?></h2>
          <div class="contentarrond contentarrondstats contentarrondspec">
            <p>
              <label for="force"><?php echo $langage_perso['creation_force'][$user_langue]; ?></label>
              <input class="individualstats" id="force" type="number" name="force" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["force"])){echo $_SESSION["modif-perso"]["stat"]["force"];}else{echo "0";} ?>">
            </p>
            <p>
              <?php
              if  (isset($_SESSION["modif-perso"]["nature"]))
              {
                if  ($_SESSION["modif-perso"]["nature"] == 0)
                {
                  ?>
                  <label for="faim" class="faim"><?php echo $langage_perso['creation_mental'][$user_langue]; ?></label>
                  <?php
                }
                else
                {
                  ?>
                  <label for="faim" class="faim"><?php echo $langage_perso['creation_faim'][$user_langue]; ?></label>
                  <?php
                }
              }
              else
              {
                ?>
                <label for="faim" class="faim"><?php echo $langage_perso['creation_faim'][$user_langue]; ?></label>
                <?php
              }
              ?>
              <input class="individualstats" id="faim" type="number" name="faim" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["faim"])){echo $_SESSION["modif-perso"]["stat"]["faim"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="courage"><?php echo $langage_perso['creation_courage'][$user_langue]; ?></label>
              <input class="individualstats" id="courage" type="number" name="courage" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["courage"])){echo $_SESSION["modif-perso"]["stat"]["courage"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="charisme"><?php echo $langage_perso['creation_charisme'][$user_langue]; ?></label>
              <input class="individualstats" id="charisme" type="number" name="charisme" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["charisme"])){echo $_SESSION["modif-perso"]["stat"]["charisme"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="eloquence"><?php echo $langage_perso['creation_eloquence'][$user_langue]; ?></label>
              <input class="individualstats" id="eloquence" type="number" name="eloquence" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["eloquence"])){echo $_SESSION["modif-perso"]["stat"]["eloquence"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="intelligence"><?php echo $langage_perso['creation_intelligence'][$user_langue]; ?></label>
              <input class="individualstats" id="intelligence" type="number" name="intelligence" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["intelligence"])){echo $_SESSION["modif-perso"]["stat"]["intelligence"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="culture"><?php echo $langage_perso['creation_culture'][$user_langue]; ?></label>
              <input class="individualstats" id="culture" type="number" name="culture" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["culture"])){echo $_SESSION["modif-perso"]["stat"]["culture"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="dexterite"><?php echo $langage_perso['creation_dexterite'][$user_langue]; ?></label>
              <input class="individualstats" id="dexterite" type="number" name="dexterite" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["dexterite"])){echo $_SESSION["modif-perso"]["stat"]["dexterite"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="agilite"><?php echo $langage_perso['creation_agilite'][$user_langue]; ?></label>
              <input class="individualstats" id="agilite" type="number" name="agilite" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["agilite"])){echo $_SESSION["modif-perso"]["stat"]["agilite"];}else{echo "0";} ?>">
            </p>
            <p>
              <label for="vitalite"><?php echo $langage_perso['creation_vitalite'][$user_langue]; ?></label>
              <input class="individualstats" id="vitalite" type="number" name="vitalite" value="<?php if(isset($_SESSION["modif-perso"]["stat"]["vitalite"])){echo $_SESSION["modif-perso"]["stat"]["vitalite"];}else{echo "0";} ?>">
            </p>
          </div>
        </div>
        <div class="col-xs-12 col-md-4">
          <div class="graphstat" style="height: 297px;">
            <style>
              #chartdiv {
                width: 100%;
                height: 500px;
              }
            </style>
            <div id="chartdiv">
            </div>
          </div>
        </div>
      </form>
    </div>

    <!--    <div class="footer">-->
<!--      <i class="fa fa-bars teuteu" aria-hidden="true"></i>-->
<!--    </div>-->
    <script type="text/javascript">
      $(document).ready(function(){

        $("#imgpersomodif").change(
          function(){
            $('#formpersomodif').submit();
          }
        )

        /* DONNEES DANS LES INPUT */
        $(".controltext input").keyup(function(){
          var prenomFR = $('input[name="prenom_fr"]').val();
          var prenomJP = $('input[name="prenom_jp"]').val();
          var nomFR = $('input[name="nom_fr"]').val();
          var nomJP = $('input[name="nom_jp"]').val();
          var surnomFR = $('input[name="surnom_fr"]').val();
          var surnomJP = $('input[name="surnom_jp"]').val();
          var descriptionFR = $('input[name="description_fr"]').val();
          var descriptionJP = $('input[name="description_jp"]').val();
          var masqueFR = $('input[name="masque_fr"]').val();
          var masqueJP = $('input[name="masque_jp"]').val();
          var metierFR = $('input[name="metier_fr"]').val();
          var metierJP = $('input[name="metier_jp"]').val();
          var age = $('input[name="age"]').val();
          var jour = $('input[name="jour"]').val();
          var mois = $('input[name="mois"]').val();
          var taille = $('input[name="taille"]').val();
          var poids = $('input[name="poids"]').val();
          var descriptionKagunefr = $('input[name="descriptionKagunefr"]').val();
          var descriptionKagunejp = $('input[name="descriptionKagunejp"]').val();
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:{
              prenomFR:prenomFR,
              prenomJP:prenomJP,
              nomFR:nomFR,
              nomJP:nomJP,
              surnomFR:surnomFR,
              surnomJP:surnomJP,
              descriptionFR:descriptionFR,
              descriptionJP:descriptionJP,
              masqueFR:masqueFR,
              masqueJP:masqueJP,
              metierFR:metierFR,
              metierJP:metierJP,
              age:age,
              jour:jour,
              mois:mois,
              taille:taille,
              poids:poids,
              descriptionKagunefr:descriptionKagunefr,
              descriptionKagunejp:descriptionKagunejp
            },
            success: function(){}
          });
        });
        /*ARRONDISSEMENTS*/
        $(".ward").click(function(){

          var ward = $(this).data("ward");
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"ward="+ward,
            success: function(data){
              if (data == 0)
              {
                $(".ward"+ward+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".ward"+ward+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* GROUPE */
        $(".groupe").click(function(){
          var groupe = $(this).data("groupe");
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"groupe="+groupe,
            success: function(data){
              if (data == 0)
              {
                $(".groupe"+groupe+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".groupe"+groupe+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* CHOIX POUR LA NATURE*/
        $(".chosehu").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=3",
            success: function(data){
              if (data == "2")
              {
                $(".chosehu .fa").removeClass("fa-check-square-o");
                $(".chosehu .fa").addClass("fa-square-o");
              }
              else
              {
                $(".choseg .fa").removeClass("fa-check-square-o");
                $(".choseg .fa").addClass("fa-square-o");

                $(".chosehu .fa").removeClass("fa-square-o");
                $(".chosehu .fa").addClass("fa-check-square-o");
              }
             refreshRadar();
             $(".faim").html("<?php echo $langage_perso['creation_mental'][$user_langue]; ?>");
            }
          });
        });
        $(".choseg").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=4",
            success: function(data){
              if (data == "2")
              {
                $(".choseg .fa").removeClass("fa-check-square-o");
                $(".choseg .fa").addClass("fa-square-o");
              }
              else
              {
                $(".chosehu .fa").removeClass("fa-check-square-o");
                $(".chosehu .fa").addClass("fa-square-o");

                $(".choseg .fa").removeClass("fa-square-o");
                $(".choseg .fa").addClass("fa-check-square-o");
              }
             refreshRadar();
             $(".faim").html("<?php echo $langage_perso['creation_faim'][$user_langue]; ?>");
            }
          });
        });
        /* CHOIX POUR VIVANT*/
        $(".chosev").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=5",
            success: function(data){
              if (data == "2")
              {
                $(".chosev .fa").removeClass("fa-check-square-o");
                $(".chosev .fa").addClass("fa-square-o");
              }
              else
              {
                $(".chosem .fa").removeClass("fa-check-square-o");
                $(".chosem .fa").addClass("fa-square-o");

                $(".chosev .fa").removeClass("fa-square-o");
                $(".chosev .fa").addClass("fa-check-square-o");
              }
            }
          });
        });
        $(".chosem").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=6",
            success: function(data){
              if (data == "2")
              {
                $(".chosem .fa").removeClass("fa-check-square-o");
                $(".chosem .fa").addClass("fa-square-o");
              }
              else
              {
                $(".chosev .fa").removeClass("fa-check-square-o");
                $(".chosev .fa").addClass("fa-square-o");

                $(".chosem .fa").removeClass("fa-square-o");
                $(".chosem .fa").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* CHOIX POUR LE GENRE*/
        $(".choseh").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=1",
            success: function(data){
              if (data == "2")
              {
                $(".choseh .fa").removeClass("fa-check-square-o");
                $(".choseh .fa").addClass("fa-square-o");
              }
              else
              {
                $(".chosef .fa").removeClass("fa-check-square-o");
                $(".chosef .fa").addClass("fa-square-o");

                $(".choseh .fa").removeClass("fa-square-o");
                $(".choseh .fa").addClass("fa-check-square-o");
              }
            }
          });
        });
        $(".chosef").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=2",
            success: function(data){
              if (data == "2")
              {
                $(".chosef .fa").removeClass("fa-check-square-o");
                $(".chosef .fa").addClass("fa-square-o");
              }
              else
              {
                $(".choseh .fa").removeClass("fa-check-square-o");
                $(".choseh .fa").addClass("fa-square-o");

                $(".chosef .fa").removeClass("fa-square-o");
                $(".chosef .fa").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* APPARITION */
        $(".appa").click(function(){
          var appa = $(this).data("appa");
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"appa="+appa,
            success: function(data){
              if (data == "0")
              {
                $(".appa"+appa+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".appa"+appa+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* CHOIX DU TYPE DE KAGUNE */
        $(".chkagune").click(function(){
          var kagune = $(this).attr("data-kagune");
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"kagune="+kagune,
            success: function(data)
            {
              if (data == "0")
              {
                $(".kagune"+kagune+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".kagune"+kagune+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* DONNEES DANS LES INPUT */
        $(".containerquinque").on('keyup', ".quinquecontrol", function(){
          var texte        = $(this).val();
          var loppquinque  = $(this).attr('data-loop');
          var champquinque = $(this).attr('data-champ');
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:{
              texte:texte,
              loppquinque:loppquinque,
              champquinque:champquinque
            },
            success: function(){}
          });
        });
        /* CHARGER LES QUINQUES A L'OUVERTURE DE LA PAGE */
        $(document).ready(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"quinqueadd=1",
            success: function(data)
            {
              $(".containerquinque").html(data);
            }
          });
        });
        /* AJOUTER UN QUINQUE */
        $(".addquinque").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"quinqueadd=0",
            success: function(data)
            {
              $(".containerquinque").html(data);
            }
          });
        });
        /* CHOIX TYPE QUINQUE*/
        $(document).ready(function(){
          $(".containerquinque").on('click', ".typequinque", function(){
            var idtype   = $(this).attr("data-idtype");
            var looptype = $(this).attr("data-looptype");
            query = $.ajax({
              type:"POST",
              url:"traitement-perso-modif.php",
              data:{
                idtype:idtype,
                looptype:looptype
              },
              success: function(data) {
                if (data == "0")
                {
                  $(".typequinque"+idtype+""+looptype+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
                }
                else
                {
                  $(".typequinque"+idtype+""+looptype+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
                }
              }
            });
          });
        });
        /* CHOIX DU RANG GOULE */
        $(".rangg").click(function(){
          var rangg = $(this).attr("data-rangg");
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"rangg="+rangg,
            success: function(data)
            {
              if (data == "0")
              {
                $(".rangg"+rangg+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".rangg"+rangg+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* CHOIX DU RANG CCG */
        $(".rangc").click(function(){
          var rangc = $(this).attr("data-rangc");
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"rangc="+rangc,
            success: function(data)
            {
              if (data == "0")
              {
                $(".rangc"+rangc+" .fa").addClass("fa-square-o").removeClass("fa-check-square-o");
              }
              else
              {
                $(".rangc"+rangc+" .fa").removeClass("fa-square-o").addClass("fa-check-square-o");
              }
            }
          });
        });
        /* SUPPRIMER UN QUINQUE */
        $(document).ready(function(){
          $(".containerquinque").on('click', ".quinquedelete", function(){
            quinquesupp = $(this).attr("data-id");
            quinqueadd = 1;

            query = $.ajax({
              type:"POST",
              url:"traitement-perso-modif.php",
              data:{
                quinqueadd:quinqueadd,
                quinquesupp:quinquesupp
              },
              success: function(data)
              {
                $(".containerquinque").html(data);
              }
            });
          });
        });
        /* CHOIX POUR LA VISIBILITE*/
        $(".choseall").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=7",
            success: function(){
              $(".choseme .fa").removeClass("fa-check-square-o");
              $(".choseme .fa").addClass("fa-square-o");

              $(".choseall .fa").removeClass("fa-square-o");
              $(".choseall .fa").addClass("fa-check-square-o");
            }
          });
        });
        $(".choseme").click(function(){
          query = $.ajax({
            type:"POST",
            url:"traitement-perso-modif.php",
            data:"genre=8",
            success: function(){
              $(".choseall .fa").removeClass("fa-check-square-o");
              $(".choseall .fa").addClass("fa-square-o");

              $(".choseme .fa").removeClass("fa-square-o");
              $(".choseme .fa").addClass("fa-check-square-o");
            }
          });
        });
        /* GENERATION DES STATS UNE PREMIERE FOIS */
        $(document).ready(function() {
          refreshRadar();
        });
        /* REFRESH RADAR*/
        $(".contentarrondstats").on('keyup', ".individualstats", function(){
          refreshRadar();
        });
        $(".statsinput .contentarrondstats").on('click', ".individualstats", function(){
          refreshRadar();
        });

        function refreshRadar(){
          var force        = $('input[name=force]').val();
          var faim         = $('input[name=faim]').val();
          var courage      = $('input[name=courage]').val();
          var charisme     = $('input[name=charisme]').val();
          var eloquence    = $('input[name=eloquence]').val();
          var intelligence = $('input[name=intelligence]').val();
          var culture      = $('input[name=culture]').val();
          var dexterite    = $('input[name=dexterite]').val();
          var agilite      = $('input[name=agilite]').val();
          var vitalite     = $('input[name=vitalite]').val();
          query = $.ajax({
            type:"POST",
            url:"traitement-radar-modif.php",
            data:{
              force:force,
              faim:faim,
              courage:courage,
              charisme:charisme,
              eloquence:eloquence,
              intelligence:intelligence,
              culture:culture,
              dexterite:dexterite,
              agilite:agilite,
              vitalite:vitalite,
            },
            success: function(data){
              var controle =JSON.parse(data);
              var datas = controle;
              $(".chartdiv").html();
              var chart = AmCharts.makeChart( "chartdiv", {
                "type": "radar",
                "theme": "pattern",
                "dataProvider": datas,
                "valueAxes": [ {
                  "axisTitleOffset": 20,
                  "minimum": 0,
                  "maximum": 10,
                  "axisAlpha": 0.1
                } ],
                "startDuration": 2,
                "graphs": [ {
                  // "balloonText": "[[value]] valeur of beer per year",
                  "bullet": "round",
                  "lineThickness": 2,
                  "valueField": "valeur"
                } ],
                "categoryField": "stats",
                "export": {
                  "enabled": false
                },
                "colors": ["grey"],
                "startDuration":0,
                "startEffect":"easeOutSine",
              } );
              $('a[title="JavaScript charts"]').hide();
            }
          });
        }
        $(".validationform").click(function(){
          query = $.ajax({
            type:"POST",
            url:"perso.php",
            data:"valide",
            success: function(){
              window.location.href = "mozaique.php";
            }
          });
        });
        /* FOOTER */
        $(".footer").mouseenter(function(){
          var heightScreen = $(window).height();
          var result = heightScreen-85;
          var result = result+"px";
          $(".footer").css({
            'height': result
          });
        });
        $(".footer").mouseleave(function(){
          $(".footer").css({
            'height': '25px'
          });
        });
      })
    </script>
  </body>
</html>
