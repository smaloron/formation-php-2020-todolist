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

//Exécution du contrôleur
require $controllerPath;