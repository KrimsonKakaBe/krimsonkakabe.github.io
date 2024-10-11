-- Création de la base de données
CREATE DATABASE voandalana;

-- Utilisation de la base de données
USE voandalana;

-- Création de la table d'utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
);

-- Insertion d'un utilisateur (remplacez le mot de passe par un hachage en production)
INSERT INTO utilisateurs (email, mot_de_passe) VALUES ('user@example.com', 'password123');
