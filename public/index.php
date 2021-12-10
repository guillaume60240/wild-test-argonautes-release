
<?php
require '../src/database/connexion.php';
require '../src/database/requetes.php';

$error = null;
$success = null;

//création de la connexion à base de données 
$db = getPDO();

//création de la requête SQL pour récupérer la liste des argonautes
$argonautes = getAllArgonautes($db);

//écoute de la requête POST pour la création d'un nouvel argonaute
if (isset($_POST['name'])){
    $name = htmlspecialchars($_POST['name']);
    $ifExist = findByName($name, $db);
    if (!$ifExist){
        $pattern = '/^[a-zA-Z\s]{2,}$/';
        if (strlen($name) < 2 || strlen($name) > 50 || !preg_match($pattern, $name)) {
            $error = '<div class="alert alert-danger text-center">Merci de rentrer un nom valide !</div>';
        } else {
            $argonaute = createArgonaute($name, $db);
            $argonautes = getAllArgonautes($db);
            $success = '<div class="alert alert-success text-center">L\' argonaute a bien été ajouté</div>';
        }
    } else{
        $error = '<div class="alert alert-danger text-center">L\'argonaute existe déjà !</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Le voyage de Jason</title>
</head>
<body>
    <?php include_once '../src/template/partials/header.php'; ?>

    <!-- Main section -->
  <main>
    <div class="ms-5 me-5">

      <h2 class="mt-3 mb-3">Ajouter un(e) Argonaute</h2>
      <!-- Affichage des erreurs -->
      <?php
        if ($error) {
          echo $error;
        } 
        if ($success) {
          echo $success;
        } 
      ?>
      <!-- formulaire -->
      <?php include '../src/template/partials/form.php'; ?>
      
      <!-- Member list -->
      <h2 class="mt-3">Membres de l'équipage</h2><hr>
      <section class="row text-center">
        <?php
            foreach ($argonautes as $argonaute) {
                require '../src/template/partials/list.php';
            }

        ?>
      </section>
    </div>
  </main>

    <?php include_once '../src/template/partials/footer.php'; ?>
</body>
</html>