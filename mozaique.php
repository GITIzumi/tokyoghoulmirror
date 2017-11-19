<?php
session_start();
 ini_set('display_errors','on');
 error_reporting(E_ALL);
include("_connected.php");
include_once("langue.php");

// POUR L'ANIMATION ID PERSO APRES CREATION ET MODIFICATION
if (isset($_SESSION["animID"]))
{
  $idanim = strip_tags(trim($_SESSION["animID"]));
  unset($_SESSION["animID"]);
  header("location:mozaique.php?idperso=id$idanim");
}

//SUPRESSION DES IMAGES TEMPO
// La fonction en question.
function suppression($dossier_traite , $age_requis)
{
  // On ouvre le dossier.
  $repertoire = opendir($dossier_traite);
  // On lance notre boucle qui lira les fichiers un par un.
  while(false !== ($fichier = readdir($repertoire)))
  {
    // On met le chemin du fichier dans une variable simple
    $chemin = $dossier_traite."/".$fichier;
    // Les variables qui contiennent toutes les infos nécessaires.
    $infos = pathinfo($chemin);
    $extension = $infos['extension'];

    $age_fichier = time() - filemtime($chemin);
    // On n'oublie pas LA condition sous peine d'avoir quelques surprises. :p
    if($fichier!="." AND $fichier!=".." AND $age_fichier > $age_requis)
    {
      unlink($chemin);
    }
  }
  closedir($repertoire); // On ferme !
}
// Notre fonction paramétrée.
suppression( "img/tempo" , "3600" );

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
    <link rel="stylesheet" href="css/mozaique.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">

  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1><?php echo $langage_home['personnage_h2'][$user_langue]; ?></h1>
    </div>
    <div class="col-xs-12 general">
      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
        <a href="perso-creation.php">
          <div class="personnage">
            <div class="rond-img"><i class="fa fa-plus" aria-hidden="true"></i></div>
            <?php
            if(isset($_SESSION["crea-perso"]))
            {
              if (isset($_SESSION["crea-perso"]))
              {
                echo "<p class=\"nom\">".$langage_perso['creation_add2_1'][$user_langue]."</p>";
                echo "<p class=\"nom\">".$langage_perso['creation_add2_2'][$user_langue]."</p>";
                echo "<p class=\"prenom\">".$langage_perso['creation_add2_3'][$user_langue]."</p>";
              }
              else
              {
                echo "<p class=\"nom\">".$langage_perso['creation_add_1'][$user_langue]."</p>";
                echo "<p class=\"nom\">".$langage_perso['creation_add_2'][$user_langue]."</p>";
                echo "<p class=\"prenom\">".$langage_perso['creation_add_3'][$user_langue]."</p>";
              }
            }
            else
            {
              echo "<p class=\"nom\">".$langage_perso['creation_add_1'][$user_langue]."</p>";
              echo "<p class=\"nom\">".$langage_perso['creation_add_2'][$user_langue]."</p>";
              echo "<p class=\"prenom\">".$langage_perso['creation_add_3'][$user_langue]."</p>";
            }
            ?>
          </div>
        </a>
      </div>
    <?php
      $queryPerso = $mysqli->query
      ("SELECT *
        FROM perso
        WHERE perso_visibilite = 0
          AND perso_actif = 1
        OR perso_visibilite = $user_id
          AND perso_actif = 1
        ORDER BY perso_nom_fr
      ");
      $nbPerso = $queryPerso->num_rows;
      if ($nbPerso > 0)
      {
        while($row = $queryPerso->fetch_array())
        {
          $text = array(
            'prenom'       => array(	'fr' => $row["perso_prenom_fr"],
                                      'jp' => $row["perso_prenom_jp"]),
            'nom'          => array(	'fr' => $row["perso_nom_fr"],
                                      'jp' => $row["perso_nom_jp"]),
            'surnom'       => array(	'fr' => $row["perso_surnom_fr"],
                                      'jp' => $row["perso_surnom_jp"]),
            'masque'       => array(	'fr' => $row["perso_masque_fr"],
                                      'jp' => $row["perso_masque_jp"]),
            'description'  => array(	'fr' => $row["perso_description_fr"],
                                      'jp' => $row["perso_description_jp"]),
            'metier'       => array(	'fr' => $row["perso_metier_fr"],
                                      'jp' => $row["perso_metier_jp"]),

            'img'            => $row["perso_image"],
            'nature'         => $row["perso_nature"],
            'genre'          => $row["perso_genre"],
            'jour'           => $row["perso_age_jour"],
            'mois'           => $row["perso_age_mois"],
            'age'            => $row["perso_age"],
            'taille'         => $row["perso_taille"],
            'poids'          => $row["perso_poids"],


            'force'          => $row["perso_force"],
            'faim'           => $row["perso_faim"],
            'courage'        => $row["perso_courage"],
            'courage'        => $row["perso_courage"],
            'charisme'       => $row["perso_charisme"],
            'eloquence'      => $row["perso_eloquence"],
            'intelligence'   => $row["perso_intelligence"],
            'culture'        => $row["perso_culture"],
            'dexterite'      => $row["perso_dexterite"],
            'agilite'        => $row["perso_agilite"],
            'vitalite'       => $row["perso_vitalite"],

            'vie'           => $row["perso_vie"],
            'visibilite'    => $row["perso_visibilite"],
          );
          $kaguneID = $row["kagune_id"];
          $idPerso  = $row["perso_id"];

          //Couleur du groupe
          $query2 = $mysqli->query
          ("SELECT groupe.groupe_couleur
            FROM groupe
            JOIN perso_groupe
            WHERE groupe.groupe_id = perso_groupe.groupe_id
            AND perso_groupe.perso_id = $idPerso
            ORDER BY RAND()
            LIMIT 1
          ");
          $nb2    = $query2->num_rows;
          if ($nb2 > 0)
          {
            while($row = $query2->fetch_array())
            {
              $couleurEntete = $row["groupe_couleur"];
            }
          }
          else
          {
            $couleurEntete = 0;
          }
          echo "<div id=\"id".$idPerso."\" class=\"col-xs-12 col-sm-6 col-md-4 col-lg-2\">";
            echo "<div class=\"personnage\">";
              echo "<div class=\"personnagewrap pop".$idPerso."\">";
                if (isset($couleurEntete) && $couleurEntete !== 0)
                {
                  echo "<div style=\"background-color:".$couleurEntete."\" class=\"enteteperso enteteperso".$idPerso."\">";
                }
                else
                {
                  echo "<div class=\"enteteperso\">";
                }
                echo "<div class=\"rond-img\" style=\"background-image: url(img/persos/".$text["img"].");\"></div>";
                echo "<a href=\"perso.php?id=".$idPerso."\">";
                  echo "<i style=\"position: relative; top: 80px; left: 19px; font-size: 14px;cursor: pointer; z-index: 36\" class=\"modifie".$idPerso." fa fa-pencil\" aria-hidden=\"true\"></i>";
                echo "</a>";
                if ($text["vie"] == 0)
                {
                  echo "<i style=\"position: relative;top: -96px;right: -10px;color: white;\" class=\"fa fa-bolt\" aria-hidden=\"true\"></i>";
                }
                if ($text["visibilite"] > 0)
                {
                  echo "<i style=\"position: relative;top: -120px;right: 0px;color: white;\" class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i>";
                }
                echo "<div class=\"listegroupe\">";
                $query2 = $mysqli->query(" SELECT groupe.groupe_couleur, groupe.groupe_nom_fr, groupe.groupe_nom_jp
                  FROM groupe
                  JOIN perso_groupe
                  WHERE groupe.groupe_id = perso_groupe.groupe_id
                  AND perso_groupe.perso_id = $idPerso
                  ");
                  $nb2    = $query2->num_rows;
                  if ($nb2 > 0)
                  {
                    while($row = $query2->fetch_array())
                    {
                      $couleurEntete = $row["groupe_couleur"];
                      $tempo=array(
                          'nomgroupe'=>array(
                              'fr'=>$row["groupe_nom_fr"],
                              'jp'=>$row["groupe_nom_jp"],
                          )
                      );
                      if (empty($tempo["nomgroupe"][$user_langue]))
                      {
                        echo "<div class=\"rondgroupecouleur\" title=\"".$tempo["nomgroupe"]["fr"]."\" style=\"background-color:".$couleurEntete."\" data-couleurid=\"".$idPerso."\">";
                      }
                      else
                      {
                        echo "<div class=\"rondgroupecouleur\" title=\"".$tempo["nomgroupe"][$user_langue]."\" style=\"background-color:".$couleurEntete."\" data-couleurid=\"".$idPerso."\">";
                      }
                      echo "</div>";
                    }
                  }
                  echo "</div>";
                echo "</div>";
                  if (empty($text["nom"][$user_langue]))
                  {
                    echo "<p class=\"nom\">".$text["nom"]['fr']." ";
                  }
                  else
                  {
                    echo "<p class=\"nom\">".$text["nom"][$user_langue]." ";
                  }
                  if (empty($text["prenom"][$user_langue]))
                  {
                    echo $text["prenom"]['fr']."</p>";
                  }
                  else
                  {
                    echo $text["prenom"][$user_langue]."</p>";
                  }
                  if (empty($text["surnom"][$user_langue]))
                  {
                    echo "<p class=\"surnom\">".$text["surnom"]['fr']."</p>";
                  }
                  else
                  {
                    echo "<p class=\"surnom\">".$text["surnom"][$user_langue]."</p>";
                  }
                  echo "<i data-id=\"".$idPerso."\" class=\"tiret".$idPerso." morecontent fa fa-angle-down\" aria-hidden=\"true\"></i>";
                echo "</div>";
                echo "<div class=\"col-xs-12 personnagemore popmore".$idPerso."\">";
                // GENRE
                if ($text["genre"] == "0")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_genre2"][$user_langue]."</span> : ".$langage_perso["creation_homme"][$user_langue]."</p>";
                }
                if ($text["genre"] == "1")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_genre2"][$user_langue]."</span> : ".$langage_perso["creation_femme"][$user_langue]."</p>";
                }
                if ($text["genre"] == "2")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_genre2"][$user_langue]."</span> : ".$langage_perso["creation_inconnu"][$user_langue]."</p>";
                }
                // NATURE
                if ($text["nature"] == "0")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_nature"][$user_langue]."</span> : ".$langage_perso["creation_human"][$user_langue]."</p>";
                }
                if ($text["nature"] == "1")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_nature"][$user_langue]."</span> : ".$langage_perso["creation_goul"][$user_langue]."</p>";
                }
                if ($text["nature"] == "2")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_nature"][$user_langue]."</span> : ".$langage_perso["creation_inconnu"][$user_langue]."</p>";
                }
                // AGE
                if (($text["age"] !== "0" && $text["age"] !== NULL && $text["age"] !== "") OR
                    ($text["taille"] !== "0" && $text["taille"] !== NULL && $text["taille"] !== "") OR
                    ($text["poids"] !== "0" && $text["poids"] !== NULL && $text["poids"] !== ""))
                {
                  echo "<hr>";
                  echo "<div class='row'>";
                  if ($text["age"] !== "0" && $text["age"] !== NULL && $text["age"] !== "")
                  {
                    echo "<div class=\"col-xs-4\">";
                       echo "<i class=\"fa fa-birthday-cake\" style='text-align: center;display: inherit;padding-bottom: 10px;' aria-hidden=\"true\"></i>";
                    echo "<p style='text-align: center; margin-bottom: 0'>".$text["age"]."</p></div>";
                  }
                  if ($text["taille"] !== "0" && $text["taille"] !== NULL && $text["taille"] !== "")
                  {
                    echo "<div class=\"col-xs-4\">";
                    echo "<i class=\"fa  fa-sort-amount-desc\" style='text-align: center;display: inherit;padding-bottom: 10px;' aria-hidden=\"true\"></i>";
                    echo "<p style='text-align: center; margin-bottom: 0'>".$text["taille"]." m</p></div>";
                  }
                  if ($text["poids"] !== "0" && $text["poids"] !== NULL && $text["poids"] !== "")
                  {
                    echo "<div class=\"col-xs-4\">";
                    echo "<i class=\"fa fa-balance-scale\" style='text-align: center;display: inherit;padding-bottom: 10px;' aria-hidden=\"true\"></i>";
                    echo "<p style='text-align: center; margin-bottom: 0'>".$text["poids"]." kg</p></div>";
                  }

                  echo "</div>";
                  echo "<hr>";
                }
                // JOUR
                if ($text["jour"] !== "0")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_jour"][$user_langue]."</span> : ".$text["jour"]."</p>";
                }
                // MOIS
                if ($text["jour"] !== "0")
                {
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_mois"][$user_langue]."</span> : ".$mois[$text["mois"]][$user_langue]."</p>";
                }
                // MASQUE
                if (isset($text["masque"]["fr"]) && $text["masque"]["fr"] !== "")
                {
                  echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_masque"][$user_langue]." : </p>";
                  if (!isset($text["masque"][$user_langue]))
                  {
                    echo "<p>".$text["masque"]["fr"]."</p>";
                  }
                  else
                  {
                    echo "<p>".$text["masque"][$user_langue]."</p>";
                  }
                }
                // METIER
                if (isset($text["metier"]["fr"]) && $text["metier"]["fr"] !== "")
                {
                  echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_metier"][$user_langue]." : </p>";
                  if (!isset($text["metier"][$user_langue]))
                  {
                    echo "<p>".$text["metier"]["fr"]."</p>";
                  }
                  else
                  {
                    echo "<p>".$text["metier"][$user_langue]."</p>";
                  }
                }
                // DESCRIPTION
                if (isset($text["description"]["fr"]) && $text["description"]["fr"] !== "")
                {
                  echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_description"][$user_langue]." : </p>";
                  if (!isset($text["description"][$user_langue]))
                  {
                    echo "<p>".$text["description"]["fr"]."</p>";
                  }
                  else
                  {
                    echo "<p>".$text["description"][$user_langue]."</p>";
                  }
                }
                // ARRONDISSEMENT
                $query2 = $mysqli->query(" SELECT * FROM arrondissement
                                                       JOIN perso_arrondissement
                                                       WHERE arrondissement.arrondissement_id = perso_arrondissement.arrondissement_id
                                                       AND perso_arrondissement.perso_id = $idPerso
                                                       ORDER BY arrondissement.arrondissement_id ASC
                                                       ");
                $nb2 = $query2->num_rows;
                if ($nb2 > 0)
                {
                  echo "<hr>";
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_arrondissement"][$user_langue]."</span> : ";
                  while($row = $query2->fetch_array())
                  {
                    $tempo=array(
                        'yard'=>array(
                            'fr'=>$row["arrondissement_fr"],
                            'jp'=>$row["arrondissement_jp"],
                        ),
                        'numero' =>$row["arrondissement_numero"]
                    );
                    if ($user_langue == "fr")
                    {
                      if ($tempo['numero'] == "1")
                      {
                        echo "<p>". $tempo['numero']."er : ".$tempo['yard']["fr"]."</p>";
                      }
                      else
                      {
                        echo "<p>". $tempo['numero']."ème : ".$tempo['yard']["fr"]."</p>";
                      }
                    }
                    else
                    {
                      echo "<p>". $tempo['numero']." : ".$tempo['yard']["jp"]."</p>";
                    }
                  }
                }
                // RANG
                $query2 = $mysqli->query(" SELECT rang.rang_nom_fr, rang.rang_nom_jp
                                                 FROM rang
                                                 JOIN perso_rang
                                                 WHERE rang.rang_id = perso_rang.rang_id
                                                 AND perso_rang.perso_id = $idPerso
                                                 ");
                $nb2 = $query2->num_rows;
                if ($nb2 > 0)
                {
                  echo "<hr>";
                  echo "<p><span class=\"cardPersoTitle\">".$langage_perso["creation_rang"][$user_langue]."</span> : ";
                  while($row = $query2->fetch_array())
                  {
                    $tempo=array(
                      'rang'=>array(
                          'fr'=>$row["rang_nom_fr"],
                          'jp'=>$row["rang_nom_jp"],
                      )
                    );
                    echo $tempo["rang"][$user_langue];
                    $nb2--;
                    if ($nb2>0)
                    {
                      echo ", ";
                    }
                  }
                  echo "</p>";
                }
                // GROUPE
                $query2 = $mysqli->query("
                  SELECT groupe.groupe_couleur, groupe.groupe_nom_fr, groupe.groupe_nom_jp
                  FROM groupe
                  JOIN perso_groupe
                  WHERE groupe.groupe_id = perso_groupe.groupe_id
                  AND perso_groupe.perso_id = $idPerso
                ");
                $nb2 = $query2->num_rows;
                if ($nb2 > 0)
                {
                  echo "<hr>";
                  echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_affiliation"][$user_langue]." : </p>";
                  while($row = $query2->fetch_array())
                  {
                    $couleurEntete = $row["groupe_couleur"];
                    $tempo=array(
                        'nomgroupe'=>array(
                            'fr'=>$row["groupe_nom_fr"],
                            'jp'=>$row["groupe_nom_jp"],
                        )
                    );
                    if (empty($tempo["nomgroupe"][$user_langue]))
                    {
                      echo "<p><span class=\"carreaffiliation\" style=\"background-color: ".$couleurEntete."\"></span>".$tempo["nomgroupe"]["fr"]."</p>";
                    }
                    else
                    {
                     echo "<p><span class=\"carreaffiliation\" style=\"background-color: ".$couleurEntete."\"></span>".$tempo["nomgroupe"][$user_langue]."</p>";
                    }
                  }
                }
                //  QUINQUE
                $query2 = $mysqli->query("  SELECT *
                                                    FROM quinque
                                                    JOIN quinque_type
                                                    JOIN type
                                                    JOIN quinque_perso
                                                    WHERE quinque.quinque_id  = quinque_type.quinque_id
                                                    AND quinque_type.type_id = type.type_id
                                                    AND quinque.quinque_id = quinque_perso.quinque_id
                                                    AND quinque_perso.perso_id = $idPerso
                                                    AND quinque.quinque_valide = 1
                                                    GROUP BY quinque.quinque_id
                ");
                $nb2    = $query2->num_rows;
                if ($nb2 > 0)
                {
                  echo "<hr>";
                  echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_quinque"][$user_langue]."</p>";

                  while($row = $query2->fetch_array())
                  {
                    echo "<div class='containerquinquecard'>";
                    $tempo=array(
                        'quinquenom'=>array(
                            'fr'=>$row["quinque_nom_fr"],
                            'jp'=>$row["quinque_nom_jp"]
                        ),
                        'quinquedescription'=>array(
                            'fr'=>$row["quinque_description_fr"],
                            'jp'=>$row["quinque_description_jp"]
                        ),
                    );

                    if (isset($tempo['quinquenom'][$user_langue]))
                    {
                      echo "<p>".$langage_perso["creation_nom"][$user_langue]." : ".$tempo['quinquenom'][$user_langue]."</p>";
                    }
                    else
                    {
                      echo "<p>".$langage_perso["creation_nom"][$user_langue]." : ".$tempo['quinquenom']["fr"]."</p>";
                    }
                    echo "<p>".$langage_perso["creation_type"][$user_langue]." : ";
                    $a = 0;

                    $query3 = $mysqli->query("  SELECT *
                                                    FROM quinque
                                                    JOIN quinque_type
                                                    JOIN type
                                                    JOIN quinque_perso
                                                    WHERE quinque.quinque_id  = quinque_type.quinque_id
                                                    AND quinque_type.type_id = type.type_id
                                                    AND quinque.quinque_id = quinque_perso.quinque_id
                                                    AND quinque_perso.perso_id = $idPerso
                                                    AND quinque.quinque_valide = 1
                    ");
                    $nb3    = $query3->num_rows;
                    if ($nb2 > 0)
                    {
                      while($row = $query3->fetch_array())
                      {
                        if ($user_langue == "fr")
                        {
                          if ($a == 0)
                          {
                            echo $row["type_type_fr"];
                          }
                          else
                          {
                            echo ", ".$row["type_type_fr"];
                          }
                          $a++;
                        }
                        else
                        {
                          if ($a == 0)
                          {
                            echo $row["type_type_jp"];
                          }
                          else
                          {
                            echo ", ".$row["type_type_jp"];
                          }
                          $a++;
                        }
                      }
                    }
                    echo "</p>";
                    if (isset($tempo['quinquedescription'][$user_langue]))
                    {
                      echo "<p>".$tempo['quinquedescription'][$user_langue]."</p>";
                    }
                    else
                    {
                      echo "<p>".$tempo['quinquedescription']["fr"]."</p>";
                    }
                    echo "</div>";
                  }

                }
                //  KAGUNE
                if ($kaguneID != NULL)
                {
                  $query2 = $mysqli->query("  SELECT *
                                            FROM kagune
                                            JOIN kagune_type
                                            JOIN type
                                            WHERE kagune.kagune_id  = kagune_type.kagune_id
                                            AND kagune_type.type_id = type.type_id
                                            AND kagune.kagune_id = $kaguneID
                  ");
                  $nb2    = $query2->num_rows;
                  if ($nb2 > 0)
                  {
                    echo "<hr>";
                    echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_kagune"][$user_langue]." :</p>";
                    echo "<p>".$langage_perso["creation_type"][$user_langue]." : ";
                    $a = 0;
                    while($row = $query2->fetch_array())
                    {
                      if ($user_langue == "fr")
                      {
                        if ($a == 0)
                        {
                          echo $row["type_type_fr"];
                        }
                        else
                        {
                          echo ", ".$row["type_type_fr"];
                        }
                        $a++;
                      }
                      else
                      {
                        if ($a == 0)
                        {
                          echo $row["type_type_jp"];
                        }
                        else
                        {
                          echo ", ".$row["type_type_jp"];
                        }
                        $a++;
                      }
                    }
                    echo "</p>";

                    $query3 = $mysqli->query("  SELECT *
                                            FROM kagune
                                            WHERE kagune.kagune_id = $kaguneID
                    ");
                    $nb3    = $query3->num_rows;
                    if ($nb3 == 1)
                    {
                      while($row1 = $query3->fetch_array())
                      {
                        $tempoo=array(
                            'description'=>array(
                                'fr'=>$row1["kagune_description_fr"],
                                'jp'=>$row1["kagune_description_jp"],
                            ),

                        );
                        echo "<p>";
                          if (isset($tempoo["description"][$user_langue]))
                          {
                            echo $tempoo["description"][$user_langue];
                          }
                          else
                          {
                            echo $tempoo["description"]["fr"];
                          }
                        echo "</p>";
                      }
                    }
                  }
                }
                // STATS
                if (($text["force"] !== "0"))
                {
                  echo "<hr>";
                  // FORCE
                  echo "<p>".$langage_perso["creation_force"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["force"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // FAIM
                  if ($text["nature"] == 1)
                  {
                    echo "<p>".$langage_perso["creation_faim"][$user_langue]."</p>";
                  }
                  else
                  {
                    echo "<p>".$langage_perso["creation_mental"][$user_langue]."</p>";

                  }
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["faim"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // COURAGE
                  echo "<p>".$langage_perso["creation_courage"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["courage"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // CHARISME
                  echo "<p>".$langage_perso["creation_charisme"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["charisme"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // ELOQUENCE
                  echo "<p>".$langage_perso["creation_eloquence"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["eloquence"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // INTELLIGENCE
                  echo "<p>".$langage_perso["creation_intelligence"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["intelligence"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // CULTURE
                  echo "<p>".$langage_perso["creation_culture"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["culture"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // DEXTERITE
                  echo "<p>".$langage_perso["creation_dexterite"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["dexterite"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // AGILITE
                  echo "<p>".$langage_perso["creation_agilite"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["agilite"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";

                  // VITALITE
                  echo "<p>".$langage_perso["creation_vitalite"][$user_langue]."</p>";
                  echo "<div class=\"containerTool\">";
                  $a = 1;
                  while ($a <= 9)
                  {
                    echo "<div style=\"left: ".$a."0%\" class=\"statisquebarTool statisquebarTool".$a."\">";
                    echo $a;
                    echo "</div>";
                    $a++;
                  }
                  echo "</div>";
                  echo "<div class=\"statisquebar\">";
                  echo "<div style=\"width: ".$text["vitalite"]."0%\" class=\"statisquebarIn\">";
                  echo "</div>";
                  echo "</div>";
                }


                // APPARTITIONS
                $query2 = $mysqli->query("  SELECT *
                                            FROM perso
                                            JOIN chapitre_perso
                                            JOIN chapitre
                                            WHERE perso.perso_id = chapitre_perso.perso_id
                                            AND chapitre_perso.chapitre_id = chapitre.chapitre_id
                                            AND perso.perso_id = $idPerso
                                            ORDER BY chapitre.chapitre_numero_fr DESC");
                $nb2    = $query2->num_rows;
                if ($nb2 > 0)
                {
                  echo "<hr>";
                  echo "<p class=\"cardPersoTitle\">".$langage_perso["creation_apparition"][$user_langue]." :</p>";
                  echo "<ul>";
                  while($row = $query2->fetch_array())
                  {
                    $tempoo=array(
                      'numero'=>array(
                        'fr'=>$row["chapitre_numero_fr"],
                        'jp'=>$row["chapitre_numero_jp"],
                      ),
                      'titre'=>array(
                        'fr'=>$row["chapitre_titre_fr"],
                        'jp'=>$row["chapitre_titre_jp"],
                      ),
                    );

                    if (empty($tempoo["numero"][$user_langue]))
                    {
                      if ($tempoo["numero"]["fr"] == "0")
                      {
                        echo "<li><a href=\"".$row["chapitre_link"]."\" target=\"blank\">".$language_chapitre["chapitre_crea_btn_spin"]["fr"]." : ";
                      }
                      else
                      {
                        echo "<li><a href=\"".$row["chapitre_link"]."\" target=\"blank\">".$tempoo["numero"]["fr"]." : ";
                      }
                    }
                    else
                    {
                      if ($tempoo["numero"]["fr"] == "0")
                      {
                        echo "<li><a href=\"".$row["chapitre_link"]."\" target=\"blank\">".$language_chapitre["chapitre_crea_btn_spin"][$user_langue]." : ";
                      }
                      else
                      {
                        echo "<li><a href=\"".$row["chapitre_link"]."\" target=\"blank\">".$tempoo["numero"]["fr"]." : ";
                      }
                    }
                    if (empty($tempoo["titre"][$user_langue]))
                    {
                      echo $tempoo["titre"]["fr"]."</a></li>";
                    }
                    else
                    {
                      echo $tempoo["titre"][$user_langue]."</a></li>";
                    }
                  }
                  echo "</ul>";
                }
              echo "</div>";
            echo "</div>";
          echo "</div>";
        }
      }
    ?>
  </div>
<!--    <div class="footer">-->
<!--      <i class="fa fa-bars teuteu" aria-hidden="true"></i>-->
<!--    </div>-->
    <script type="text/javascript">
      $(document).ready(function(){
        <?php
        if ( isset($_GET["idperso"]) )
        {
          $idgoto = strip_tags(trim($_GET["idperso"]));


          $idtotest = substr($idgoto,2);

          if (is_numeric($idtotest))
          {
            $querycontrol = $mysqli->query
            ("  SELECT *
              FROM perso
              WHERE perso_visibilite = 0 OR perso_visibilite = $user_id
                AND perso_id = $idtotest
            ");
            $nbcontrole    = $querycontrol->num_rows;
            if ($nbcontrole > 0)
            {
              ?>
              scrollToAnchor('<?php echo $idgoto ?>');
              <?php
            }
          }
        }
         ?>
        function scrollToAnchor(e){
          // e.preventDefault();
        	var position = $("#"+e).offset().top;
          var position = position - 85 - 30;
        	$("body, html").animate({
        		scrollTop: position
        	}, 1100);

          setTimeout(function(){
            $("#"+e+" .personnage").css({
              "left" : "10px"
            },100)
            setTimeout(function(){
              $("#"+e+" .personnage").css({
                "left" : "-10px"
              },100)
              setTimeout(function(){
                $("#"+e+" .personnage").css({
                  "left" : "0"
                },100)
                setTimeout(function(){
                  $("#"+e+" .personnage").css({
                    "left" : "10px"
                  },100)
                  setTimeout(function(){
                    $("#"+e+" .personnage").css({
                      "left" : "-10px"
                    },100)
                    setTimeout(function(){
                      $("#"+e+" .personnage").css({
                        "left" : "0"
                      },100)
                    },100)
                  },100)
                },100)
              },200)
            },200)
          },800)
        }

        $(".rondgroupecouleur").mouseover(function(){
          var id      = $(this).attr("data-couleurid");
          var couleur = $(this).css("background-color");

          $(".enteteperso"+id).css({
            "background-color": couleur
          });
        });
        $(".morecontent").click(function(){
          var personnage = $(this).attr("data-id");
          var hauteur = $(".pop"+personnage).css('top');

          // if ( personnage == "134" || personnage == "135" )
          // {
          //   $("#id"+personnage).css({
          //     position:"relative",
          //     top:"-30px",
          //     transform:"rotate(180deg)"
          //   })
          // }
          if (hauteur == "0px")
          {
            $(".popmore"+personnage).css({
              display : "block"
            });
            $(".pop"+personnage).animate({
              top : "-100%"
            });
            $(".popmore"+personnage).animate({
              top : "-190px"
            },450);
            $(".tiret"+personnage).animate({
              top : "250px"
            });
            $(".tiret"+personnage).css({
              transform : "rotate(0)"
            });
            $(".modifie"+personnage).animate({
              top : "128px"
            });
          }
          else
          {
            $(".pop"+personnage).animate({
              top : "0"
            });
            $(".popmore"+personnage).animate({
              top : "0"
            },300);
            $(".tiret"+personnage).animate({
              top : "202px"
            });
            $(".tiret"+personnage).css({
              transform : "rotate(180deg)"
            });
            $(".modifie"+personnage).animate({
              top : "75px"
            });
          }
        });

//        $(".footer").mouseenter(function(){
//          var heightScreen = $(window).height();
//          var result = heightScreen-85;
//          var result = result+"px";
//          $(".footer").css({
//            'height': result
//          });
//        });
//        $(".footer").mouseleave(function(){
//          $(".footer").css({
//            'height': '25px'
//          });
//        });
      })
    </script>
  </body>
</html>
