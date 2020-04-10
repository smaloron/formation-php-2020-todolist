<?php

// Récupération du contrôleur à executer
$route = filter_input(INPUT_GET, "route") ?? "taskList";

//Constitution du chemin vers le fichier du contrôleur
$controllerPath = "../controllers/{$route}Controller.php";

//Gestion d'erreur si le fichier contrôleur demandé est absent
if(! file_exists($controllerPath)){
    $errorMessage = "Fichier introuvable";
    $controllerPath = "../controllers/errorController.php";
}

//Ouverture de la connexion à la base de données
$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=todolist;charset=utf8",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

//Exécution du contrôleur
require $controllerPath;