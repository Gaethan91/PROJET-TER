CREATE TABLE utilisateurs (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    mot_de_passe VARCHAR(60)
);

CREATE TABLE postits (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50) NOT NULL,
    contenu VARCHAR(255),
    date_creation DATETIME,
    date_derniere_modif DATETIME,
    createur_id INT,
    FOREIGN KEY (createur_id) REFERENCES utilisateurs(id)
);

CREATE TABLE partages (
    id_share INT AUTO_INCREMENT PRIMARY KEY,
    postit_id INT,
    destinataire_id INT,
    FOREIGN KEY (postit_id) REFERENCES postits(id),
    FOREIGN KEY (destinataire_id) REFERENCES utilisateurs(id)
);
