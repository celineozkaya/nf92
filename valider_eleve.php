<html>
  <head>
      <link rel="stylesheet" href="feuille_de_style.css" />
      <meta charset="utf-8">
  </head>
  <body>
    <h1>Ajout d'un nouvel élève</h1>

      <?php

        //connexion a la bdd
        $dbhost = 'tuxa.sme.utc';
        $dbuser = 'nf92a060';
        $dbpass = '0tWFmzHS';
        $dbname = 'nf92a060';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

        //encodage : UTF-8
        mysqli_set_charset($connect, 'utf8');

        //date du jour
        date_default_timezone_set('Europe/Paris');
        $dateJour = date("Y-m-d");

        //recupération des infos du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $daten = $_POST['daten'];
        $choix = $_POST['choix'];

        //on ajoute l'élève homonyme si l'utilisateur confirme cette volonté
        if($choix=='oui'){
          $query="INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$daten', '$dateJour')";
          //echo "<br> $query<br>";
          $result=mysqli_query($connect, $query);
          if (!$result) {
            echo "<br> erreur  ".mysqli_error($connect);
            exit;
          }
          echo "$nom $prenom a été ajouté(e).<br><br>";
          echo "<table>";
          echo "<tr><td>Nom :</td><td>$nom</td></tr>";
          echo "<tr><td>Prénom :</td><td>$prenom</td></tr>";
          echo "<tr><td>Date de naissance :</td><td>$daten</td></tr>";
          echo "<tr><td>Date d'inscription :</td><td>$dateJour</td></tr>";
          echo "</table>";

          }
          else{
            echo "<br><br>L'élève n'a pas été ajouté.";
          }

        mysqli_close($connect);
      ?>
  </body>
</html>
