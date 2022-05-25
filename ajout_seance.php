<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <h1> Ajout d'une nouvelle séance </h1>
    <?php
      //connexion à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Erreur de connection a mysql');

      //les données envoyées vers mysql sont encodées en UTF-8
      mysqli_set_charset($connect, 'utf8');

      //selection des thèmes actifs
      $query = "SELECT * FROM themes where supprime=0";
      //echo "<br>$query<br>";
      $result = mysqli_query($connect,$query);
      if (!$result){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }

      echo "Veuillez choisir le thème de la séance :";
      echo "<BR><BR>";

      //création du formulaire
      echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
      echo "<select name='menuChoixTheme' size= '4' required>";

      //on affiche ligne par ligne les différents thèmes de la bdd
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo "<option value='$row[0]'>";
        echo "$row[1]";
        echo "</option>";
      }

      echo "</select>";
      echo "<br><br>";
      echo "Date de la séance : <INPUT type='date' name='DateSeance' required>";
      echo "<br><br>";
      echo "Effectif maximal : <INPUT type='number' name='effectif' value='10' required >";
      echo "<br><br>";
      echo "<INPUT type='submit' value='Enregistrer la séance'>";
      echo "</FORM>";

      mysqli_close($connect);
    ?>
  </body>
</html>
