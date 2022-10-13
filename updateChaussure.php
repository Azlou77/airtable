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



<nav class="navbar navbar-expand-lg navbar-light bg-light">
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



<div class="center">

<?php




$curl = curl_init();
//Spécifie l'url sur laquelle pointee
curl_setopt($curl, CURLOPT_URL, 'https://api.airtable.com/v0/app708JRaOzw9xfPE/Chaussure?view=GridC');
//Evite d'afficher sur la page le résultat
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$authorizations= "Authorization: Bearer keyjj7aYK1mVu0ngx";
curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-type: application /json', $authorizations) );
//Execute la session cURL
$resultat= curl_exec($curl);
//Ferme la session cURL
curl_close($curl);
//Converti le PHP en JSON
$resultat= json_decode($resultat);


echo '<table>';
echo '<tr>';
echo '<th>' . 'Nom' . '</th>';
echo '<th>' . 'Taille' . '</th>';
echo '<th>' . 'Prix' . '</th>';
echo '<th>' . 'Quantite' . '</th>';
echo '<th>' . 'Description' . '</th>';
echo '<th>' . 'Marque' . '</th>';

echo '</tr>';

// remplissage tableau suivant la requête
// chaque élement de "fields" récupérer est placer dans une case du tableau
foreach($resultat->records as $res){ 
    echo '<tr>';
    echo '<td value="'. $res->fields->NomCh .'">' . $res->fields->NomCh. '</td>';   
    echo '<td value="'. $res->fields->Taille . '">' . $res->fields->Taille . '</td>';
    echo '<td value="'. $res->fields->Prix . '">' . $res->fields->Prix . '</td>';
    echo '<td value="'. $res->fields->Quantite . '">' . $res->fields->Quantite . '</td>';
    echo '<td value="'. $res->fields->Description . '">' . $res->fields->Description . '</td>';
    echo '<td value="'. $res->fields->Marque . '">' . $res->fields->Marque . '</td>';
    ?>
    <td>
        <button onclick="getdata(this, '<?= $res->id ?>')" id="btn_modif"class="btn btn-primary" type="button" data-toggle="modal" data-target="#modifier">Modifier</button>
    </td>
    <?php
    echo '</tr>';
}
echo '</table>';

?>


<!-- modale pour afficher les donées  -->
<div class="modal fade" id="modifier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Produits :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <label >Entrer le Nom</label>
            <input type="text" class="form-control" id="NomCh"  placeholder="Entrer le Nom">
        </div>

        <div class="form-group">
            <label >Entrer la Taille</label>
            <input type="text" class="form-control" id="Taille"  placeholder="Entrer la Taille">
        </div>

        <div class="form-group">
            <label >Entrer le Prix</label>
            <input type="text" class="form-control" id="Prix"  placeholder="Entrer le Prix">
        </div>

        <div class="form-group">
            <label >Entrer la Quantite</label>
            <input type="text" class="form-control" id="Quantite"  placeholder="Entrer la Quantite">
        </div>

        <div class="form-group">
            <label >Entrer la Description</label>
            <input type="text" class="form-control" id="Description"  placeholder="Entrer la Description">
        </div>

        <div class="form-group">
            <label >Entrer la Marque</label>
            <input type="text" class="form-control" id="Marque"  placeholder="Entrer la Marque">
            <input type="hidden" id="id">
        </div>
       
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="modifier()" class="btn btn-primary">Enregistrer les modification</button>
      </div>
    </div>
  </div>
</div>
<!-- modale pour afficher les donées  -->

<script>
            const API_KEY = 'keyjj7aYK1mVu0ngx';
            const URL = `https://api.airtable.com/v0/app708JRaOzw9xfPE/Produits?view=Grid&api_key=${API_KEY}`;
    function getdata(obj, id){
        document.getElementById("NomCh").value = (obj.parentNode).parentNode.children.item(0).getAttribute('value') 
        document.getElementById("Taille").value = (obj.parentNode).parentNode.children.item(1).getAttribute('value')
        document.getElementById("Prix").value = (obj.parentNode).parentNode.children.item(2).getAttribute('value')   
        document.getElementById("Quantite").value = (obj.parentNode).parentNode.children.item(3).getAttribute('value')
        document.getElementById("Description").value = (obj.parentNode).parentNode.children.item(4).getAttribute('value')
        document.getElementById("Marque").value = (obj.parentNode).parentNode.children.item(5).getAttribute('value')
        document.getElementById('id').value = id
    }

    function modifier(){
        const API_KEY = 'keyjj7aYK1mVu0ngx';
            const URL = `https://api.airtable.com/v0/app708JRaOzw9xfPE/Chaussure?view=GridC&api_key=${API_KEY}`;
        let data = { 
            'records':[{
                "id": document.getElementById("id").value,
                'fields':{
                    //'marque':document.getElementById("Marque").value,
                    'NomCh':document.getElementById('NomCh').value,
                    //'Type':document.getElementById('Moteur').value,
                    'Taille'  :document.getElementById('Taille').value,
                    'Prix'  :parseFloat(document.getElementById('Prix').value),
                    'Quantite'  :parseFloat(document.getElementById('Quantite').value),
                    'Description' :document.getElementById('Description').value,
                    'Marque' :document.getElementById('Marque').value,
                }
            }]
        
         }
         console.log(data)
                fetch(URL,{
            method: 'PATCH',
            headers: {'Content-Type': 'application/json'},
            body:JSON.stringify(data),
            })
            .then((response)=>{
            if(response.ok){
                response.json().then((data) => {    
                console.log(data);
                document.location.reload();
                alert("Modification réalisé avec succès !");
                })
            }else{
                console.log('Erreur statut !=200');
                alert("Erreur dans la Modification");

            }
            }).catch((error) =>{
            console.log(`Erreur: ${error.message}`);
                        })
    }


</script>

</div>

</body>
</html>