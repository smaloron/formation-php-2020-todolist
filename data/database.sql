-- Suppression de la BD si elle existe
-- permet de rééxécuter le script en partant d'une base vierge
DROP DATABASE IF EXISTS todolist;

-- Création de la BD
CREATE DATABASE todolist DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Ouverture de la base de données
USE todolist;

-- Création de la table des catégorie
CREATE TABLE categories (
    id TINYINT UNSIGNED AUTO_INCREMENT,
    category_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

-- Création de la table des statuts
CREATE TABLE task_status (
    id TINYINT UNSIGNED AUTO_INCREMENT,
    status_name VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);

-- Création de la table des tâches
CREATE TABLE tasks (
    id INT UNSIGNED AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    due_date DATE,
    completion_rate TINYINT UNSIGNED NOT NULL 
        DEFAULT 0,
    category_id TINYINT UNSIGNED NOT NULL,
    status_id TINYINT UNSIGNED NOT NULL 
        DEFAULT 1,
    PRIMARY KEY (id),
    CONSTRAINT categories_to_tasks
        FOREIGN KEY (category_id)
        REFERENCES categories(id),
    CONSTRAINT status_to_tasks
        FOREIGN KEY (status_id)
        REFERENCES task_status(id)
);

-- Insertion de catégories
INSERT INTO categories (category_name)
    VALUES ('courses'), ('travail'), ('loisirs'), ('santé');

-- Insertion des statuts
INSERT INTO task_status (status_name) VALUES
    ('en cours'), ('terminée'), ('annulée');

-- Insertion de tâches
INSERT INTO tasks (title, due_date, completion_rate, category_id)
VALUES
('Acheter du lait', '2020-4-11', 0, 1),
('Faire des pompes', NULL, 0, 4);

-- Création d'une vue pour faciliter les requêtes dans l'application php
CREATE OR REPLACE VIEW view_tasks AS
    SELECT tasks.*, categories.category_name, 
            task_status.status_name
    FROM tasks
        INNER JOIN categories 
            ON categories.id = tasks.category_id
        INNER JOIN task_status 
            ON task_status.id = tasks.status_id;



