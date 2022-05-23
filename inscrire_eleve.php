<html>
    <head>
      <link rel="stylesheet" href="feuille_de_style.css">
      <meta charset="utf-8">
    </head>
    <body>
      <h1> Inscrire un élève à une séance </h1>
      <?php

        //connexion à la bdd
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a060';
        $dbpass = '0tWFmzHS';
        $dbname = 'nf92a060';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur de connection a mysql');

        //encodage : UTF-8
        mysqli_set_charset($connect, 'utf8');

        //recupération des données saisies dans le formulaire
        $ideleve=$_POST['ideleve'];
        $idseance=$_POST['idseance'];

        //recherche de l'effectif maximum
        $qeffMax="SELECT effMax FROM seances WHERE idseance=$idseance";
        //echo "<br> $qeffMax";
        $reffMax=mysqli_query($connect,$qeffMax);
        if (!$reffMax) {
          echo "<br> erreur  ".mysqli_error($connect);
          exit;
        }
        $row=mysqli_fetch_array($reffMax, MYSQLI_NUM);
        $effMax=$row[0];


        //recherche de l'effectif courant
        $qeffCourant="SELECT * FROM inscription WHERE idseance=$idseance";
        //echo "<br> $qeffCourant";
        $reffCourant=mysqli_query($connect, $qeffCourant);
        if (!$reffCourant) {
          echo "<br> erreur  ".mysqli_error($connect);
          exit;
        }
        $nbInscrits=mysqli_num_rows($reffCourant);


        //l'élève saisie est-il déjà inscrit?
        $qeleve="SELECT * FROM inscription WHERE idseance=$idseance AND ideleve=$ideleve";
        //echo "<br> $qeleve <br> ";
        $releve=mysqli_query($connect, $qeleve);
        if (!$releve) {
          echo "<br> erreur  ".mysqli_error($connect);
          exit;
        }
        $n=mysqli_num_rows($releve);


        //inscription de l'élève à la séance s'il n'y a pas déjà été ajouté et si l'effectif max n'a pas été atteint
        if($n==0 and $nbInscrits<$effMax) {
          $query="INSERT INTO inscription VALUES ($idseance, $ideleve, -1)";
          //echo "<br>$query<br>";
          $result=mysqli_query($connect, $query);
          if (!$result) {
            echo "<br> erreur  ".mysqli_error($connect);
            exit;
          }
          echo "L'élève a bien été inscrit.";
        }
        else{
          if ($nbInscrits>=$effMax) {
            echo "Erreur : La séance est complète (il y a $effMax inscrits), l'élève n'y a pas été inscrit";
          }
          else{
            echo "Attention : L'élève a déjà été inscrit à cette séance, il n'y a pas été réinscrit";
          }
        }
       ?>
     </body>
</html>
