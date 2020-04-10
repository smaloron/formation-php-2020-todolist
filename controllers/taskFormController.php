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

 $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

 if(! empty($id) && ! $isPosted){
     $task = getTask($id, $pdo);
 }

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
         if(empty($id)){
            insertTask($task, $pdo);
         } else {
             $task["id"] = $id;

             if($task["status"] == 2){
                 $task["completion"] = 100;
             } else if($task["completion"] = 100){
                $task["status"] = 2;
             }

             updateTask($task, $pdo);
         }
        
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
$content = "taskForm";

require "../views/baseLayout.php";