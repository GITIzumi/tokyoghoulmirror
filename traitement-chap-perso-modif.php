<?php
  session_start();
  if (isset($_POST["perso"]))
  {
    $id_perso = strip_tags(trim($_POST["perso"]));
    if (isset($_SESSION["perso-chapitre-modif"]))
    {
      if (in_array($id_perso, $_SESSION["perso-chapitre-modif"]))
      {
        $perso_key = array_search($id_perso, $_SESSION["perso-chapitre-modif"]);
        unset($_SESSION["perso-chapitre-modif"][$perso_key]);
      }
      else
      {
        array_push($_SESSION["perso-chapitre-modif"],$id_perso);
      }
    }
    else
    {
      $_SESSION["perso-chapitre-modif"] = array();
      array_push($_SESSION["perso-chapitre-modif"],$id_perso);
    }
  }
?>
