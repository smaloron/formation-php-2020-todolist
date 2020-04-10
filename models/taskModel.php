<?php

function getAllCategories(PDO $pdo): array {
    $recordset = $pdo->query("SELECT * FROM categories");
    return $recordset->fetchAll();
}

function getAllStatuses(PDO $pdo): array {
    $recordset = $pdo->query("SELECT * FROM task_status");
    return $recordset->fetchAll();
}

function insertTask(array $task, PDO $pdo): int{
    $sql = "INSERT INTO tasks (title, due_date, category_id, status_id, completion_rate)
            VALUES (:title, :dueDate, :category, :status, :completion)";
    $statement = $pdo->prepare($sql);
    $statement->execute($task);
    return $pdo->lastInsertId();
}

function updateTask(array $task, PDO $pdo){
    $sql = "UPDATE tasks SET title=:title, due_date=:dueDate, category_id=:category,
                            status_id=:status, completion_rate=:completion
                            WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute($task);
}

function getTask($id, PDO $pdo): array{
    $sql = "SELECT  title, due_date as dueDate, 
                    category_id as category, status_id as status,
                    completion_rate as completion 
                    FROM tasks WHERE id= ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);
    return $statement->fetch();
}

function validateTask(array $task): array{
    $errors = [];

    if(empty($task["title"])){
        array_push($errors, "Le titre ne peut être vide");
    }

    if( strtotime($task["dueDate"]) < strtotime("now")){
        array_push($errors, "La date d'échéance doit être postérieure à la date du jour");
    }

    return $errors;
}
