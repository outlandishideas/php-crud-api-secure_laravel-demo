DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id           INT NOT NULL PRIMARY KEY,
    display_name TEXT,
    password     TEXT,
    email        TEXT
);

INSERT INTO users (id, display_name, password, email)
VALUES (1, 'harry', 'password123', 'harry@outlandish.com');

INSERT INTO users (id, display_name, password, email)
VALUES (2, 'randomMan', 'password456', 'random@man.com');

DROP TABLE IF EXISTS pets;
CREATE TABLE pets
(
    id             INTEGER PRIMARY KEY AUTOINCREMENT,
    name           TEXT,
    favourite_food TEXT,
    species        TEXT,
    owner          INT,
    FOREIGN KEY (owner) REFERENCES users (id)
);


INSERT INTO pets (id, name, favourite_food, species, owner)
VALUES (1, 'timmy', 'lettuce', 'snail', 1);

INSERT INTO pets (id, name, favourite_food, species, owner)
VALUES (2, 'jimbo', 'sugar', 'ant', 1);

INSERT INTO pets (id, name, favourite_food, species, owner)
VALUES (3, 'fido', 'snails', 'dog', 2);
