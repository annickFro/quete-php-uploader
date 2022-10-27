<?php 

// Je vérifie si le formulaire est soumis comme d'habitude
if($_SERVER['REQUEST_METHOD'] === "POST"){ 

    var_dump($_POST) ;

    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = '/public/uploads/';
    $uploadDir = 'img/';
    // le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    // Je récupère l'extension du fichier
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    // Les extensions autorisées
    $authorizedExtensions = ['jpg','jpeg','png'];
    // Le poids max géré par PHP par défaut est de 2M
    $maxFileSize = 2000000;
    
    // Je sécurise et effectue mes tests

    /****** Si l'extension est autorisée *************/
    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 2M !";
    }


    /****** Si je n'ai pas d"erreur alors j'upload *************/
    /** SCRIPT D'UPLOAD ***/

    echo "1 -> " . $_FILES['avatar']['tmp_name'] ;
    // echo "<img src = ". $_FILES['avatar']['tmp_name'] ;
    
    echo "2 -> " . $uploadDir ;
    echo "3 -> " .  $_FILES['avatar']['name'] ;


    // var_dump($_POST) ;

    if (empty($errors)) {
        $ret = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        
        echo "4 -> " .  $ret ;
        if ($ret == true) {
            echo "copie ok." ;
        } else {
            echo "copie NOK !" ;
        }
    } else {
        echo "Err !" ;
    }

    // var_dump($_POST) ;
    // var_dump($_SERVER) ;
    
    
}





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Upload.</h1>
    
    <!-- <img src="<?php echo $_FILES['avatar']['tmp_name']; ?>" -->

    <!-- TODO Comment afficher l'image sélectionnée ? -->
    
    <form method="post" enctype="multipart/form-data">
        <p>
        <label for="imageUpload">Upload an profile image</label>
        </p>
        <p>    
        <input type="file" name="avatar" id="imageUpload" />
        </p>
        <p>
        <button name="send">Send</button>
        </p>
    </form>
    <div >
    </div>

   
    
    

</body>
</html>