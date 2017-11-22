<?php
session_start();
//ini_set('display_errors','on');
// error_reporting(E_ALL);
include("_connected.php");
include_once("langue.php");
$monUrl = $_SERVER['REQUEST_URI'];
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
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <div class="col-xs-12 general">
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <div class="row">
            <div class="col-md-6 top-buffer">
              <a href="mozaique.php">
                <div class="perso">
                  <h2><?php echo $langage_home['personnage_h2'][$user_langue]; ?></h2>
                  <i class="fa fa-user-circle" aria-hidden="true"></i>
                </div>
              </a>
            </div>
            <div class="col-md-6">
              <div class="row top-buffer">
                <div class="col-xs-12">
                  <a href="groupe.php">
                    <div class="groupe">
                      <h2><?php echo $langage_home['groupe_h2'][$user_langue]; ?></h2>
                      <i class="fa fa-sitemap" aria-hidden="true"></i>
                    </div>
                  </a>
                </div>
              </div>
              <div class="row top-buffer">
                <div class="col-xs-12">
                  <a href="stats">
                    <div class="stats">
                      <h2><?php echo $langage_home['stats_h2'][$user_langue]; ?></h2>
                      <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="row ">
            <div class="col-lg-6 col-md-6 top-buffer">
              <a href="traitement-langue.php?url=<?php echo $monUrl ?>" title="<?php echo $langage_home['langue_h2'][$user_langue]; ?>">
                <div class="langue">
                  <h2><?php echo $langage_home['langue_h2'][$user_langue]; ?></h2>
                  <i class="fa fa-language"  aria-hidden="true"></i>
                </div>
              </a>
            </div>
            <div class="col-lg-6 col-md-6 top-buffer">
              <a href="_logout.php" title="<?php echo $langage_home['deconnexion_title'][$user_langue]; ?>">
                <div class="deco">
                  <h2><?php echo $langage_home['deconnexion_h2'][$user_langue]; ?></h2>
                  <i class="fa fa-sign-out" aria-hidden="true"></i>
                </div>
              </a>
            </div>
          </div>
          <div class="row top-buffer">
            <div class="col-lg-12 col-md-12">
              <a href="galerie.php">
                <div class="galerie" >
                  <h2><?php echo $langage_home['galerie_h2'][$user_langue]; ?></h2>
                  <i class="fa fa-picture-o" aria-hidden="true"></i>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-3">
          <div class="row top-buffer">
            <div class="col-lg-12">
              <a href="home.php">
                <div class="titre">
                  <p>T O K Y O</p>
                  <p>G H O U L</p>
                  <p>M I R R O R</p>
                </div>
              </a>
            </div>
          </div>
          <div class="row top-buffer">
            <div class="col-lg-12">
              <div class="dice">
                <h2><?php echo $langage_home['lancede_h2'][$user_langue]; ?></h2>
                <p class="instruct"><?php echo $langage_home['lancede_p'][$user_langue]; ?></p>
                <div class="row">
                  <div class="col-xs-12 diceflip">
                    <i class="fa fa-random" title="<?php echo $langage_home['lancede_title'][$user_langue]; ?>" aria-hidden="true"></i>
                  </div>
                  <div class="col-xs-0 diceflip1" style="display:none">
                    <p class="result">0</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 top-buffer">
          <div class="defil">
            <h2><?php echo $langage_home['defilement_h2'][$user_langue]; ?></h2>
            <div class="defil-content col-xs-12">
              <?php
              $query = $mysqli->query("SELECT * FROM perso WHERE perso_actif = 1 AND perso_visibilite = 0 ORDER BY RAND()");
              $nb    = $query->num_rows;
                if ($nb > 0)
                {
                  $tableaumagique = [];
                  while($row = $query->fetch_array())
                  {
                    array_push($tableaumagique, $row["perso_id"]);
                  }
                }
                $tiragefinal = [];
                $a = 0;

                while($a < 4)
                {
                  $randperso = array_rand($tableaumagique, 1);
                  $randperso = $tableaumagique[$randperso];
                  $query = $mysqli->query("SELECT * FROM perso WHERE perso_id = $randperso");
                  if ($nb > 0)
                  {
                    while($row = $query->fetch_array())
                    {
                      $visibiliteperso = $row["perso_visibilite"];
                      if($visibiliteperso > "0")
                      {

                      }
                      else
                      {
                        if(!in_array($randperso,$tiragefinal))
                        {
                          array_push($tiragefinal,$randperso);
                          $a++;
                        }
                      }
                    }
                  }
                }
                foreach ($tiragefinal as $key => $value)
                {
                  $query = $mysqli->query("SELECT * FROM perso WHERE perso_id = $value");
                  $nb    = $query->num_rows;
                  if ($nb > 0)
                  {
                    while($row = $query->fetch_array())
                    {
                      $text = array(
                          'prenom'  => array(	'fr' => $row["perso_prenom_fr"],
                                              'jp' => $row["perso_prenom_jp"]),

                          'nom'     => array(	'fr' => $row["perso_nom_fr"],
                                              'jp' => $row["perso_nom_jp"]),

                          'surnom'  => array(	'fr' => $row["perso_surnom_fr"],
                                              'jp' => $row["perso_surnom_jp"]),

                          'img'     => $row["perso_image"],

                          'id'      => $row["perso_id"]
                      );
                      echo "<a href=\"mozaique.php?idperso=id".$text["id"]."\">";
                      echo "<div class=\"row defil-item\">";
                      echo "<div class=\"col-xs-5\">";
                      echo "<div class=\"image\" style=\"background-image:url(img/persos/".$text["img"].")\">";
                      echo "</div>";
                      echo "</div>";
                      echo "<div class=\"col-xs-7\">";
                      if(empty($text["nom"][$user_langue])){
                        echo "<p class=\"name\">".$text["nom"]["fr"]."</p>";
                      }else{
                        echo "<p class=\"name\">".$text["nom"][$user_langue]."</p>";
                      }
                      if (empty($text["prenom"][$user_langue])) {
                        echo "<p class=\"firstname\">".$text["prenom"]["fr"]."</p>";
                      }else{
                        echo "<p class=\"firstname\">".$text["prenom"][$user_langue]."</p>";
                      }
                      if (empty($text["surnom"][$user_langue])) {
                        echo "<p class=\"surnom\">".$text["surnom"]["fr"]."</p>";
                      }else{
                        if ($text["surnom"][$user_langue] == "?") {
                          echo "";
                        }else{
                          echo "<p class=\"surnom\">".$text["surnom"][$user_langue]."</p>";
                        }
                      }
                      echo "</div>";
                      echo "</div>";
                      echo "</a>";
                    }
                  }
                }
              ?>
            </div>
          </div>
        </div>

        <div class="col-lg-8 col-md-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 top-buffer">
              <a href="chapitre.php">
                <div class="chapitre">
                  <h2><?php echo $langage_home['chapitre_h2'][$user_langue]; ?></h2>
                  <i class="fa fa-bookmark" aria-hidden="true"></i>
                </div>
              </a>
            </div>
            <div class="notipar col-lg-6 col-md-6 top-buffer">
              <div class="noti">
                <div class="notititre">
                  <h2><?php echo $langage_home['notification_h2'][$user_langue]; ?></h2>
                </div>
                <div class="noticontent">
                  <div class="notientete">
                    <div class="alerte row">
                      <div class="col-xs-12">
                        <p><?php echo $langage_home['notification_creation'][$user_langue]; ?> :  <input type="text" name="alertnumero" ><span class="alertvalide">Valider</span></p>
                      </div>
                    </div>
                    <?php
                    if ($user_id == 1)
                    {
                      echo "<div class=\"alerte row notificationupdate \">";
                      echo "<div class=\"col-xs-12\">";
                      echo "<p>".$langage_home['notification_update'][$user_langue]." :  <input type=\"text\" name=\"alertupdate\" ><span class=\"alertupdate\">Valider</span></p>";
                      echo "</div>";
                      echo "</div>";
                    }
                    ?>
                  </div>
                  <a href="javascript:void(0)" target="_blanck">
                    <div class="notif row boutoncreanot">
                      <div class="col-xs-12">
                        <div class="row">
                          <div class="col-xs-4">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                          </div>
                          <div class="col-xs-8 rightnoti">
                            <p><?php echo $langage_home["ajout_notif"][$user_langue]; ?></p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </a>
                  <div class="alertelive">
                  </div>
                    <?php
                    $query = $mysqli->query("SELECT * FROM notification ORDER BY notification_date DESC LIMIT 30 ");
                    $nb    = $query->num_rows;
                    if ($nb > 0)
                    {
                      while($row = $query->fetch_array())
                      {
                        $date            = $row["notification_date"];
                        $utilisateur     = $row["user_id"];
                        $chapitre        = $row["chapitre_id"];
                        $numero_action   = $row["notification_action"];
                        $notification_id = $row["notification_id"];
                        $perso           = $row["perso_id"];
                        $texteupdate=array(
                          'fr'=>"".$row["chapitre_id"]."",
                          'jp'=>"".$row["perso_id"].""
                        );
                        $query2 = $mysqli->query("SELECT * FROM user WHERE user_id = $utilisateur");
                        $nb2    = $query2->num_rows;
                        if ($nb2 == 1)
                        {
                          $row2        = $query2->fetch_array();
                          $utilisateur = $row2["user_prenom"];
                        }
                        if ($chapitre > 0)
                        {
                          if ($numero_action == 11 OR $numero_action == 12 OR $numero_action == 13)
                          {
                            $query3 = $mysqli->query("SELECT * FROM groupe WHERE groupe_id = $chapitre");
                            $nb3    = $query3->num_rows;
                            if ($nb3 == 1)
                            {
                              $row3              = $query3->fetch_array();
                              $groupe_tableau  = array(
                                  "nom" => array(
                                      "fr" => $row3["groupe_nom_fr"],
                                      "jp" => $row3["groupe_nom_jp"]
                                  ),
                              );
                            }
                          }
                          else
                          {
                            $query3 = $mysqli->query("SELECT * FROM chapitre WHERE chapitre_id = $chapitre");
                            $nb3    = $query3->num_rows;
                            if ($nb3 == 1)
                            {
                              $row3              = $query3->fetch_array();
                              $liendrive         = $row3["chapitre_link"];
                              $chapitre_tableau  = array(
                                  "titre" => array(
                                      "fr" => $row3["chapitre_titre_fr"],
                                      "jp" => $row3["chapitre_titre_jp"]
                                  ),
                                  "numero" => array(
                                      "fr" => $row3["chapitre_numero_fr"],
                                      "jp" => $row3["chapitre_numero_jp"]
                                  ),
                              );
                            }
                          }
                        }
                        if ($perso > 0)
                        {
                          $query3 = $mysqli->query("SELECT * FROM perso WHERE perso_id = $perso");
                          $nb3    = $query3->num_rows;
                          if ($nb3 == 1)
                          {
                            $row3              = $query3->fetch_array();
                            $liendrive         = "mozaique.php";
                            $perso_tableau  = array(
                                "prenom" => array(
                                    "fr" => $row3["perso_prenom_fr"],
                                    "jp" => $row3["perso_prenom_jp"]
                                ),
                                "nom" => array(
                                    "fr" => $row3["perso_nom_fr"],
                                    "jp" => $row3["perso_nom_jp"]
                                ),
                                "id" => $row["perso_id"]
                            );
                          }
                        }
                        if ($numero_action == 8)
                        {
                          echo "<a href=\"javascript:void(0)\" class=\"notificationclicupdate\" data-update=\"".$notification_id."\" target=\"_blanck\">";
                        }
                        elseif($numero_action == 1 || $numero_action == 2 || $numero_action == 9)
                        {
                          echo "<a href=\"mozaique.php?idperso=id".$perso_tableau["id"]."\">";
                        }
                        else
                        {
                          echo "<a href=\"".$liendrive."\" target=\"_blanck\">";
                        }
                          echo "<div class=\"notif row\">";
                            echo "<div class=\"col-xs-12\">";
                              echo "<div class=\"row\">";
                                echo "<div class=\"col-xs-4\">";
                                  if ($numero_action == 1 || $numero_action == 2 || $numero_action == 9)
                                  {
                                    echo "<i class=\"fa fa-user-circle-o notif-actif\" aria-hidden=\"true\"></i>";
                                  }
                                  else if ($numero_action == 7)
                                  {
                                    echo "<i class=\"fa fa-bookmark notif-actif\" aria-hidden=\"true\"></i>";
                                  }
                                  else if ($numero_action == 8)
                                  {
                                    echo "<i class=\"fa fa-wrench notif-actif\" aria-hidden=\"true\"></i>";
                                  }
                                  else if($numero_action == 11 OR $numero_action == 12 OR $numero_action == 13)
                                  {
                                    echo "<i class=\"fa fa-users notif-actif\" aria-hidden=\"true\"></i>";
                                  }
                                  else
                                  {
                                    echo "<i class=\"fa fa-book notif-actif\" aria-hidden=\"true\"></i>";
                                  }
                                  if($user_langue == "fr"){
                                    echo "<p class=\"jour\">".$semaine[date("N", $date)][$user_langue]."</p>";
                                    echo "<p class=\"jour2\">".date("j", $date)." ".$mois[date("n", $date)][$user_langue]."</p>";
                                  }
                                  if($user_langue == "jp"){
                                    echo "<p class=\"jour2\">".date("j", $date)."日 ".$mois[date("n", $date)][$user_langue]."</p>";
                                    echo "<p class=\"jour\">(".$semaine[date("N", $date)][$user_langue].")</p>";
                                  }
                                echo "</div>";
                                echo "<div class=\"col-xs-8 rightnoti\">";
                                  echo "<p class=\"prenom\">".$utilisateur."</p>";
                                  if ($numero_action == 1 OR $numero_action == 2 OR $numero_action == 9)
                                  {
                                    if (empty($perso_tableau["prenom"][$user_langue]) OR empty($perso_tableau["nom"][$user_langue]))
                                    {
                                      echo "<p>".$action[$numero_action]["fr"]." : ".$perso_tableau["nom"]["fr"]." ".$perso_tableau["prenom"]["fr"]."</p>";
                                    }
                                    else
                                    {
                                      echo "<p>".$action[$numero_action][$user_langue]." : ".$perso_tableau["nom"][$user_langue]." ".$perso_tableau["prenom"][$user_langue]."</p>";
                                    }
                                  }
                                  elseif($numero_action == 3 OR $numero_action == 4)
                                  {
                                    if (empty($chapitre_tableau["titre"][$user_langue]) OR empty($chapitre_tableau["numero"][$user_langue]))
                                    {
                                      echo "<p>".$action[$numero_action]["fr"]." ".$chapitre_tableau["numero"]["fr"]." : ".$chapitre_tableau["titre"]["fr"]."</p>";
                                    }
                                    else
                                    {
                                      echo "<p>".$action[$numero_action][$user_langue]." ".$chapitre_tableau["numero"][$user_langue]." : ".$chapitre_tableau["titre"][$user_langue]."</p>";
                                    }
                                  }
                                  else if($numero_action == 7)
                                  {
                                    echo "<p>".$action[$numero_action][$user_langue]." ".$chapitre_tableau["numero"][$user_langue]." : ".$chapitre_tableau["titre"][$user_langue]."</p>";
                                  }
                                  else if($numero_action == 8)
                                  {
                                    echo "<p>".$action[$numero_action][$user_langue]." : ".$texteupdate["fr"]."</p>";
                                  }
                                  else if($numero_action == 11 OR $numero_action == 12 OR $numero_action == 13)
                                  {
                                    if (empty($groupe_tableau["nom"][$user_langue]))
                                    {
                                      echo "<p>".$action[$numero_action]["fr"]." : ".$groupe_tableau["nom"]["fr"]."</p>";
                                    }
                                    else
                                    {
                                      echo "<p>".$action[$numero_action][$user_langue]." : ".$groupe_tableau["nom"][$user_langue]."</p>";
                                    }
                                  }
                                  else
                                  {
                                    echo "<p>".$action[$numero_action][$user_langue]." : ".$chapitre_tableau["titre"][$user_langue]."</p>";
                                  }
                                echo "</div>";
                              echo "</div>";
                            echo "</div>";
                          echo "</div>";
                        echo "</a>";
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  <div class="popupupdate">
      </div>
    <script type="text/javascript">
      $(document).ready(function(){
        /* MENU DE NOTIFICATION */
        $(document).on('click', '.crossupdate', function() {
          $(".popupupdate").fadeOut();
        });
        $(".boutoncreanot").click(function(){
          $(".boutoncreanot").hide();
          $(".notientete").show();
        });
        $(".notificationclicupdate").click(function(){
          $(".popupupdate").fadeIn();
          var notifId = $(this).attr('data-update');
          query = $.ajax({
              type:"POST",
              url:"traitement-notification.php",
              data:"notif="+notifId,
              success: function(data){
                $('<div>', {
                  class: 'popupupdate'
                }).appendTo('.noticontent');
                $(".popupupdate").html(data);
              }
          });
        });
        var countnotif = 0;
        /* NOTIFICATION REPONSE */
        $('input[name=alertnumero]').keyup(function(){
          var control = $('input[name=alertnumero]').val();
          if (control == '') $(".alertvalide").hide(); else $(".alertvalide").show();
        });
        $('.alertvalide').click(function(){
          countnotif++;
          var control = $('input[name=alertnumero]').val();
          query = $.ajax({
              type:"POST",
              url:"traitement-notification.php",
              data:"numero="+control,
              success: function(data){
                $('<div>', {
                  class: 'notiflive'+countnotif,
                  text: ''
                }).appendTo('.alertelive');
                $(".notiflive"+countnotif).html(data);
                $('input[name=alertnumero]').val('');
                $(".alertvalide").hide();
              }
          });
        });
        /* NOTIFICATION UPDATE */
        $('input[name=alertupdate]').keyup(function(){
          var control = $('input[name=alertupdate]').val();
          if (control == '') $(".alertupdate").hide(); else $(".alertupdate").show();
        });
        $('.alertupdate').click(function(){
          countnotif++;
          var control = $('input[name=alertupdate]').val();
          query = $.ajax({
              type:"POST",
              url:"traitement-notification.php",
              data:"update="+control,
              success: function(data){
                $('<div>', {
                  class: 'notiflive'+countnotif,
                  text: ''
                }).appendTo('.alertelive');
                $(".notiflive"+countnotif).html(data);
                $('input[name=alertupdate]').val('');
                $(".alertupdate").hide();
              }
          });
        });
        /* JETS DE DES */
        $(".fa-random").click(function(){
          var resultat    = Math.floor((Math.random() * 100) + 1);
          var cal         = $(".diceflip1 p").html();
          var resultatPre = parseInt(cal);
          $(".diceflip").removeClass("col-xs-12")
                        .addClass("col-xs-6");
          $(".diceflip1").removeClass("col-xs-0")
                         .addClass("col-xs-6")
                         .fadeIn(1000);
          setTimeout(function(){
            $('.diceflip1 p').html(resultat);
            $('.diceflip1 p').css({
              display:'block'
            });
            $('.diceflip1 p').each(function () {
              var $this = $(this);
              jQuery({ Counter: resultatPre }).animate({ Counter: $this.text() }, {
                duration: 1000,
                easing: 'swing',
                step: function (i) {
                  $this.text(Math.ceil(i));
                }
              });
            });
          }, 300);
        })
        /* DEFILEMENT AUTO 3.0*/
        function poping(){
          $(".defil-content").fadeOut(function(){
            query = $.ajax({
                type:"POST",
                url:"traitement-defil.php",
                data:"defil",
                success: function(data){
                  $(".defil-content").html(data);
                  $(".defil-content").fadeIn();
                  setTimeout(function(){
                    poping();
                  }, 5000);
                }
            });
          });
        }
        setTimeout(function(){
          poping();
        }, 5000);




        /* DEFILEMENT AUTO 2.0*/
        // function scrolling1(){
        //   var top1      = $(".defil-content-sub1").css("top");
        //   top1          = parseInt(top1.substring(0,top1.length-2));
        //   var distance1 =  -425 - top1;
        //   if (distance1 < 0) {
        //     distance1   = distance1*-1;
        //   }
        //   var temps1    = distance1 / 0.0425;
        //   $(".defil-content-sub1").animate({
        //     top: '-425px'
        //   },temps1,'linear',function(){
        //     $(".defil-content-sub1").css({
        //       top : '425px',
        //     });
        //     $(".defil-content-sub1").stop(true);
        //     $(".defil-content-sub1").clearQueue();
        //     scrolling1();
        //   });
        // }
        // function scrolling2(){
        //   var top2      = $(".defil-content-sub2").css("top");
        //   top2          = parseInt(top2.substring(0,top2.length-2));
        //   var distance2 =  -850 - top2;
        //   if (distance2 < 0) {
        //     distance2   = distance2*-1;
        //   }
        //   var temps2    = distance2 / 0.0425;
        //   $(".defil-content-sub2").animate({
        //     top: '-850px'
        //   },temps2,'linear',function(){
        //     $(".defil-content-sub2").css({
        //       top : '0px',
        //     });
        //     $(".defil-content-sub2").stop(true);
        //     $(".defil-content-sub2").clearQueue();
        //     scrolling2();
        //   });
        // };
        // $(".defil-content").mouseenter(function(){
        //   $(".defil-content-sub1").stop(true);
        //   $(".defil-content-sub2").stop(true);
        //   $(".defil-content-sub1").clearQueue();
        //   $(".defil-content-sub2").clearQueue();
        // });
        // $("body").mouseleave(function(){
        //   $(".defil-content-sub1").stop(true);
        //   $(".defil-content-sub2").stop(true);
        //   $(".defil-content-sub1").clearQueue();
        //   $(".defil-content-sub2").clearQueue();
        // });
        // $("body").mouseenter(function(){
        //   scrolling1();
        //   scrolling2();
        // });
        // $(".defil-content").mouseleave(function(){
        //   scrolling1();
        //   scrolling2();
        // });
        // setTimeout(function(){
        //   scrolling1();
        //   scrolling2();
        // }, 1500);
        /* FIN */

        // function scrolling(){
        //   var heightScroll;
        //   var heightScroll;
        //   var distance;
        //   var objectif;
        //   var temps;
        //   var topScroll = $(".defil-content").scrollTop();
        //
        //   if (controlLooping == 1) {
        //      heightScroll = $(".defil-content").prop('scrollHeight');
        //      heightScroll = parseInt(heightScroll)-350;
        //      distance     = (heightScroll - topScroll);
        //      temps        = distance / 0.04;
        //     $(".defil-content").animate({scrollTop: heightScroll},temps,'linear',function(){
        //       controlLooping = 0;
        //       scrolling();
        //     });
        //
        //   }else{
        //     distance = topScroll;
        //     temps    = distance / 0.04;
        //     $(".defil-content").animate({scrollTop: 0},temps,'linear',function(){
        //      controlLooping = 1;
        //      scrolling();
        //     });
        //   }
        // }
        // var controlLooping = 1;
        // $(".defil-content").mouseenter(function(){
        //   $(this).stop(true);
        //   $(this).clearQueue();
        // })
        // $(".defil-content").mouseleave(function(){
        //   scrolling();
        // })
        //
        // setTimeout(function(){
        // //  scrolling();
        // }, 1500);


      })
    </script>
  </body>
</html>
