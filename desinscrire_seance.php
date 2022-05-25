
<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Desinscription d'un élève à une séance </h1>
    <?php

      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $dateJour=date("Y-m-d");

      //recupération des données du formulaire
      $ideleve=$_POST['menuChoixEleve'];

      //récupération des séances planifiées dans le futur
      $query="SELECT inscription.idseance, DateSeance, nom FROM inscription INNER JOIN seances INNER JOIN themes WHERE ideleve=$ideleve AND inscription.idseance=seances.idseance AND seances.idtheme=themes.idtheme AND DateSeance>'$dateJour'";
      //echo "<br> $query <br>";
      $result=mysqli_query($connect,$query);
      if (!$result) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }
      //l'élève est-il inscrit à au moins une séance?
      $compteur=mysqli_num_rows($result);
      if ($compteur==0) {
        echo "Cet élève n'est inscrit à aucune séance. La procédure de desinscription a été annulée.";
      }
      else {
        echo "<p> A quelle séance souhaitez-vous desinscrire l'élève? </p>";

        echo"<form method='POST' action='desinscrire_seance_suite.php'>";
        echo"<table>";

        //l'utilisateur choisit une séance
        echo"<tr><th> Séances : </th></tr>";
        echo"<tr><td><select name='menuChoixSeance' size='6' required>";
        while ($row=mysqli_fetch_array($result, MYSQLI_NUM)) {
          echo "<option value=$row[0]>";
          echo "$row[2] ($row[1])";
          echo "</option>";
        }
        echo "</select></td></tr>";
        echo "<input type='hidden' name='menuChoixEleve' value='$ideleve'>";
        echo "</table>";
        echo "<br>";
        echo '<input type="submit" value="Desinscrire l\'élève">';
        echo"</form>";
      }
      mysqli_close($connect);
    ?>
  </body>
</html>
