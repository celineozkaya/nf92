<html>
  <head>
    <link rel="stylesheet" href="feuille_de_style.css">
    <meta charset = "utf-8">
  </head>

  <body>
    <h1> Ajout d'un nouveau thème </h1>
      <?php

      //connection à la bdd
      $dbhost = 'tuxa.sme.utc';
      $dbuser = 'nf92a060';
      $dbpass = '0tWFmzHS';
      $dbname = 'nf92a060';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      //les données envoyées vers mysql sont encodées en UTF-8
      mysqli_set_charset($connect, 'utf8');

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $date = date("Y-m-d");

      //recuperation des données du formulaire et affichage de ces données à l'écran
      $theme = $_POST["theme"];
      $descriptif = $_POST["descriptif"];

      $query1 = "SELECT * FROM themes WHERE nom='$theme' AND supprime=1";
      //echo "$query1";
      $result1 = mysqli_query($connect, $query1);
      if (!$result1){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }
      $compteur1 = mysqli_num_rows($result1);

      //un thème supprimé a-t-il le même nom? si oui, on le réactive
      if($compteur1==0){
        $query2 = "SELECT * FROM themes WHERE nom='$theme' AND supprime=0";
        //echo "$query2";
        $result2 = mysqli_query($connect, $query2);
        if (!$result2){
          echo "<br> erreur  ".mysqli_error($connect);
          exit;
        }
        $compteur2 = mysqli_num_rows($result2);

        //est ce que ce thème (actif) existe déjà? si non, on l'ajoute à la bdd
        if($compteur2==0){
          $query3 = "INSERT INTO themes VALUES (NULL, '$theme', 0, '$descriptif')";
          //echo "$query3";
          $result3 = mysqli_query($connect, $query3);
          if (!$result3){
            echo "<br> erreur  ".mysqli_error($connect);
            exit;
          }
          echo "<br> Le thème $theme a été ajouté à la base de donnée. En voici les informations : <br><br>";
          echo "<table>";
          echo "<tr><th>Nom :</th><td>$theme</td></tr>";
          echo "<tr><th>Descriptif :</th><td>$descriptif</td></tr>";
          echo "</table>";
        }
        else{
          echo "<br>Un thème ayant le même nom existe déjà, il n'a pas été ajouté.<br>";
        }
      }
      else{
        $query4 = "UPDATE themes SET supprime=0, descriptif='$descriptif' WHERE nom='$theme'";
        //echo "$query4";
        $result4 = mysqli_query($connect, $query4);
        if (!$result4){
          echo "<br> erreur  ".mysqli_error($connect);
          exit;
        }
        echo "<br>Le thème $theme a été réactivé. En voici les informations :<br>";
        echo "<table>";
        echo "<tr><td>Nom :</td><td>$theme</td></tr>";
        echo "<tr><td>Descriptif :</td><td>$descriptif</td></tr>";
        echo "</table>";
      }

      mysqli_close($connect);

      ?>
  </body>
</html>
