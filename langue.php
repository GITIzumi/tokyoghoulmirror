<?php
  $semaine=array(
    1 =>array('fr'=>"Lundi",   'jp'=>"月曜日"),
    2 =>array('fr'=>"Mardi",   'jp'=>"火曜日"),
    3 =>array('fr'=>"Mercredi",'jp'=>"水曜日"),
    4 =>array('fr'=>"Jeudi",   'jp'=>"木曜日"),
    5 =>array('fr'=>"Vendredi",'jp'=>"金曜日"),
    6 =>array('fr'=>"Samedi",  'jp'=>"土曜日"),
    7 =>array('fr'=>"Dimanche",'jp'=>"日曜日"),
  );
  $mois=array(
    1  =>array('fr'=>"Janvier",  'jp'=>"1月"),
    2  =>array('fr'=>"Février",  'jp'=>"2月"),
    3  =>array('fr'=>"Mars",     'jp'=>"3月"),
    4  =>array('fr'=>"Avril",    'jp'=>"4月"),
    5  =>array('fr'=>"Mai",      'jp'=>"5月"),
    6  =>array('fr'=>"Juin",     'jp'=>"6月"),
    7  =>array('fr'=>"Juillet",  'jp'=>"7月"),
    8  =>array('fr'=>"Août",     'jp'=>"8月"),
    9  =>array('fr'=>"Septembre",'jp'=>"9月"),
    10 =>array('fr'=>"Octobre",  'jp'=>"10月"),
    11 =>array('fr'=>"Novembre", 'jp'=>"11月"),
    12 =>array('fr'=>"Décembre", 'jp'=>"12月"),
  );
  $arrondissement=array(
    1  =>array('fr'=>"Chiyoda",    'jp'=>"千代田区"),
    2  =>array('fr'=>"Chūō",       'jp'=>"中央区"),
    3  =>array('fr'=>"Minato",     'jp'=>"港区"),
    4  =>array('fr'=>"Shinjuku",   'jp'=>"新宿区"),
    5  =>array('fr'=>"Bunkyō",     'jp'=>"文京区"),
    6  =>array('fr'=>"Taitō",      'jp'=>"台東区"),
    7  =>array('fr'=>"Sumida",     'jp'=>"墨田区"),
    8  =>array('fr'=>"Kōtō",       'jp'=>"江東区"),
    9  =>array('fr'=>"Shinagawa",  'jp'=>"品川区"),
    10 =>array('fr'=>"Meguro",     'jp'=>"目黒区"),
    11 =>array('fr'=>"Ōta",        'jp'=>"大田区"),
    12 =>array('fr'=>"Setagaya",   'jp'=>"世田谷区"),
    13 =>array('fr'=>"Shibuya",    'jp'=>"渋谷区"),
    14 =>array('fr'=>"Nakano",     'jp'=>"中野区"),
    15 =>array('fr'=>"Suginami",   'jp'=>"杉並区"),
    16 =>array('fr'=>"Toshima",    'jp'=>"豊島区"),
    17 =>array('fr'=>"Kita",       'jp'=>"北区"),
    18 =>array('fr'=>"Arakawa",    'jp'=>"荒川区"),
    19 =>array('fr'=>"Itabashi",   'jp'=>"板橋区"),
    20 =>array('fr'=>"Nerima",     'jp'=>"練馬区"),
    21 =>array('fr'=>"Adachi",     'jp'=>"足立区"),
    22 =>array('fr'=>"Katsushika", 'jp'=>"葛飾区"),
    23 =>array('fr'=>"Edogawa",    'jp'=>"江戸川区"),
    24 =>array('fr'=>"Underground",'jp'=>"地下"),
  );
  $action=array(
    1 =>array('fr'=>"Nouveau personnage",     'jp'=>"キャラクターを作る"),
    2 =>array('fr'=>"Modification personnage",'jp'=>"キャラクターを変種する"),
    3 =>array('fr'=>"Création chapitre",      'jp'=>"章を作る"),
    4 =>array('fr'=>"Modification Chapitre",  'jp'=>"章を変種する"),
    5 =>array('fr'=>"Création Spin-off",      'jp'=>"スピンオフを作る"),
    6 =>array('fr'=>"Modification Spin-off",  'jp'=>"スピンオフを変種する"),
    7 =>array('fr'=>"Réponse au chapitre",    'jp'=>"章の答え"),
    8 =>array('fr'=>"Mise à jour",            'jp'=>"アップデート"),
    9 =>array('fr'=>"Appartition personnage", 'jp'=>"キャラクターの出現"),
   10 =>array('fr'=>"Suppression personnage", 'jp'=>""),
  );
  $langage_home=array(
    'langue_h2'             =>array('fr'=>"Changer la langue",                       'jp'=>"言語の変更"),
    'francais'              =>array('fr'=>"Français",                                'jp'=>"フランス語"),
    'japonais'              =>array('fr'=>"Japonais",                                'jp'=>"日本語"),
    'lancede_h2'            =>array('fr'=>"Simulateur de dés",                       'jp'=>"サイコロ"),
    'lancede_p'             =>array('fr'=>"Cliquez sur le logo pour lancer un d100.",'jp'=>"サイコロを振るためにボタンをクリック"),
    'lancede_title'         =>array('fr'=>"Lancer un dé.",                           'jp'=>"サイコロを振る"),
    'deconnexion_h2'        =>array('fr'=>"Déconnexion",                             'jp'=>"ログアウト"),
    'deconnexion_title'     =>array('fr'=>"Se déconnecter",                          'jp'=>"ログアウト"),
    'notification_h2'       =>array('fr'=>"Les notifications",                       'jp'=>"催告"),
    'notification_creation' =>array('fr'=>"Réponse au chapitre numéro",              'jp'=>"章の番号を答えるのは"),
    'notification_update'   =>array('fr'=>"Annoncer une mise à jour",                'jp'=>"アップデートを知らせる"),
    'defilement_h2'         =>array('fr'=>"Jour de chance",                          'jp'=>"吉日"),
    'chapitre_h2'           =>array('fr'=>"Les Chapitres",                           'jp'=>"章"),
    'personnage_h2'         =>array('fr'=>"Les Personnages",                         'jp'=>"キャラクター"),
    'lieux_h2'              =>array('fr'=>"Les Lieux",                               'jp'=>"場所"),
    'groupe_h2'             =>array('fr'=>"Les Groupes",                             'jp'=>"団体"),
    'galerie_h2'            =>array('fr'=>"La Galerie",                              'jp'=>"画廊"),
    'stats_h2'              =>array('fr'=>"Les Statistiques",                        'jp'=>"統計"),
    'ajout_notif'           =>array('fr'=>"Ajouter une notification",                'jp'=>"催告を足す"),
  );
  $language_nav=array(
    'nav_accueil'    =>array('fr'=>"Accueil",           'jp'=>"ホームページ"),
    'nav_personnages'=>array('fr'=>"Personnages",       'jp'=>"キャラクター"),
    'nav_chapitres'  =>array('fr'=>"Chapitres",         'jp'=>"章"),
    'nav_groupes'    =>array('fr'=>"Groupes",           'jp'=>"団体"),
    'nav_lieux'      =>array('fr'=>"Lieux",             'jp'=>"場所"),
    'nav_galerie'    =>array('fr'=>"Galerie",           'jp'=>"画廊"),
    'nav_langue'     =>array('fr'=>"Changer la langue", 'jp'=>"言語の変更"),
    'nav_deco'       =>array('fr'=>"Déconnexion",       'jp'=>"ログアウト"),
    'nav_stats'      =>array('fr'=>"Statistiques",      'jp'=>"統計"),
    'nav_retrecir'   =>array('fr'=>"Changer la taille", 'jp'=>"サイズを変わる"),
  );
  $langage_porte=array(
    'porte_prenom'   =>array('fr'=>"Prénom",      'jp'=>"名前"),
    'porte_mdp'      =>array('fr'=>"Mot de passe",'jp'=>"パスワード"),
    'porte_connexion'=>array('fr'=>'Connexion',   'jp'=>"ログイン"),
  );
  $langage_perso=array(
    'creation_h2'                   =>array('fr'=>"Création d'un personnage",        'jp'=>"キャラクターを作る"),
    'creation_add_1'                =>array('fr'=>"Ajouter un",                      'jp'=>"新しい"),
    'creation_add_2'                =>array('fr'=>"nouveau",                         'jp'=>"キャラクターを"),
    'creation_add_3'                =>array('fr'=>"personnage",                      'jp'=>"足す"),
    'creation_suivant'              =>array('fr'=>"Suivant",                         'jp'=>"人名"),
    'creation_add2_1'               =>array('fr'=>"Reprendre",                       'jp'=>"キャラクターの"),
    'creation_add2_2'               =>array('fr'=>"la création",                     'jp'=>"創造を"),
    'creation_add2_3'               =>array('fr'=>"du personnage",                   'jp'=>"続け"),
    'creation_suivant'              =>array('fr'=>"Suivant",                         'jp'=>"人名"),
    'creation_prenom'               =>array('fr'=>"Prénom",                          'jp'=>"名"),
    'creation_nom'                  =>array('fr'=>"Nom",                             'jp'=>"姓"),
    'creation_surnom'               =>array('fr'=>"Surnom",                          'jp'=>"綽名"),
    'creation_description'          =>array('fr'=>"Description",                     'jp'=>"記述"),
    'creation_masque'               =>array('fr'=>"Masque",                          'jp'=>"仮面"),
    'creation_metier'               =>array('fr'=>"Métier",                          'jp'=>"職業"),
    'creation_arrondissement'       =>array('fr'=>"Arrondissement",                  'jp'=>"区"),
    'creation_kagune'               =>array('fr'=>"Kagune",                          'jp'=>"赫子"),
    'creation_quinque'              =>array('fr'=>"Quinque",                         'jp'=>"ク イ ン ケ"),
    'creation_rang'                 =>array('fr'=>"Rang",                            'jp'=>"ランク"),
    'creation_taille'               =>array('fr'=>"Taille",                          'jp'=>"背丈"),
    'creation_poids'                =>array('fr'=>"Poids",                           'jp'=>"目方"),
    'creation_age'                  =>array('fr'=>"Âge",                             'jp'=>"年齢"),
    'creation_jour'                 =>array('fr'=>"Jour de naissance",               'jp'=>"誕生の日"),
    'creation_mois'                 =>array('fr'=>"Mois de naissance",               'jp'=>"誕生の月"),
    'creation_force'                =>array('fr'=>"Force",                           'jp'=>"力"),
    'creation_faim'                 =>array('fr'=>"Faim",                            'jp'=>"飢餓の抵抗"),
    'creation_mental'               =>array('fr'=>"Mental",                          'jp'=>"心的"),
    'creation_courage'              =>array('fr'=>"Courage",                         'jp'=>"勇気"),
    'creation_charisme'             =>array('fr'=>"Charisme",                        'jp'=>"カリスマ"),
    'creation_eloquence'            =>array('fr'=>"Éloquence",                       'jp'=>"雄弁"),
    'creation_intelligence'         =>array('fr'=>"Intelligence",                    'jp'=>"知性"),
    'creation_culture'              =>array('fr'=>"Culture",                         'jp'=>"一般教養"),
    'creation_dexterite'            =>array('fr'=>"Dextérité",                       'jp'=>"熟練"),
    'creation_agilite'              =>array('fr'=>"Agilité",                         'jp'=>"素早さ"),
    'creation_vitalite'             =>array('fr'=>"Vitalité",                        'jp'=>"体"),
    'creation_homme'                =>array('fr'=>"Homme",                           'jp'=>"男性"),
    'creation_femme'                =>array('fr'=>"Femme",                           'jp'=>"女性"),
    'creation_human'                =>array('fr'=>"Humain",                          'jp'=>"人間"),
    'creation_goul'                 =>array('fr'=>"Goule",                           'jp'=>"喰種"),
    'creation_valider'              =>array('fr'=>"Valider",                         'jp'=>"登録する"),
    'creation_effacer'              =>array('fr'=>"Tout effacer",                    'jp'=>"全部を削除する"),
    'creation_annuler'              =>array('fr'=>"Annuler",                         'jp'=>"キャンセル"),
    'creation_affiliation'          =>array('fr'=>"Affiliations",                    'jp'=>"帰属"),
    'creation_apparition'           =>array('fr'=>"Apparitions",                     'jp'=>"出席"),
    'creation_genre'                =>array('fr'=>"Genre et Nature",                 'jp'=>"性と種"),
    'creation_genre2'               =>array('fr'=>"Genre",                           'jp'=>"性"),
    'creation_nature'               =>array('fr'=>"Nature",                          'jp'=>"種"),
    'creation_enfrancais'           =>array('fr'=>"En français",                     'jp'=>"フランス語で"),
    'creation_enjaponais'           =>array('fr'=>"En japonais",                     'jp'=>"日本語で"),
    'creation_vivant'               =>array('fr'=>"Vivant",                          'jp'=>"生きている"),
    'creation_mort'                 =>array('fr'=>"Mort",                            'jp'=>"亡い"),
    'creation_detail'               =>array('fr'=>"Détails",                         'jp'=>"各論"),
    'creation_stats'                =>array('fr'=>"Stats",                           'jp'=>"特徴的"),
    'creation_hrp'                  =>array('fr'=>"Hors Rp",                         'jp'=>"ロールプレのほかに"),
    'creation_visibleall'           =>array('fr'=>"Visible par tous",                'jp'=>"みんなに見えられる"),
    'creation_visibleame'           =>array('fr'=>"Visible uniquement par moi",      'jp'=>"自分だけに見えられる"),
    'creation_image'                =>array('fr'=>"Image",                           'jp'=>"イメージ"),
    'creation_inconnu'              =>array('fr'=>"Inconnu",                         'jp'=>"不詳"),
    'ficheperso_titre'              =>array('fr'=>"Fiche personnage",                'jp'=>"キャラクターの紹介"),
    'creation_description_kagune_fr'=>array('fr'=>"Description en français",         'jp'=>"フランス語の記述"),
    'creation_description_kagune_jp'=>array('fr'=>"Description en japonais",         'jp'=>"日本語の記述"),
    'creation_type'                 =>array('fr'=>"Type",                            'jp'=>"タイプ"),
    'creation_rang_goul'            =>array('fr'=>"Rang Goule",                      'jp'=>"喰種のランク"),
    'creation_rang_ccg'             =>array('fr'=>"Rang CCG",                        'jp'=>"喰種対策局の序列"),
    'creation_ajouter_quinque'      =>array('fr'=>"Ajouter un Quinque",              'jp'=>"ク イ ン ケを加える"),
    'creation_nom_francais'         =>array('fr'=>"Nom en français",                 'jp'=>"フランス語の名前"),
    'creation_nom_japonais'         =>array('fr'=>"Nom en japonais",                 'jp'=>"日本語の名前"),
  );
  $language_chapitre=array(
    'chapitre_add'                 =>array('fr'=>"Ajouter un chapitre",                                   'jp'=>"章を足す"),
    'chapitre_modif'               =>array('fr'=>"Modifier le chapitre",                                  'jp'=>"章を変種する"),
    'chapitre_modif_titre'         =>array('fr'=>"Modification d'un chapitre",                            'jp'=>"章を変種"),
    'chapitre_resume'              =>array('fr'=>"Résumé et personnages",                                 'jp'=>"要約とキャラクター"),
    'chapitre_resume_title'        =>array('fr'=>"Afficher le résumé et les personnages",                 'jp'=>"要約とキャラクターを張り出す"),
    'chapitre_crea_titre'          =>array('fr'=>"Création d’un chapitre",                                'jp'=>"章を作る"),
    'chapitre_crea_btn_chap'       =>array('fr'=>"Chapitre",                                              'jp'=>"章"),
    'chapitre_crea_btn_spin'       =>array('fr'=>"Spin-off",                                              'jp'=>"スピンオフ"),
    'chapitre_crea_input_num_fr'   =>array('fr'=>"Numéro en chiffre",                                     'jp'=>"英数字"),
    'chapitre_crea_input_num_jp'   =>array('fr'=>"Numéro en japonais",                                    'jp'=>"数字"),
    'chapitre_crea_input_titre_fr' =>array('fr'=>"Titre en français",                                     'jp'=>"フランス語で題名"),
    'chapitre_crea_input_titre_jp' =>array('fr'=>"Titre en japonais",                                     'jp'=>"日本語で題名"),
    'chapitre_crea_input_resume_fr'=>array('fr'=>"Résumé en français",                                    'jp'=>"フランス語で要約"),
    'chapitre_crea_input_resume_jp'=>array('fr'=>"Résumé en japonais",                                    'jp'=>"日本語で要約"),
    'chapitre_crea_input_google'   =>array('fr'=>"Lien Google Drive",                                     'jp'=>"グーグルドライブのリンク"),
    'chapitre_crea_input_save'     =>array('fr'=>"Enregistrer",                                           'jp'=>"セーブ"),
    'chapitre_crea_input_delete'   =>array('fr'=>"Supprimer",                                             'jp'=>"削除する"),
    'chapitre_crea_persos'         =>array('fr'=>"Sélectionnez les personnages présents dans le chapitre",'jp'=>"章にいるキャラクターを選んでください"),
  );
  $language_stat=array(
      'stat_total'   =>array('fr'=>"Total",                         'jp'=>"総計"),
      'stat_perso'   =>array('fr'=>"Les chiffres",                  'jp'=>"数字"),
      'stat_homme'   =>array('fr'=>"Homme",                         'jp'=>"男性"),
      'stat_femme'   =>array('fr'=>"Femme",                         'jp'=>"女性"),
      'stat_inconnu' =>array('fr'=>"Inconnu",                       'jp'=>"不詳"),
      'stat_genre'   =>array('fr'=>"Répartition des genres",       'jp'=>"性別分布"),
      'stat_humain'  =>array('fr'=>"Humain",                       'jp'=>"人間"),
      'stat_goule'   =>array('fr'=>"Goule",                         'jp'=>"喰種"),
      'stat_inconnu' =>array('fr'=>"Inconnu",                       'jp'=>"不詳"),
      'stat_nature'  =>array('fr'=>"Répartition des natures",     'jp'=>"種の分布"),
      'stat_kagune'  =>array('fr'=>"Répartition des kagunes",     'jp'=>"赫子の分布"),
      'stat_attribut'=>array('fr'=>"Répartition des attributs", 'jp'=>"習熟の分布"),
      'stat_groupe'  =>array('fr'=>"Personnages dans les groupes", 'jp'=>"グループで何"),
  );

  $language_lieux=array(
    'lieux_titre'=>array('fr'=>"Les lieux", 'jp'=>"場所"),
  );
  $language_perso_crea=array(
      'ficheperso_kagune_add'=>array('fr'=>"Ajouter un kagune au personnage", 'jp'=>"キャラクターに赫子を加える"),
      'ficheperso_img_add'   =>array('fr'=>"Choisir une image", 'jp'=>""),
  );
  $language_groupe=array(
      'ajout_groupe'           =>array('fr'=>"Créer un groupe",                 'jp'=>"グループを足す"),
      'creation_groupe'        =>array('fr'=>"Création d'un groupe",            'jp'=>"グループを作る"),
      'creation_nom_francais'  =>array('fr'=>"Nom en français",                 'jp'=>"フランス語の名前"),
      'creation_nom_japonais'  =>array('fr'=>"Nom en japonais",                 'jp'=>"日本語の名前"),
      'creation_description_fr'=>array('fr'=>"Description en français",         'jp'=>"フランス語の記述"),
      'creation_description_jp'=>array('fr'=>"Description en japonais",         'jp'=>"日本語の記述"),
      'creation_couleur'       =>array('fr'=>"Couleur",                         'jp'=>"色"),
  );
  $language_erreur=array(
      'erreur_survenue'       =>array('fr'=>"Une erreur est survenue",'jp'=>"エラーが発生しました"),
      'erreur'                =>array('fr'=>"Erreur !",               'jp'=>"エラー !")
  );
?>
