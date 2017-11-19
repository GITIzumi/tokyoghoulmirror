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
    <link rel="stylesheet" href="css/groupe.css">
    <link rel="stylesheet" href="css/navigation.css">
  </head>
  <body>
    <?php
      include("navigation.php");
    ?>
    <svg class="svgeouille" xmlns="http://www.w3.org/2000/svg">

      <div class="entete">
       <h1><?php echo $langage_home['groupe_h2'][$user_langue]; ?></h1>
      </div>
      <div class="col-xs-12 general">
        <div class="objet1 vig" style="color:white;text-align:center;height:100px;width:100px;background-color:black;position:fixed;left:450px;top:200px;">1</div>
        <div class="objet2 vig" style="color:white;text-align:center;height:100px;width:100px;background-color:red;position:fixed;left:600px;top:500px;">2</div>

        <div class="row">
          <div class="col-xs-12 col-md-5">
            <div class="groupegroupe">

            </div>
          </div>
        </div>
      </div>
    <!-- <div class="footer">
      <i class="fa fa-bars teuteu" aria-hidden="true"></i>
    </div> -->
    <script type="text/javascript">


      $(document).ready(function(){
        // DRAG AND DROP
        $(function(){


          var clique    = false;
          var larg      = $(".vig").width();
          var haut      = $(".vig").height();
          var posX;
          var posY;
          var cible;
          var z         = 0;
          var decalX;
          var decalY;

          $(".vig").mousedown(function(event){
            event.preventDefault();
            clique  = true;
            cible   = $(this);
            z++;
            cible.css({'z-index': z});
            //calcul du decalage
            decalX = event.pageX - cible.offset().left + $(".container").offset().left;
            decalY = event.pageY - cible.offset().top  + $(".container").offset().top;

          });
          $(".vig").mouseup(function(){
            clique = false;

          });

          $(document).mousemove(function(event){
            posX = event.pageX;
            posY = event.pageY;
            if (clique)
            {
              clearsvg();
              tracerLine(div1,div2);

              cible.css({
                top: posY - decalY,
                left: posX - decalX
              });
            }
          });
        });

        //POUR ACTIVER LS SVG
        jQuery.fn.extend({
          appendSvg:function (nom,attributs)
          {
            var svg = document.createElementNS("http://www.w3.org/2000/svg",nom);
            for (var cle in attributs)
            {
              var valeur = attributs[cle];
              svg.setAttribute(cle,valeur);
            }
            var appendices = this.length;
            for (var i = 0; i < appendices; i++)
            {
              this[i].appendChild(svg);
            }
            return svg;
          }
        });


        // SCRIPT POUR TROUVER LA DIV LA PLUS BASSE ET LA PLUS A DROITE POUR DONNER UNE TAILLE AU BODY

        var div1 = ".objet1";
        var div2 = ".objet2";

        clearsvg();
        tracerLine(div1,div2);
        function clearsvg()
        {
          $('.svgeouille').html("");
        }
        function tracerLine(div1,div2)
        {
          var p        = $(div1);
          var position = p.position();
          var ptx1     = position.left;
          var pty1     = position.top;
          var largeur  = $(div1).css("width");
              largeur  = largeur.substring(0,largeur.length-2);
          var hauteur  = $(div1).css("height");
              hauteur  = hauteur.substring(0,hauteur.length-2);
          var pby1     = parseInt(pty1)+parseInt(hauteur);

          var p2        = $(div2);
          var position2 = p2.position();
          var ptx2      = position2.left;
          var pty2      = position2.top;
          var largeur2  = $(div2).css("width");
              largeur2  = largeur2.substring(0,largeur2.length-2);
          var hauteur2  = $(div2).css("height");
              hauteur2  = hauteur2.substring(0,hauteur2.length-2);
          var pby2      = parseInt(pty2)+parseInt(hauteur2);

          if (pty1<pty2)
          {
            if (pby1>pty2)
            {
              if(ptx1<ptx2)
              {
                // calculer le milieu de droit de pt1
                var x1 = parseInt(ptx1) + parseInt(largeur);
                var y1 = parseInt(pty1) + parseInt(hauteur/2);
                // calculer le milieu de gauche de pt2
                var x2 = parseInt(ptx2);
                var y2 = parseInt(pty2) + parseInt(hauteur2/2);
              }
              else
              {
                // calculer le milieu de gauche de pt1
                var x1 = parseInt(ptx1);
                var y1 = parseInt(pty1) + parseInt(hauteur/2);
                // calculer le milieu de droit de pt2
                var x2 = parseInt(ptx2) + parseInt(largeur2);
                var y2 = parseInt(pty2) + parseInt(hauteur/2);
              }
            }
            else
            {

              // calculer le milieu de bas de pt1
              var x1 = parseInt(ptx1) + parseInt(largeur/ 2);
              var y1 = parseInt(pty1) + parseInt(hauteur);
              // calculer le milieu de haut de pt2
              var x2 = parseInt(ptx2) + parseInt(largeur2 / 2);
              var y2 = parseInt(pty2);
            }
          }
          else
          {
            if (pby2>pty1)
            {
              if(ptx1<ptx2)
              {
                // calculer le milieu de droit de pt1
                var x1 = parseInt(ptx1) + parseInt(largeur);
                var y1 = parseInt(pty1) + parseInt(hauteur/2);
                // calculer le milieu de gauche de pt2
                var x2 = parseInt(ptx2);
                var y2 = parseInt(pty2) + parseInt(hauteur2/2);
              }
              else
              {
                // calculer le milieu de gauche de pt1
                var x1 = parseInt(ptx1);
                var y1 = parseInt(pty1) + parseInt(hauteur/2);
                // calculer le milieu de droit de pt2
                var x2 = parseInt(ptx2) + parseInt(largeur2);
                var y2 = parseInt(pty2) + parseInt(hauteur/2);
              }
            }
            else
            {
              // calculer le milieu de haut de pt1
              var x1 = parseInt(ptx1) + parseInt(largeur / 2);
              var y1 = parseInt(pty1);
              // calculer le milieu de bas de pt1
              var x2 = parseInt(ptx2) + parseInt(largeur2/ 2);
              var y2 = parseInt(pty2) + parseInt(hauteur2);
            }
          }
          $('.svgeouille').appendSvg('line',{x1:x1,y1:y1,x2:x2,y2:y2,stroke:"black"});
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
      });
    </script>
    </svg>

  </body>
</html>
