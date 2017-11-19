<?php $monUrl = $_SERVER['REQUEST_URI']; ?>
<div class="navigation container">
  <div class="row titre-nav">
    <p>T O K Y O</p>
    <p>G H O U L</p>
    <p>M I R R O R</p>
  </div>
  <a href="home.php" title="<?php echo $language_nav['nav_accueil'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-home icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_accueil'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="mozaique.php" title="<?php echo $language_nav['nav_personnages'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-user-circle icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_personnages'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="chapitre.php" title="<?php echo $language_nav['nav_chapitres'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-bookmark icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_chapitres'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="groupe.php" title="<?php echo $language_nav['nav_groupes'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class= "col-xs-12">
        <i class="fa fa-sitemap icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_groupes'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="stats.php" title="<?php echo $language_nav['nav_stats'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-pie-chart icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_stats'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="galerie.php" title="<?php echo $language_nav['nav_galerie'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-picture-o icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_galerie'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="traitement-langue.php?url=<?php echo $monUrl ?>" title="<?php echo $language_nav['nav_langue'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-language icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_langue'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <a href="_logout.php" title="<?php echo $language_nav['nav_deco'][$user_langue]; ?>">
    <div class="row item-nav">
      <div class="col-xs-12">
        <i class="fa fa-sign-out icone-nav fa-2x" aria-hidden="true"></i>
        <p class="titreinnav"><?php echo $language_nav['nav_deco'][$user_langue]; ?></p>
      </div>
    </div>
  </a>
  <div class="row item-nav bouton-cache" title="<?php echo $language_nav['nav_retrecir'][$user_langue]; ?>">
      <div class="col-xs-12">
        <i class="fa fa-caret-right icone-nav symbol-nav fa-2x" aria-hidden="true"></i>
      </div>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $(".bouton-cache").click(function(){
      var largeurNav = $(".navigation").css('width');
      if (largeurNav == '145px') {
        // NAV
        $(".titreinnav").hide();
        $(".icone-nav").animate({
          'font-size': '28px'
        })
        $(".item-nav").animate({
          height: '55px'
        })
        $(".navigation").animate({
          width:'70px'
        },500);
        $(".symbol-nav").removeClass("fa-caret-left");
        $(".symbol-nav").addClass("fa-caret-right");
        // container
        $(".general").animate({
          'padding-left':'85px'
        })
        $(".entete, .footer").animate({
          'padding-left':'70px'
        })
      }
      else
      {
        $(".icone-nav").animate({
          'font-size': '30px'
        })
        $(".item-nav").animate({
          height: '85px'
        })
        $(".navigation").animate({
          width:'145px'
        },500,function(){
            $(".titreinnav").show();
        });
        $(".symbol-nav").removeClass("fa-caret-right");
        $(".symbol-nav").addClass("fa-caret-left");
        // container
        $(".general").animate({
          'padding-left':'160px'
        })
        $(".entete, .footer").animate({
          'padding-left':'145px'
        })
      }
    });
    // $(".navigation").mouseenter(function(){
    //   $(".icone-nav").animate({
    //     'font-size': '28px'
    //   })
    //   $(".item-nav").animate({
    //     height: '85px'
    //   })
    //   $(".navigation").animate({
    //     width:'130px'
    //   },500,function(){
    //       $(".titreinnav").show();
    //   });
    // })
    $(".navigation").animate({
      left:0
    },500);
  })

</script>
