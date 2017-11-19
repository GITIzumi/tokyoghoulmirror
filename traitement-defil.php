<?php
  session_start();
  include("_connected.php");
  include_once("langue.php");
  if (isset($_POST["defil"]))
  {
    $query = $mysqli->query("SELECT * FROM perso WHERE perso_actif = 1 ORDER BY RAND()");
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
            $demagic = rand (1 ,100 );
            if ($demagic <= 2)
            {
              if(!in_array($randperso,$tiragefinal))
              {
                array_push($tiragefinal,$randperso);
                $a++;
              }
            }
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
                   'jp'  => $row["perso_surnom_jp"]),

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
  }
?>
