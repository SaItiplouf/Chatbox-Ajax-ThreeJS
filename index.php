<?php session_start()?>
<div id="vantajs">
<?php include_once('inc/header.php');
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
     // Ici, l'utilisateur est connecté
?>

<div class="d-flex align-items-start my-2">
    <div class="col-4">
      <h2 class="align-self-center m-0 mr-1 mt-2 mr-5 bjr">Bonjour <strong><br><?= $_SESSION['user']['pseudo'] ?></strong></h2>
    </div>    
    <div class="col-1 pe-1">
      <a class="btn btn-danger mt-1 boutondeco" href="deconnexion.php">Déconnexion</a>
</div>
</div>
    <?php
}else{
    // Ici l'utilisateur n'est pas connecté
    ?>
<div class="d-flex align-items-start my-2">
  <div class="col-1">
    <a class="btn btn-primary" href="connexion.php">Connexion</a>
  </div>
  <div class="col-2">
    <a class="btn btn-primary mx-3" href="inscription.php">Inscription</a>
  </div>
</div>
  <?php
}
?>

    <div class="p" id="discussion">
    </div>

<div class="saisie">
    <div class="input-group">
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
            <input type="text" class="inputtext1" id="texte" placeholder="Entrez votre texte">
        <?php } else { ?>

            <input type="text" class="inputguestcr" id="user" placeholder="Guest" disabled="disabled">
        
            <input type="text" class="inputtext2" id="texte" placeholder="Entrez votre texte">
        <?php } ?>
            <span class="spanbuttonvalider" id="valid"><i class="la la-check"></i></span>
          </div>
    </div>
</div>

<?php
include_once('inc/footer.php');
?>

<!-- partial:index.partial.html -->
<div id="vantajs">
  <h1>Animated Globe - Vanta JS</h1>
</div>
</div>
<!-- partial -->
  
<script src='https://yandex.st/highlightjs/8.0/highlight.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/r123/three.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.21/vanta.globe.min.js'></script><script  src="./js/vanta.js"></script>


<link rel='stylesheet' href='https://yandex.st/highlightjs/8.0/styles/vs.min.css'><link rel="stylesheet" href="./css/style.css">
