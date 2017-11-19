<?php $monUrl = $_SERVER['REQUEST_URI']; ?>
<div class="boutonnavphone" data-switchbouton="0"><i class="fa fa-bars" aria-hidden="true"></i></div>
<div class="navigationphone">

  <a class="navphonelement navphonelement1" href="home.php" title="<?php echo $language_nav['nav_accueil'][$user_langue]; ?>">
    <div class="item-phone phone-home">
      <div class="col-xs-10">
      <p class=""><i class="fa fa-home " aria-hidden="true"></i><?php echo $language_nav['nav_accueil'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
  <a class="navphonelement navphonelement2" href="mozaique.php" title="<?php echo $language_nav['nav_personnages'][$user_langue]; ?>">
  <div class="item-phone phone-persos">
    <div class="col-xs-10">
      <p class=""><i class="fa fa-user-circle" aria-hidden="true"></i><?php echo $language_nav['nav_personnages'][$user_langue]; ?></p>
    </div>
    <div class="col-xs-2">
      <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
    </div>
  </div>
  </a>
  <a class="navphonelement navphonelement3" href="chapitre.php" title="<?php echo $language_nav['nav_chapitres'][$user_langue]; ?>">
    <div class="item-phone phone-chap">
      <div class="col-xs-10">
       <p class=""><i class="fa fa-bookmark" aria-hidden="true"></i><?php echo $language_nav['nav_chapitres'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
  <a class="navphonelement navphonelement4" href="groupe.php" title="<?php echo $language_nav['nav_groupes'][$user_langue]; ?>">
    <div class="item-phone phone-groupe">
      <div class="col-xs-10">
        <p class=""><i class="fa fa-sitemap" aria-hidden="true"></i><?php echo $language_nav['nav_groupes'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
  <a class="navphonelement navphonelement5" href="stats.php" title="<?php echo $language_nav['nav_stats'][$user_langue]; ?>">
    <div class="item-phone phone-stats">
      <div class="col-xs-10">
        <p class=""><i class="fa fa-pie-chart" aria-hidden="true"></i><?php echo $language_nav['nav_stats'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
  <a class="navphonelement navphonelement6" href="galerie.php" title="<?php echo $language_nav['nav_galerie'][$user_langue]; ?>">
    <div class="item-phone phone-galerie">
      <div class="col-xs-10">
        <p class=""><i class="fa fa-picture-o" aria-hidden="true"></i><?php echo $language_nav['nav_galerie'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
  <a class="navphonelement navphonelement7" href="traitement-langue.php?url=<?php echo $monUrl ?>" title="<?php echo $language_nav['nav_langue'][$user_langue]; ?>">
    <div class="item-phone phone-langue">
      <div class="col-xs-10">
       <p class=""><i class="fa fa-language" aria-hidden="true"></i><?php echo $language_nav['nav_langue'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
  <a class="navphonelement navphonelement8" href="_logout.php" title="<?php echo $language_nav['nav_deco'][$user_langue]; ?>">
    <div class="item-phone phone-logout">
      <div class="col-xs-10">
       <p class=""><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo $language_nav['nav_deco'][$user_langue]; ?></p>
      </div>
      <div class="col-xs-2">
        <i class="fa fa-angle-right endfleche" aria-hidden="true"></i>
      </div>
    </div>
  </a>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $(".boutonnavphone").click(function(){

      $(this).clearQueue();
      var switchbouton = $(this).attr("data-switchbouton");
      if (switchbouton == "0")
      {
        $(".boutonnavphone").attr('data-switchbouton','2');
        $(".navigationphone").css({
          left:0
        })
        var     a = 0;
        var temps = 800;
        while ( a < 9)
        {
          a++;
          temps = temps+50;

          $(".navphonelement"+a).animate({
            left:0
          },temps);
        }
//        temps = temps+50;
        setTimeout(function(){
          $(".boutonnavphone").attr('data-switchbouton','1');
        }, temps);
      }
      else if(switchbouton == "1")
      {
        $(".boutonnavphone").attr('data-switchbouton','2');
        var     a = 0;
        var temps = 300;
        while ( a < 9)
        {
          a++;
          temps = temps+40;

          $(".navphonelement"+a).animate({
            left:"100%"
          },temps);
        }
//        temps = temps+50;
        setTimeout(function(){
          $(".navigationphone").css({
            left:"-100%"
          })
          $(".navphonelement").css({
            left:"-600%"
          })
          $(".boutonnavphone").attr("data-switchbouton","0");
        }, temps);
      }

    });

  })

</script>
