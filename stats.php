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
    <script type="text/javascript" src="js/Chart.bundle.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stats.css">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/navigation-phone.css">

  </head>
  <body>
    <?php
      include("navigation.php");
      include("navigation-phone.php");
    ?>
    <div class="entete">
      <h1><?php echo $langage_home['stats_h2'][$user_langue]; ?></h1>
    </div>
    <div class="col-xs-12 general">
      <div class="row">

        <div class="col-graph col-xs-12 col-md-4">
          <h2><?php echo $language_stat["stat_perso"][$user_langue] ?></h2>
          <div class="row">
            <div class="col-xs-4">
              <i class="iconejs fa fa-user" aria-hidden="true"></i>
            </div>
            <div class="col-xs-8">
              <p class="nombrejs nombreperso">0</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <i class="iconejs fa fa-bookmark" aria-hidden="true"></i>
            </div>
            <div class="col-xs-8">
              <p class="nombrejs nombrechapitre">0</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <i class="iconejs fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="col-xs-8">
              <p class="nombrejs nombregroupe">0</p>
            </div>
          </div>


        </div>

        <div class="col-graph col-xs-12 col-md-4">
          <h2><?php echo $language_stat["stat_genre"][$user_langue] ?></h2>
          <div class="row">
            <div class="col-xs-12 col-md-7">
              <canvas class="donuts" id="stats-genre" width="400" height="400"></canvas>
            </div>
            <div class="col-xs-12 col-md-5">
              <ul>
                <?php
                  $query = $mysqli->query("SELECT * FROM perso WHERE perso_visibilite = 0 AND perso.perso_actif = 1 AND perso.perso_visibilite = 0");
                  $nb = $query->num_rows;
                  $homme = 0;
                  $femme = 0;
                  $autre = 0;

                  $nombreperso = $nb;

                  if ($nb > 0)
                  {
                    while($row = $query->fetch_array())
                    {
                      if ($row["perso_genre"] == "1")
                      {
                        $femme++;
                      }
                      else if($row["perso_genre"] == "0")
                      {
                        $homme++;
                      }
                      else
                      {
                        $autre++;
                      }
                    }
                  }
                  $genre_total       = $femme+$homme+$autre;
                  $pourcentage_homme = $homme/$genre_total*100;
                  $pourcentage_femme = $femme/$genre_total*100;
                  $pourcentage_autre = $autre/$genre_total*100;
                ?>
                <li><div class="carrecouleur" style="background-color: #2196F3;"></div><p><?php echo $language_stat["stat_homme"][$user_langue]." : ".$homme." (".round($pourcentage_homme)." %) " ?></p></li>
                <li><div class="carrecouleur" style="background-color: #E91E63;"></div><p><?php echo $language_stat["stat_femme"][$user_langue]." : ".$femme." (".round($pourcentage_femme)." %) " ?></p></li>
                <li><div class="carrecouleur" style="background-color: lightgrey;"></div><p><?php echo $language_stat["stat_inconnu"][$user_langue]." : ".$autre." (".round($pourcentage_autre)." %) " ?></p></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-graph col-xs-12 col-md-4">
          <h2><?php echo $language_stat["stat_nature"][$user_langue] ?></h2>
          <div class="row">
            <div class="col-xs-12 col-md-7">
              <canvas class="donuts" id="stats-nature" width="400" height="400"></canvas>
            </div>
            <div class="col-xs-12 col-md-5">
              <ul>
                <?php
                $query = $mysqli->query("SELECT perso_nature FROM perso WHERE perso_visibilite = 0 AND perso.perso_actif = 1");
                $nb = $query->num_rows;
                $humain = 0;
                $goule = 0;
                $autrenature = 0;

                if ($nb > 0)
                {
                  while($row = $query->fetch_array())
                  {
                    if ($row["perso_nature"] == "1")
                    {
                      $goule++;
                    }
                    else if($row["perso_nature"] == "0")
                    {
                      $humain++;
                    }
                    else
                    {
                      $autrenature++;
                    }
                  }
                }
                $nature_total             = $humain+$goule+$autrenature;
                $pourcentage_humain       = $humain/$genre_total*100;
                $pourcentage_goule        = $goule/$genre_total*100;
                $pourcentage_autre_nature = $autrenature/$genre_total*100;
                ?>
                <li><div class="carrecouleur" style="background-color: #2196F3;"></div><p><?php echo $language_stat["stat_humain"][$user_langue]." : ".$humain." (".round($pourcentage_humain)." %) " ?></p></li>
                <li><div class="carrecouleur" style="background-color: #E91E63;"></div><p><?php echo $language_stat["stat_goule"][$user_langue]." : ".$goule." (".round($pourcentage_goule)." %) " ?></p></li>
                <li><div class="carrecouleur" style="background-color: lightgrey;"></div><p><?php echo $language_stat["stat_inconnu"][$user_langue]." : ".$autrenature." (".round($pourcentage_autre_nature)." %) " ?></p></li>
              </ul>
            </div>
          </div>
        </div>

        <?php
        $query = $mysqli->query("SELECT * FROM chapitre ");
        $nb = $query->num_rows;
        $nombrechapitre = $nb;
        ?>

        <div class="col-graph col-xs-12 col-md-4">
          <h2><?php echo $language_stat["stat_groupe"][$user_langue] ?></h2>
          <div class="row">
            <div class="col-xs-12 col-md-7">
              <canvas class="donuts" id="stats-groupe" width="400" height="400"></canvas>
            </div>
            <div class="col-xs-12 col-md-5">
              <ul>
                <?php
                $query = $mysqli->query("SELECT * FROM groupe ");
                $nb    = $query->num_rows;
                $nombregroupe =  $nb;

                if ($nb > 0)
                {
                  $groupenamelist  = [];
                  $groupecolorlist = [];
                  $groupeidlist    = [];
                  $nombregroupelist["nombre"] = [];
                  $nombregroupelist["stats"]  = [];
                  $totalpourcentgroupe = 0;
                  $totalassigne = 0;
                  while($row = $query->fetch_array())
                  {
                    $query2   = $mysqli->query("SELECT *
                                                      FROM perso_groupe
                                                      LEFT JOIN perso
                                                        ON perso.perso_id = perso_groupe.perso_id
                                                      WHERE perso.perso_visibilite = 0
                                                        AND perso.perso_actif = 1
                                                      GROUP BY perso_groupe.perso_id");
                    $nb2      = $query2->num_rows;

                    $persoavecgroupe = $nb2;

                    $idgroupe = $row["groupe_id"];
                    $query2   = $mysqli->query("SELECT *
                                                      FROM perso_groupe
                                                      LEFT JOIN perso
                                                        ON perso.perso_id = perso_groupe.perso_id
                                                      WHERE perso_groupe.groupe_id = $idgroupe
                                                        AND perso.perso_visibilite = 0
                                                        AND perso.perso_actif = 1");

                    $nb2                 = $query2->num_rows;

                    $statgroupe          = $nb2/$nombreperso*100;
                    $totalpourcentgroupe = $totalpourcentgroupe + round($statgroupe);
                    $totalassigne        = $totalassigne + $nb2;

                    array_push($nombregroupelist["nombre"],$nb2);

                    if ($user_langue == "fr")
                    {
                      $goupename = $row["groupe_nom_fr"];
                    }
                    else
                    {
                      $goupename = $row["groupe_nom_jp"];
                      if($goupename == "")
                      {
                        $goupename = $row["groupe_nom_fr"];
                      }
                    }
                    array_push($groupenamelist,$goupename);

                    $color = $row["groupe_couleur"];
                    array_push($groupecolorlist,$color);

                    echo "<li>";
                      echo "<div class=\"carrecouleur\" style=\"background-color: ".$color.";\">";
                      echo "</div>";
                      echo "<p>";
                        echo $goupename." : ".$nb2;
                      echo "</p>";
                    echo "</li>";
                  }
                  $totalpourcentgroupe = 100 - $totalpourcentgroupe;
                  $persosansgroupe = $nombreperso - $persoavecgroupe;

                  array_push($nombregroupelist["nombre"],$persosansgroupe);
                  array_push($groupenamelist,$langage_perso["creation_inconnu"][$user_langue]);
                  array_push($groupecolorlist,"rgb(212, 212, 212)");
                  echo "<li>";
                    echo "<div class=\"carrecouleur\" style=\"background-color: rgb(212, 212, 212);\">";
                    echo "</div>";
                    echo "<p>";
                     echo $langage_perso["creation_inconnu"][$user_langue]." : ".$persosansgroupe;
                    echo "</p>";
                  echo "</li>";

                }
                ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-graph col-xs-12 col-md-4">
          <h2><?php echo $language_stat["stat_kagune"][$user_langue] ?></h2>
          <div class="row">
            <div class="col-xs-12 col-md-7">
              <canvas class="donuts" id="stats-kagune" width="400" height="400"></canvas>
            </div>
            <div class="col-xs-12 col-md-5">
              <ul>
                <?php

                $query = $mysqli->query("SELECT * FROM type ");
                $nb    = $query->num_rows;
//                $nombregroupe =  $nb;

                if ($nb > 0)
                {
                  $stockagenameka = [];
                  $stockagekagune = [];
                  $couleurkagune  = [
                    "#1E88E5",
                    "#5E35B1",
                    "#43A047",
                    "#FB8C00",
                    "#F4511E"
                  ];
                  $b = 0;
                  while($row = $query->fetch_array())
                  {
                    $tempo = array(
                            'kagune'=>array('fr'=>$row["type_type_fr"],
                                            'jp'=>$row["type_type_jp"]),
                    );
                    $idtype = $row["type_id"];
                    $query2   = $mysqli->query("
                      SELECT *
                      FROM perso
                      RIGHT JOIN kagune_type
                        ON kagune_type.kagune_id = perso.kagune_id
                      WHERE perso.perso_visibilite = 0
                       AND perso.perso_actif = 1
                      GROUP BY perso.perso_id
                    ");
                    $nb = $query2->num_rows;
                    $nombrepersonnageavec = $nb;

                    $query2   = $mysqli->query("
                      SELECT perso_id
                      FROM perso
                      WHERE perso_nature = 1
                       AND perso.perso_actif = 1
                       AND perso.perso_visibilite = 0
                    ");
                    $nb = $query2->num_rows;
                    $toutpersogoule = $nb;

                    $inconnukagune = $toutpersogoule - $nombrepersonnageavec;

                    $query2   = $mysqli->query("
                     SELECT *
                     FROM perso
                     RIGHT JOIN kagune_type
                     ON kagune_type.kagune_id = perso.kagune_id
                     WHERE perso.perso_visibilite = 0
                      AND perso.perso_actif = 1
                      AND type_id = $idtype
                    ");
                    $nb = $query2->num_rows;

                    array_push($stockagekagune,$nb);
                    array_push($stockagenameka,$tempo["kagune"][$user_langue]);

                    echo "<li>";
                      echo "<div class=\"carrecouleur\" style=\"background-color: ".$couleurkagune[$b].";\">";
                      echo "</div>";
                      echo "<p>";
                        echo $tempo["kagune"][$user_langue]." : ".$nb;
                      echo "</p>";
                    echo "</li>";
                    $b++;
                  }
                  echo "<li>";
                    echo "<div class=\"carrecouleur\" style=\"background-color: rgb(212, 212, 212);\">";
                    echo "</div>";
                    echo "<p>";
                      echo $langage_perso["creation_inconnu"][$user_langue]." : ".$inconnukagune;
                    echo "</p>";
                  echo "</li>";
                  array_push($stockagekagune,$inconnukagune);
                  array_push($stockagenameka,$langage_perso["creation_inconnu"][$user_langue]);
                }
                ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-graph col-xs-12 col-md-4">
          <h2><?php echo $language_stat["stat_attribut"][$user_langue] ?></h2>
          <div class="row">
            <div class="col-xs-12 col-md-7">
              <canvas class="donuts" id="stats-attribut" width="400" height="400"></canvas>
            </div>
            <div class="col-xs-12 col-md-5">
              <ul>
                <?php

                $colorset = [
                    "#1E88E5",
                    "#5E35B1",
                    "#43A047",
                    "#FB8C00",
                    "#F4511E",
                    "#00897B",
                    "#D81B60",
                    "#00ACC1",
                    "#C0CA33",
                    "#6D4C41"
                ];
                $statstempo = [
                    'creation_force'                =>array('fr'=>"Force",                           'jp'=>"力"),
                    'creation_faim'                 =>array('fr'=>"Faim / Mental",                   'jp'=>"飢餓の抵抗 / 心的"),
//                    'creation_mental'               =>array('fr'=>"Mental",                          'jp'=>"心的"),
                    'creation_courage'              =>array('fr'=>"Courage",                         'jp'=>"勇気"),
                    'creation_charisme'             =>array('fr'=>"Charisme",                        'jp'=>"カリスマ"),
                    'creation_eloquence'            =>array('fr'=>"Éloquence",                       'jp'=>"雄弁"),
                    'creation_intelligence'         =>array('fr'=>"Intelligence",                    'jp'=>"知性"),
                    'creation_culture'              =>array('fr'=>"Culture",                         'jp'=>"一般教養"),
                    'creation_dexterite'            =>array('fr'=>"Dextérité",                       'jp'=>"熟練"),
                    'creation_agilite'              =>array('fr'=>"Agilité",                         'jp'=>"素早さ"),
                    'creation_vitalite'             =>array('fr'=>"Vitalité",                        'jp'=>"体"),
                ];

                $query = $mysqli->query("SELECT * FROM perso WHERE perso_visibilite = 0 AND perso.perso_actif = 1 ");
                $nb    = $query->num_rows;

                if ($nb > 0)
                {
                  $statstemponame['force']=[];
                  $statstemponame['faim']=[];
                  $statstemponame['courage']=[];
                  $statstemponame['charisme']=[];
                  $statstemponame['eloquence']=[];
                  $statstemponame['intelligence']=[];
                  $statstemponame['culture']=[];
                  $statstemponame['dexterite']=[];
                  $statstemponame['agilite']=[];
                  $statstemponame['vitalite']=[];
                  while($row = $query->fetch_array())
                  {
                    if ($row["perso_force"]        != "0") array_push($statstemponame['force'],       $row["perso_force"]);
                    if ($row["perso_faim"]         != "0") array_push($statstemponame['faim'],        $row["perso_faim"]);
                    if ($row["perso_courage"]      != "0") array_push($statstemponame['courage'],     $row["perso_courage"]);
                    if ($row["perso_charisme"]     != "0") array_push($statstemponame['charisme'],    $row["perso_charisme"]);
                    if ($row["perso_eloquence"]    != "0") array_push($statstemponame['eloquence'],   $row["perso_eloquence"]);
                    if ($row["perso_intelligence"] != "0") array_push($statstemponame['intelligence'],$row["perso_intelligence"]);
                    if ($row["perso_culture"]      != "0") array_push($statstemponame['culture'],     $row["perso_culture"]);
                    if ($row["perso_dexterite"]    != "0") array_push($statstemponame['dexterite'],   $row["perso_dexterite"]);
                    if ($row["perso_agilite"]      != "0") array_push($statstemponame['agilite'],     $row["perso_agilite"]);
                    if ($row["perso_vitalite"]     != "0") array_push($statstemponame['vitalite'],    $row["perso_vitalite"]);
                  }
                }

                $totalattribut = [];

                foreach ($statstemponame AS $key => $value)
                {
                  $count         = count($statstemponame[$key]);
                  $totalcompteur = array_sum($statstemponame[$key]);
                  $moyennestats  = $totalcompteur/$count;
                  array_push($totalattribut,round($moyennestats));
                }
                $c = 0;
                foreach ($statstempo AS $key => $value)
                {
                  echo "<li>";
                    echo "<div class=\"carrecouleur\" style=\"background-color: ".$colorset[$c].";\">";
                    echo "</div>";
                    echo "<p>";
                      echo $value[$user_langue]." : ".$totalattribut[$c];
                    echo "</p>";
                  echo "</li>";
                  $c++;
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <script>
        new Chart(document.getElementById("stats-genre"), {
          type: 'doughnut',
          data: {
            labels: ["<?php echo $language_stat["stat_homme"][$user_langue] ?>", "<?php echo $language_stat["stat_femme"][$user_langue] ?>", "<?php echo $language_stat["stat_inconnu"][$user_langue] ?>"],
            datasets: [
              {
                // label: "",
                backgroundColor: ["#2196F3", "#E91E63", "lightgrey"],
                data: ["<?php echo $homme ?>","<?php echo $femme ?>","<?php echo $autre ?>"],
                borderColor: 'rgb(237, 237, 237)'
              }
            ]
          },
          options: {
            title: {
              display: true,
              // text: '',
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true
            }
          }
        });

        new Chart(document.getElementById("stats-nature"), {
          type: 'doughnut',
          data: {
            labels: ["<?php echo $language_stat["stat_humain"][$user_langue] ?>", "<?php echo $language_stat["stat_goule"][$user_langue] ?>", "<?php echo $language_stat["stat_inconnu"][$user_langue] ?>"],
            datasets: [
              {
                // label: "",
                backgroundColor: ["#2196F3", "#E91E63", "lightgrey"],
                data: ["<?php echo $humain ?>","<?php echo $goule ?>","<?php echo $autrenature ?>"],
                borderColor: 'rgb(237, 237, 237)'
              }
            ]
          },
          options: {
            title: {
              display: true,
              // text: '',
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true
            }
          }
        });

        new Chart(document.getElementById("stats-groupe"), {
          type: 'doughnut',
          data: {
            <?php
                echo "labels : [";
                  foreach ($groupenamelist as $key => $value)
                  {
                    echo "\"".$value."\",";
                  }
                echo "],";
                ?>
            datasets: [
              {
                // label: "",
                <?php
                  echo "backgroundColor : [";
                    foreach ($groupecolorlist as $key => $value)
                    {
                      echo "\"".$value."\",";
                    }
                  echo "],";
                ?>
                <?php
                echo "data : [";
                  foreach ($nombregroupelist["nombre"] as $key => $value)
                  {
                    echo "\"".$value."\",";
                  }
                echo "],";
                ?>
                borderColor: 'rgb(237, 237, 237)'
              }
            ]
          },
          options: {
            title: {
              display: true,
              // text: '',
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true
            }
          }
        });

        new Chart(document.getElementById("stats-kagune"), {
          type: 'doughnut',
          data: {
            <?php
            echo "labels : [";
            foreach ($stockagenameka as $key => $value)
            {
              echo "\"".$value."\",";
            }
            echo "],";
            ?>
            datasets: [
              {
                // label: "",
                <?php
                echo "backgroundColor : [";
                foreach ($couleurkagune as $key => $value)
                {
                  echo "\"".$value."\",";
                }
                echo "],";
                ?>

                <?php
                echo "data : [";
                foreach ($stockagekagune as $key => $value)
                {
                  echo "\"".$value."\",";
                }
                echo "],";
                ?>
                borderColor: 'rgb(237, 237, 237)'
              }
            ]
          },
          options: {
            title: {
              display: true,
              // text: '',
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true
            }
          }
        });

        new Chart(document.getElementById("stats-attribut"), {
          type: 'doughnut',
          data: {
            <?php
            echo "labels : [";
            foreach ($statstempo as $key => $value)
            {
              echo "\"".$statstempo[$key][$user_langue]."\",";
            }
            echo "],";
            ?>
            datasets: [
              {
                // label: "",
                <?php
                echo "backgroundColor : [";
                foreach ($colorset as $key => $value)
                {
                  echo "\"".$value."\",";
                }
                echo "],";
                ?>

                <?php
                echo "data : [";
                foreach ($totalattribut as $key => $value)
                {
                  echo "\"".$value."\",";
                }
                echo "],";
                ?>
                borderColor: 'rgb(237, 237, 237)'
              }
            ]
          },
          options: {
            title: {
              display: true,
              // text: '',
            },
            legend: {
              display: false
            },
            tooltips: {
              enabled: true
            }
          }
        });


      </script>

    </div>
    <!-- <div class="footer">
      <i class="fa fa-bars teuteu" aria-hidden="true"></i>
    </div> -->
    <script type="text/javascript">
      $(document).ready(function(){
        bougechiffre(".nombreperso","<?php echo $nombreperso ?>");
        bougechiffre(".nombregroupe","<?php echo $nombregroupe ?>");
        bougechiffre(".nombrechapitre","<?php echo $nombrechapitre ?>");


        function bougechiffre(div,nombre){
          var cal         = $(div).html();
          var resultatPre = parseInt(cal);
          $(div).html(nombre);

          $(div).each(function () {
            var $this = $(this);
            jQuery({ Counter: resultatPre }).animate({ Counter: $this.text() }, {
              duration: 1000,
              easing: 'swing',
              step: function (i) {
                $this.text(Math.ceil(i));
              }
            });
          });
        }


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
