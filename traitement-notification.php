<?php
  session_start();
  include("_connected.php");
  include_once("langue.php");
  if (isset($_POST["numero"]))
  {
    if (is_numeric($_POST["numero"]))
    {
      $numero = $_POST["numero"];
      $query  = $mysqli->query("SELECT * FROM chapitre WHERE chapitre_numero_fr = $numero");
      $nb     = $query->num_rows;
      if ($nb == 1)
      {
        $row = $query->fetch_array();
        $idinsert     = $row["chapitre_id"];
        $date         = strtotime("now");
        $actionnumero = "7";
        $query        = $mysqli->query("INSERT INTO notification (
            notification_id,
            notification_action,
            notification_date,
            user_id,
            chapitre_id,
            perso_id
          ) VALUES (
            NULL,
            $actionnumero,
            '$date',
            '$user_id',
            $idinsert,
            0
          )
        ");
        $idinsert = $mysqli->insert_id;
        $query = $mysqli->query("SELECT * FROM notification WHERE notification_id = $idinsert");
        $nb    = $query->num_rows;
        if ($nb > 0)
        {
          while($row = $query->fetch_array())
          {
            $date          = $row["notification_date"];
            $utilisateur   = $row["user_id"];
            $chapitre      = $row["chapitre_id"];
            $numero_action = $row["notification_action"];
            $query2 = $mysqli->query("SELECT * FROM user WHERE user_id = $utilisateur");
            $nb2    = $query2->num_rows;
            if ($nb2 == 1)
            {
              $row2        = $query2->fetch_array();
              $utilisateur = $row2["user_prenom"];
            }
            if ($chapitre > 0)
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
            echo "<a href=\"".$liendrive."\" target=\"_blanck\">";
              echo "<div class=\"notif row\">";
                echo "<div class=\"col-xs-12\">";
                  echo "<div class=\"row\">";
                    echo "<div class=\"col-xs-4\">";
                      if ($numero_action == 1 || $numero_action == 2)
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
                      if ($numero_action == 1 OR $numero_action == 2 OR $numero_action == 3 OR $numero_action == 4)
                      {
                        if (empty($chapitre_tableau["titre"][$user_langue]) OR empty($chapitre_tableau["numero"][$user_langue]))
                        {
                          echo "<p>".$action[$numero_action]["fr"]." ".$chapitre_tableau["numero"]["fr"].": ".$chapitre_tableau["titre"]["fr"]."</p>";
                        }
                        else
                        {
                          echo "<p>".$action[$numero_action][$user_langue]." ".$chapitre_tableau["numero"][$user_langue].": ".$chapitre_tableau["titre"][$user_langue]."</p>";
                        }
                      }
                      else if($numero_action == 7)
                      {
                        echo "<p>".$action[$numero_action][$user_langue]." ".$chapitre_tableau["numero"][$user_langue].": ".$chapitre_tableau["titre"][$user_langue]."</p>";
                      }
                      else if($numero_action == 8)
                      {
                        echo "<p>".$action[$numero_action][$user_langue]." : ".$texteupdate["fr"]."</p>";
                      }
                      else
                      {
                        echo "<p>".$action[$numero_action][$user_langue].": ".$chapitre_tableau["titre"][$user_langue]."</p>";
                      }
                    echo "</div>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
            echo "</a>";
          }
        }
      }
    }
  }

  if (isset($_POST["update"]))
  {
    $update       = trim(strip_tags(htmlspecialchars($_POST["update"],ENT_QUOTES,"UTF-8")));
    $row          = $query->fetch_array();
    $idinsert     = $row["chapitre_id"];
    $date         = strtotime("now");
    $actionnumero = "8";
    $query        = $mysqli->query("INSERT INTO notification (
        notification_id,
        notification_action,
        notification_date,
        user_id,
        chapitre_id,
        perso_id
      ) VALUES (
        NULL,
        $actionnumero,
        '$date',
        '$user_id',
        '$update',
        0
      )
    ");
    $idinsert = $mysqli->insert_id;
    $query = $mysqli->query("SELECT * FROM notification WHERE notification_id = $idinsert");
    $nb    = $query->num_rows;
    if ($nb > 0)
    {
      while($row = $query->fetch_array())
      {
        $date          = $row["notification_date"];
        $utilisateur   = $row["user_id"];
        $chapitre      = $row["chapitre_id"];
        $numero_action = $row["notification_action"];
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
        echo "<a href=\"".$liendrive."\" target=\"_blanck\">";
          echo "<div class=\"notif row\">";
            echo "<div class=\"col-xs-12\">";
              echo "<div class=\"row\">";
                echo "<div class=\"col-xs-4\">";
                  if ($numero_action == 1 || $numero_action == 2)
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
                  if ($numero_action == 1 OR $numero_action == 2 OR $numero_action == 3 OR $numero_action == 4)
                  {
                    if (empty($chapitre_tableau["titre"][$user_langue]) OR empty($chapitre_tableau["numero"][$user_langue]))
                    {
                      echo "<p>".$action[$numero_action]["fr"]." ".$chapitre_tableau["numero"]["fr"].": ".$chapitre_tableau["titre"]["fr"]."</p>";
                    }
                    else
                    {
                      echo "<p>".$action[$numero_action][$user_langue]." ".$chapitre_tableau["numero"][$user_langue].": ".$chapitre_tableau["titre"][$user_langue]."</p>";
                    }
                  }
                  else if($numero_action == 7)
                  {
                    echo "<p>".$action[$numero_action][$user_langue]." ".$chapitre_tableau["numero"][$user_langue].": ".$chapitre_tableau["titre"][$user_langue]."</p>";
                  }
                  else if($numero_action == 8)
                  {
                    echo "<p>".$action[$numero_action][$user_langue]." : ".$texteupdate["fr"]."</p>";
                  }
                  else
                  {
                    echo "<p>".$action[$numero_action][$user_langue].": ".$chapitre_tableau["titre"][$user_langue]."</p>";
                  }
                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</a>";
      }
    }
  }
  if (isset($_POST["notif"]))
  {
    if (is_numeric($_POST["notif"]))
    {
      $notif_id = trim($_POST["notif"]);
      echo "<div class=\"col-md-12\">";
      echo "<i class=\"fa fa-times crossupdate\" aria-hidden=\"true\"></i>";
        echo "<h2>Liste des modifications :<h2>";
        $query = $mysqli->query("SELECT * FROM notification WHERE notification_action = 8 ORDER BY notification_id DESC");
        $nb    = $query->num_rows;
        if ($nb > 0)
        {
          echo "<ul>";
          while($row = $query->fetch_array())
          {
            $date          = $row["notification_date"];
            $texte         = $row["chapitre_id"];
            $numero_action = $row["notification_action"];
            $texte         = $row["chapitre_id"];
            echo "<li>";
              echo "<p>".$semaine[date("N", $date)][$user_langue]." ".date("j", $date)." ".$mois[date("n", $date)][$user_langue]." : ".$texte."</p>";
            echo "</li>";
          }
          echo "</ul>";
        }
      echo "</div>";

    }
  }
?>
