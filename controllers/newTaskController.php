<?php

$categoryList = getAllCategories($pdo);
$statusList = getAllStatuses($pdo);

$pageTitle = "Nouvelle tâche";
$content = "newTask";

require "../views/baseLayout.php";