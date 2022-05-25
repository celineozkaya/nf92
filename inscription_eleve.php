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
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur lors de la connection à mysql');

      //encodage : UTF-8
      mysqli_set_charset($connect, 'utf8');

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $dateJour=date("Y-m-d");

      $q1="SELECT * from eleves";
      //echo "<br> $q1";
      $r1=mysqli_query($connect,$q1);
      if (!$r1) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      //selections des données pour inscrire un élève à une séance programmée
      $q2="SELECT idseance, DateSeance, nom FROM seances INNER JOIN themes ON seances.Idtheme=themes.Idtheme WHERE DateSeance>='$dateJour'";
      //echo "<br> $q2";
      $r2=mysqli_query($connect,$q2);
      if (!$r2) {
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo "<form method='POST' action='inscrire_eleve.php'>";
      echo "<table>";

      //l'utilisateur choisit un élève
      echo "<tr><th>Elève</th><th>Séance</th></tr>";
      echo "<br>";
      echo "<tr><td><select name='ideleve' size='4' required>";
      while ($rowEleve=mysqli_fetch_array($r1, MYSQLI_NUM)) {
        echo "<option value=$rowEleve[0]>";
        echo "$rowEleve[1] $rowEleve[2]";
        echo "</option>";
      }
      echo"</select></td>";


      //l'utilisateur choisit une séance
      echo"<td><select name='idseance' size='4' required>";
      while ($rowSeance=mysqli_fetch_array($r2, MYSQLI_NUM)) {
        echo "<option value=$rowSeance[0]>";
        echo "$rowSeance[1] : $rowSeance[2]";
        echo "</option>";
      }
      echo "</select></td></tr>";
      echo "</table>";
      echo "<br>";
      echo '<input type="submit" value="Inscrire l\'élève">';
      echo"</form>";

      mysqli_close($connect);
    ?>
  </body>
</html>
