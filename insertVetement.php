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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
    <title> Ajouter des Vetements</title>

</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Accueil</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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


  <div class="p-3 mb-2 bg-light text-dark center">

  <div class="p-3 mb-2 bg-light text-dark">

    <br><div class="center">
    <h2><span class="badge badge-secondary">Ajouter des Vetements </span></h2><br>
</div>

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

foreach ($resultats->records as $record) {
  $varNom = '<p>'.$record->fields->Nom.'</p>';
  $varTaille = ' <p>'.$record->fields->Taille.'</p>';


   echo '

 <div class="table">
 <div class="thead-light">
 <div class="container">
  <div class="row thead-light">
    <div class="col-sm">
    '.$record->fields->Nom.'
    </div>
    <div class="col-sm">
    '.$record->fields->Taille.'
    </div>
    <div class="col-sm">
    '.$record->fields->Prix.'
    </div>
    <div class="col-sm">
    '.$record->fields->Quantite.'
    </div>
    <div class="col-sm">
    '.$record->fields->Description.'
    </div>
    <div class="col-sm">
    '.$record->fields->Type.'
    </div>
  </div>
</div>
 </div>
 </div>
 ';

}
?>
<br><br>
<br><div class="center">
    <h2><span class="badge badge-secondary">Remplire Le Formulaire</span></h2><br>
</div>

<div class="center">

<div class="row">
  <div class="col">  <div class="form-group">
    <label>Ajouter un Nom :   </label><br>
    <input type="text" placeholder="Nom" id="in1"><br>
  </div></div>
  <div class="col">  <div class="form-group">
  <label>Ajouter un Taille : </label><br>
    <input type="text" placeholder="Taille" id="in2"><br>
  </div></div>
  <div class="col">
  <div class="form-group">
  <label>Ajouter un Prix : </label><br>
    <input type="number" placeholder="Prix" id="in3"><br>
  </div></div>
  <div class="col">
  <div class="form-group">
  <label>Ajouter un Quantite : </label>
    <input type="number" placeholder="Quantite" id="in4"><br>
  </div></div>
</div>
<br>
<div class="row">
  <div class="col-4">  <label>Ajouter un Description : </label><br>  
    <input type="text" placeholder="Description" id="in5"><br>  
</div>
  <div class="col-8">  
    <div class="form-group">
    <div class="form-group">
    <label for="exampleFormControlSelect2">Selectionner un type : </label>
    <select class="form-control" id="in6">
      <option>Jean</option>
      <option>Veste</option>
      <option>Survetement</option>
      <option>Teeshirt</option>
      <option>Chemise</option>
    </select>
</div>
</div>
</div>

    </div>
    <div class="row">
  <div class="col-sm"></div>
  <div class="col-sm">        
    <button type="button" onclick="getValue();" class="btn btn-primary"  data-dismiss="modal">Enregistrer</button>
</div>
  <div class="col-sm"></div>
</div>
    <script>

        function getValue() {
            // Sélectionner l'élément input et récupérer sa valeur
            input1 = document.getElementById("in1").value;
            input2 = document.getElementById("in2").value;
            input3 = parseFloat(document.getElementById("in3").value);
            input4 = parseFloat(document.getElementById("in4").value);
            input5 = document.getElementById("in5").value;
            input6 = document.getElementById("in6").value;

        
            let data = {
                'records': [{
                    'fields': {
                        'Nom' : input1,
                        'Taille': input2,                         
                        'Prix': input3,
                        'Quantite': input4,
                        'Description': input5,
                        'Type': input6
                    }
                }]
            }
            
            const API_KEY = 'keyjj7aYK1mVu0ngx';
            const URL = `https://api.airtable.com/v0/app708JRaOzw9xfPE/Produits?view=Grid&api_key=${API_KEY}`;


            fetch(URL, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data),
            })  
                .then((response) => {
                    if (response.ok) {
                        response.json().then((data) => {
                            console.log(data);
                            document.location.reload();
                            alert(" Votre article a été ajouté avec SUCCES !");                           
                          })
                    } else {
                        console.log('Erreur statut !=200');
                    }
                }).catch((error) => {
                    console.log(`Erreur: ${error.message}`);
                })

        }


    </script>





</div >
</body>

</html>