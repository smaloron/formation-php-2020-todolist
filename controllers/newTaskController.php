<?php

/***************************************
 * Initialisation des variables
 ***************************************/
$errors = [];
$task = [];

/***************************************
 * Traitement du formulaire
 ***************************************/

 // Les données ont elles ete postées
 $isPosted = filter_has_var(INPUT_POST, "submit");

 if($isPosted){
     //Récupération de la saisie
     $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
     $dueDate = filter_input(INPUT_POST, "dueDate", FILTER_SANITIZE_NUMBER_INT);
     $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
     $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT);
     $completion = filter_input(INPUT_POST, "completion", FILTER_SANITIZE_NUMBER_INT);


     //Insertion dans la BD
     $task = [
         "title"        => $title,
         "dueDate"      => $dueDate,
         "category"     => $category,
         "status"       => $status,
         "completion"   => $completion
     ];

     $errors = validateTask($task);

     if(count($errors) == 0){
        insertTask($task, $pdo);
        //Redirection vers la liste des tâches
        header("location:/?route=taskList");
     }
 }

/***************************************
 * Affichage du formulaire
 ***************************************/
$categoryList = getAllCategories($pdo);
$statusList = getAllStatuses($pdo);

$pageTitle = "Nouvelle tâche";
$content = "newTask";

require "../views/baseLayout.php";