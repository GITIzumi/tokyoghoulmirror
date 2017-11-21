<?php
session_start();
include("_connected.php");
include_once("langue.php");
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
    <link rel="stylesheet" href="css/chapitre.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">
  </head>
  <body>
  <?php
    include("navigation.php");
    include("navigation-phone.php");
  ?>
    <div class="entete">
      <h1><?php echo $langage_home['chapitre_h2'][$user_langue]; ?></h1>
    </div>
    <div class="container general">
      <div class="col-xs-12">
          <a href="chapitre-creation.php">
            <div class="row add-chapitre chapitre0">
                <p><i class="fa fa-plus" aria-hidden="true"></i><?php echo $language_chapitre['chapitre_add'][$user_langue]; ?></p>
            </div>
          </a>
          <?php
            $query = $mysqli->query("SELECT * FROM chapitre ORDER BY chapitre_numero_fr DESC");
            $nb    = $query->num_rows;
            if ($nb > 0)
            {
              $i = 1;
              while($row = $query->fetch_array())
              {
                $text = array(
                  'id'                => $row["chapitre_id"],

                  'titre'             => array(	'fr' => $row["chapitre_titre_fr"],
                                                'jp' => $row["chapitre_titre_jp"]),

                  'resume'            => array(	'fr' => $row["chapitre_resume_fr"],
                                                'jp' => $row["chapitre_resume_jp"]),

                  'numero'            => array(	'fr' => $row["chapitre_numero_fr"],
                                                'jp' => $row["chapitre_numero_jp"]),

                  'chapitre'          => array(	'fr' => "Chapitre",
                                                'jp' => "章"),

                  'erreur_resume'     => array(	'fr' => "Le résumé n'est pas encore rédigé.",
                                                'jp' => "要約はまだ著されない"),

                  'erreur_personnage' => array(	'fr' => "Aucuns personnages ajouté à ce chapitre.",
                                                'jp' => "キャラクターはこの章にまだ足されない"),

                  'spinoff'           => array(	'fr' => "Spin-off",
                                                'jp' => "スピンオフ"),
                  );
                echo "<div class=\"row item-chapitre chapitre".$i."\">";
                  echo "<div class=\"col-xs-10\">";
                    echo "<h2 class=\"titre\">";
                    if ($text["numero"]["fr"] > 0)
                    {
                      if ($user_langue == "fr")
                      {
                        echo "<a href=\"".$row["chapitre_link"]."\" title=\"\" target=\"_blank\">".$text["chapitre"][$user_langue]." ".$text["numero"][$user_langue]." : ".$text["titre"][$user_langue]."</a>";
                      }
                      else
                      {
                        if (empty($text["titre"][$user_langue]) OR empty($text["numero"][$user_langue]))
                        {
                          echo "<a href=\"".$row["chapitre_link"]."\" title=\"\" target=\"_blank\">".$text["chapitre"]["fr"]." ".$text["numero"]["fr"]." : ".$text["titre"]["fr"]."</a>";
                        }
                        else
                        {
                          echo "<a href=\"".$row["chapitre_link"]."\" title=\"\" target=\"_blank\">第 ".$text["numero"][$user_langue]." ".$text["chapitre"][$user_langue]."  : ".$text["titre"][$user_langue]."</a>";
                        }
                      }
                    }
                    else
                    {
                      echo "<a href=\"".$row["chapitre_link"]."\" title=\"\" target=\"_blank\">".$text["spinoff"][$user_langue].": ".$text["titre"][$user_langue]."</a>";
                    }
                    echo "</h2>";
                  echo "</div>";
                  echo "<div class=\"col-xs-2\">";
                    echo "<a title=\"".$language_chapitre['chapitre_resume'][$user_langue]."\" href=\"Javascript:void(0);\" data-chapitre=\"".$i."\" class=\"btn-chapitre-lg\"><i class=\"fa fa-angle-down angleswitch".$i." modif\" aria-hidden=\"true\"></i></a>";
                  echo "</div>";
                  echo "<div class=\"col-xs-12 perso-content content".$i."\">";
                    echo "<hr>";

                    if (empty($text["resume"][$user_langue]))
                    {
                      if (empty($text["resume"]["fr"]))
                      {
                        echo "<p class=\"pastrouve\">".$text["erreur_resume"][$user_langue]."</p>";
                      }
                      else
                      {
                        echo "<p class=\"resume\">".$text["resume"]["fr"]."</p>";
                      }
                    }
                    else
                    {
                      echo "<p class=\"resume\">".$text["resume"][$user_langue]."</p>";
                    }

                    $idchapitre = $text['id'];
                    $query2 = $mysqli->query("
                      SELECT *
                      FROM chapitre_perso
                      INNER JOIN perso
                      ON perso.perso_id = chapitre_perso.perso_id
                      WHERE chapitre_id = $idchapitre
                      ORDER BY perso_nom_fr
                    ");
                    $nb2    = $query2->num_rows;
                    if ($nb2 > 0)
                    {
                      while($row2 = $query2->fetch_array())
                      {
                        $persoid = $row2["perso_id"];
                        $query3  = $mysqli->query("SELECT *
                          FROM perso
                          WHERE perso_id = $persoid
                           AND perso_actif = 1
                           AND perso_visibilite = 0
                        ");
                        $nb3     = $query3->num_rows;
                        $row3    = $query3->fetch_array();
                        $textperso = array(
                          'id'      => $row3["perso_id"],
                          'img'     => $row3["perso_image"],
                          'prenom'  => array(	'fr' => $row3["perso_prenom_fr"],
                                              'jp' => $row3["perso_prenom_jp"]),
                          'nom'     => array(	'fr' => $row3["perso_nom_fr"],
                                              'jp' => $row3["perso_nom_jp"]),
                          'surnom'  => array(	'fr' => $row3["perso_surnom_fr"],
                                              'jp' => $row3["perso_surnom_jp"]),
                        );
                        echo "<a href=\"mozaique.php\">";
                          echo "<div class=\"personnage actifperso\">";
                            echo "<div class=\"rond-img\" style=\"background-image: url(img/persos/".$textperso["img"].");\"></div>";
                            if (empty($textperso["nom"][$user_langue]))
                            {
                              echo "<p class=\"nom\">".$textperso["nom"]['fr']."</p>";
                            }else{
                              echo "<p class=\"nom\">".$textperso["nom"][$user_langue]."</p>";
                            }
                            if (empty($textperso["prenom"][$user_langue]))
                            {
                              echo "<p class=\"prenom\">".$textperso["prenom"]['fr']."</p>";
                            }else{
                              echo "<p class=\"prenom\">".$textperso["prenom"][$user_langue]."</p>";
                            }
                            if (empty($textperso["surnom"][$user_langue])) {
                              echo "<p class=\"surnom\">".$textperso["surnom"]['fr']."</p>";
                            }else{
                              echo "<p class=\"surnom\">".$textperso["surnom"][$user_langue]."</p>";
                            }
                          echo "</div>";
                        echo "</a>";
                      }
                    }
                    else
                    {
                      echo "<p class=\"pastrouve\">".$text["erreur_personnage"][$user_langue]."</p>";
                    }
                    echo "<div class=\"col-xs-12\">";
                      echo "<a title=\"".$language_chapitre['chapitre_modif'][$user_langue]."\" href=\"chapitre-modification.php?chapitre=".$row["chapitre_id"]."\">";
                        echo "<i class=\"fa fa-pencil modif \" style='margin-bottom: 5px;padding-bottom: 10px' aria-hidden=\"true\"></i>";
                      echo "</a>";
                    echo "</div>";
                  echo "</div>";
                echo "</div>";
                $i++;
              }
            }
           ?>
      </div>
    </div>
    <!-- <div class="footer">
      <i class="fa fa-bars teuteu" aria-hidden="true"></i>
    </div> -->
    <script type="text/javascript">
      $(document).ready(function(){
        $(".btn-chapitre-lg").click(function(){
          var numeroChap = $(this).data("chapitre");
          var etatangle  = $(".content"+numeroChap).css("display");
          if (etatangle  == "none")
          {
            $(".angleswitch"+numeroChap).removeClass("fa-angle-down").addClass("fa-angle-up");
            $(".content"+numeroChap).slideToggle();
          }
          else
          {
            $(".angleswitch"+numeroChap).addClass("fa-angle-down").removeClass("fa-angle-up");
            $(".content"+numeroChap).slideToggle();
          }
        });
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
