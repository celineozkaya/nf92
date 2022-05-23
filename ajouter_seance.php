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
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

      //les données envoyées vers mysql sont encodées en UTF-8
      mysqli_set_charset($connect, 'utf8');

      //recuperation des données saisies dans le formulaire
      $dateSeance=$_POST['DateSeance'];
      $effectif=$_POST['effectif'];
      $idtheme=$_POST['menuChoixTheme'];

      //date du jour
      date_default_timezone_set('Europe/Paris');
      $dateJour=date("Y-m-d");

      //recupération du nom du thème selon son id
      $q1 ="SELECT nom from themes where idtheme=$idtheme";
      //echo "<br> $q1";
      $r1 = mysqli_query($connect, $q1);
      if (!$r1){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }
      $row=mysqli_fetch_array($r1, MYSQLI_NUM);
      $nomtheme=$row[0];

      //on cherche à vérifier l'existance d'une séance sur le thème selectionné à la même date
      $q2 ="SELECT * from seances where idtheme='$idtheme' and DateSeance='$dateSeance'";
      //echo "<br> $q2";
      $r2 = mysqli_query($connect, $q2);
      if (!$r2){
        echo "<br> erreur  ".mysqli_error($connect);
        exit;
      }
      $n=mysqli_num_rows($r2);

      //dans la positive, on annule la création de la séance
      if ($n!=0) {
        echo "Erreur : une séance portant sur le theme $nomtheme a déjà été programmé à la date $dateSeance.";
        exit;
      }
      else{
        //sinon on vérifie que la date saisie est postérieur à la date du jour
        if ($dateSeance<$dateJour){
          echo "Erreur : vous ne pouvez pas programmer une séance à une date antérieur à celle d'ajourd'hui.";
          exit;
        }
        else {
          //les confitions sont vérifiées, on créé la séance
          $query = "INSERT into seances values (NULL, '$dateSeance', '$effectif', '$idtheme')";
          //echo "<br>$query<br>";
          $result = mysqli_query($connect, $query);
          if (!$result){
            echo "<br> erreur ".mysqli_error($connect);
            exit;
          }

          //on confirme la création de la séance et on rappelle les données saisies
          echo "La séance a été programmée : <br><br>";
          echo "<table>";
          echo "<tr><th> Date de la séance </th><td> $dateSeance</td></tr>";
          echo "<tr><th> Thème de la séance </th><td> $nomtheme </td></tr>";
          echo "</table>";
        }
      }

      mysqli_close($connect);
    ?>
  </body>
</html>
