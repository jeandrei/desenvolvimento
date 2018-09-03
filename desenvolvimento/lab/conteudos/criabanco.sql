
/*CRIE O BANCO DE DADOS labdb e depois execute esta sql


Criar um usuário para ter acesso a um determinado banco de dados.

sudo mysql -u root -p
GRANT ALL PRIVILEGES ON labdb.* TO 'labdbuser'@'localhost' IDENTIFIED BY 'proinfourbano';
para mostrar se criou 
SHOW GRANTS FOR 'labdbuser'@'localhost';
para logar com o usuário no banco específico
mysql -u labdbuser -p labdb
senha:proinfourbano
*/

CREATE TABLE user (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
email VARCHAR(255) UNIQUE,
password CHAR(32)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;


CREATE TABLE role (
id VARCHAR(255) NOT NULL PRIMARY KEY,
description VARCHAR(255)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE userrole (
userid INT NOT NULL,
roleid VARCHAR(255) NOT NULL,
PRIMARY KEY (userid, roleid)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE webaddress(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
userid INT NOT NULL,
address VARCHAR(255),
description VARCHAR(255),
objective VARCHAR(355)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;


# Sample data
# We specify the IDs so they are known when we add related entries
INSERT INTO user (id, name, email, password) VALUES
(1, 'Jeandrei Walter', 'jeandreiwalter@gmail.com','579d6a5205364b0bc7eb5038db7362af');
INSERT INTO user (id, name, email, password) VALUES
(2, 'Joan Smith', 'joan@example.com', '579d6a5205364b0bc7eb5038db7362af');
#(2, 'Joan Smith', 'joan@example.com', MD5('passwordlabdb'));

INSERT INTO role (id, description) VALUES
('Content Editor', 'Add, remove, and edit jokes'),
('Account Administrator', 'Add, remove, and edit authors'),
('Site Administrator', 'Add, remove, and edit categories');

INSERT INTO webaddress (userid, address, description, objective) VALUES (1,'www.google.com.br', 'Google','Efetuar pesquisas na web e produção de trabalhos');
INSERT INTO webaddress (userid, address, description, objective) VALUES (1,'www.atividadeseducativas.com.br', 'Atividades Educativas','Várias atividades educativas que auxiliam na aprendizagem');
INSERT INTO webaddress (userid, address, description, objective) VALUES (1,'www.jogoseducativos.hvirtua.com', 'Jogos educativos hvirtua','Uma grande quantidade de jogos educativos das mais diversas disciplinas');
INSERT INTO webaddress (userid, address, description, objective) VALUES (2,'www.yahoo.com.br', 'Yahoo','Site de entretenimento');


INSERT INTO userrole (userid, roleid) VALUES (1, 'Account Administrator');
