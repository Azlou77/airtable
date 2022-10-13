

<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title> Accueil</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-succes">
  <a class="navbar-brand" href="index.php">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="vetement.php">Vetement</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="chaussure.php">Chaussure</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="logout.php">Deconnexion </a>
      </li>
    </ul>
  </div>
</nav>


<div class="p-3 mb-2 bg-light text-dark">


<div class="container center">
  <div class="row">
    <div class="col">    
    <br>
    <?php

//initialisation de curl
$curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'https://api.airtable.com/v0/app708JRaOzw9xfPE/chaussure?view=GridC');


//Evite d'afficher sur la page le résultat
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


$authorization= "Authorization: Bearer keyjj7aYK1mVu0ngx";
curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-type: application /json', $authorization) );


//Execute la session cURL
$resultat= curl_exec($curl);

//Ferme la session cURL
curl_close($curl);

//Converti le PHP en JSON
$resultat= json_decode($resultat);


foreach ($resultat->records as $record) { 
   echo ' <h3><a href="detailC.php?id='.$record->id.'"><span class="badge badge-secondary">'.$record->fields->NomCh.'</span></h3></a>';

   echo '<p> Details du Produit :
    Quantité : '.$record->fields->Quantite.'<br>
    Prix : '.$record->fields->Prix.'€<br>
    Marque : '.$record->fields->Marque.'<br>
    Description : '.$record->fields->Description.'<br> 
 
 
    </p>';
}



?>



    </div>
    <div class="col">
     
    

<br>

<?php

//initialisation de curl
$curll = curl_init();


//Spécifie l'url sur laquelle pointee
curl_setopt($curll, CURLOPT_URL, 'https://api.airtable.com/v0/app708JRaOzw9xfPE/Produits?view=Grid');


//Evite d'afficher sur la page le résultat
curl_setopt($curll, CURLOPT_RETURNTRANSFER, true);


$authorizations= "Authorization: Bearer keyjj7aYK1mVu0ngx";
curl_setopt($curll, CURLOPT_HTTPHEADER,array('Content-type: application /json', $authorizations) );


//Execute la session cURL
$resultats= curl_exec($curll);

//Ferme la session cURL
curl_close($curll);

//Converti le PHP en JSON
$resultats= json_decode($resultats);


foreach ($resultats->records as $recordd) {
   echo ' <h3><a href="datailV.php?id='.$recordd->id.'"><span class="badge badge-secondary">'.$recordd->fields->Nom.'</span></h3></a>';
   echo '<p> Details du Produit :
    Quantité : '.$recordd->fields->Quantite.'<br>
    Prix : '.$recordd->fields->Prix.'€<br>
    Type de vetement : '.$recordd->fields->Type.'<br> 
    Description : '.$recordd->fields->Description.'<br>  
    </p>';
}

?>


    </div>
</div>
</div>
</div>
</body>
</html>