 CREATE TABLE person (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    fullname varchar(60) NOT NULL,
    email varchar(70) UNIQUE NOT NULL,
    phone INT NOT NULL,
    experience INT NOT NULL,
    tarif DECIMAL NOT NULL,
    speciality text SET NULL,
    consultate_online ENUM ('yes', 'no') DEFAULT 'no'
    type_actes ENUM ('signification', 'excecution', 'constat'),
    ville_id int,
    FOREIGN KEY (ville_id) REFERENCES ville(id) ON DELETE CASCADE 
)


CREATE TABLE ville (
    id INT NOT PRIMARY KEY AUTO_INCREMENT
    nom varchar(50) NOT NULL
)





SELECT FROM nom joueur 


SELECT * FROM joueur
JOIN equipe ON joueur.equipe_id = equipe.id



SELECT * FROM joueur WHERE equipe_id IS NULL


SELECT e.name FROM equipe e
JOIN match m ON equipe_id = 