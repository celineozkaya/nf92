<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Visualisation du calendrier d'un élève </h1>
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

      //recuperation des informations du formulaire
      $ideleve=$_POST['menuChoixEleve'];

      //recuperation des séances pas encore faites par l'élève
      $query = "SELECT * FROM inscription INNER JOIN seances ON inscription.idseance = seances.idseance INNER JOIN themes ON seances.idtheme = themes.idtheme WHERE ideleve=$ideleve AND dateSeance > '$dateJour'";
      $result = mysqli_query($connect,$query);
      if (!$result) {
        echo "<br>Erreur: ".mysqli_error($connect);
        exit;
      }

      //construction du tableau affichant le calendrier
      echo "<table>";
      echo "<tr><th>Séance(s) à faire :</th><th>Date de la séance :</th></tr>";
      while ($row=mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<tr><td>$row[8]</td><td>$row[4]</td></tr>";
      }
      echo "</table>";

      mysqli_close($connect);
    ?>
  </body>
</html>
