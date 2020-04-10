<?php

function getAllCategories(PDO $pdo): array {
    $recordset = $pdo->query("SELECT * FROM categories");
    return $recordset->fetchAll();
}

function getAllStatuses(PDO $pdo): array {
    $recordset = $pdo->query("SELECT * FROM task_status");
    return $recordset->fetchAll();
}