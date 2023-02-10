<?php
// Ce fichier reçoit les données en json et enregistre le message
session_start();

// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On vérifie si l'utilisateur est connecté
    if(isset($_SESSION['user']['id'])){
        // L'utilisateur est connecté
        $user_id = $_SESSION['user']['id'];
    }else{
        // Non connecté
        // On utilise l'utilisateur avec l'id 1 (invité)
        $user_id = 1;
    }
    // On récupère le message
    $donneesJson = file_get_contents('php://input');

    // On convertit les données en objet PHP
    $donnees = json_decode($donneesJson, true);

    // On vérifie si on a un message
    if(isset($donnees['message']) && !empty($donnees['message'])){
        // On a un message
        // On le stocke
        // On se connecte
        require_once('../inc/bdd.php');

        // On écrit la requête
        $sql = 'INSERT INTO `messages`(`message`, `users_id`) VALUES (:message, :user);';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(':message', strip_tags($donnees['message']), PDO::PARAM_STR);
        $query->bindValue(':user', $user_id, PDO::PARAM_INT);

        // On exécute en vérifiant si ça fonctionne
        if($query->execute()){
            http_response_code(201);
            echo json_encode(['message' => 'Enregistrement effectué']);
        }else{
            http_response_code(400);
            echo json_encode(['message' => 'Une erreur est survenue']);
        }
    }else{
        // Pas de message
        http_response_code(400);
        echo json_encode(['message' => 'Le message est vide']);
    }
}else{
    // Méthode incorrecte
    http_response_code(405);
    echo json_encode(['message' => 'Méthode non autorisée']);
}
?>
