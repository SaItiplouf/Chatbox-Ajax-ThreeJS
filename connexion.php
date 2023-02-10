<?php
// On active l'accès à la session
session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/stylecssconnexion.css">
    <title>Connexion</title>
</head>

<?php

// Formulaire de connexion
// Doit afficher en haut de page "Vous êtes connecté(e)" si le mail et le mot de passe sont bons.
// Doit afficher en haut de page "Email et/ou mot de passe invalide" si le mail et le mot de passe ne sont pas bons.

// On vérifie que $_POST existe et qu'il n'est pas vide.
if(isset($_POST) && !empty($_POST)){

    // On vérifie que tous les champs sont remplis
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass'])){
        // On récupère les valeurs saisies
        $mail = strip_tags($_POST['email']);
        $pass = $_POST['pass'];

        // On vérifie si l'email existe dans la base de données
        // On se connecte à la base
        require_once('inc/bdd.php');

        // On écrit la requête
        $sql = 'SELECT * FROM `users` WHERE `email` = :email;';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte (terme scientifique) les valeurs
        $query->bindValue(':email', $mail, PDO::PARAM_STR);

        // On exécute la requête
        $query->execute();

        // On récupère les données
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Soit on a une réponse dans $user, soit non
        // On vérifie si on a une réponse
        if(!$user){
            echo 'Email et/ou mot de passe invalide';
        }else{
            // On vérifie que le mot de passe saisi correspond à celui en base
            // password_verify($passEnClairSaisi, $passBaseDeDonnees)
            if(password_verify($pass, $user['password'])){
                // On crée la session "user"
                // On ne stocke JAMAIS de données dont on ne maîtrise pas le contenu
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'email' => $user['email'],
                    'pseudo'  => $user['pseudo']
                ];

                header('Location: index.php');
            }else{
                echo 'Email et/ou mot de passe invalide';
            }
        }

    }else{
        echo "<p>Veuillez remplir tous les champs...</p>";
    }
}

include_once('inc/headerconnexion.php');
?>
<div class="col-12 my-1">
    <h1>Connexion</h1>
    <form method="post">
        <div class="form-group">
            <label for="email">E-mail :</label>
            <br>
            <input class="inputzz" type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="pass">Mot de passe :</label>
            <br>
            <input class="inputzz" type="password" id="pass" name="pass">
        </div>
        <button class="btn btn-primary">Me connecter</button>
    </form>
</div>
<?php
include_once('inc/footer.php');
