DROP TABLE users CASCADE;
DROP TABLE item_type CASCADE;
DROP TABLE items CASCADE;
DROP TABLE builds CASCADE;


CREATE TABLE users
(
    user_id SERIAL PRIMARY KEY,
    -- build_id INT REFERENCES builds NOT NULL,
    first_name VARCHAR(40),
    last_name VARCHAR(60),
    email VARCHAR(40) UNIQUE NOT NULL,
    password VARCHAR(60) NOT NULL
);

CREATE TABLE item_type
(
    item_type_id SERIAL PRIMARY KEY,
    item_type_name VARCHAR(40) NOT NULL
);

CREATE TABLE items
(
    item_id SERIAL PRIMARY KEY,
    item_type_id INT REFERENCES item_type,
    name VARCHAR(20) NOT NULL,
    description TEXT NOT NULL,
    price REAL NOT NULL,
    image_location VARCHAR(100)
);

CREATE TABLE builds
(
    build_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users NOT NULL,
    motherboard_id INT REFERENCES items,
    cpu_id INT REFERENCES items,
    gpu_id INT REFERENCES items,
    gpu_count int REFERENCES items,
    fan_id INT REFERENCES items,
    fan_count INT,
    memory_id INT REFERENCES items,
    memory_count INT,
    storage_id INT REFERENCES items,
    tower_id INT REFERENCES items,
    psu_id INT REFERENCES items
);

ALTER TABLE users ADD build_id INT REFERENCES builds;


-- START ADDING VALUES!
INSERT INTO item_type(item_type_name) VALUES('motherboard'),
                                        ('cpu'),
                                        ('gpu'),
                                        ('storage'),
                                        ('memory'),
                                        ('tower'),
                                        ('fan'),
                                        ('psu');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'ASUS Z97-AR', 'An old motherboard...', 75, './images/z97ar.jpg' FROM item_type WHERE item_type_name = 'motherboard');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'i3-4170', 'A really old processor...', 100, './images/i34170.jpg' FROM item_type WHERE item_type_name = 'CPU');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'GTX 1060 3GB', 'A great graphics card!', 250, './images/10603.jpg' FROM item_type WHERE item_type_name = 'GPU');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'SAMSUNG 960EVO 250GB', 'An NVMe M.2 SSD', 120, './images/960evo.jpg' FROM item_type WHERE item_type_name = 'storage');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Vengance RGB 8GB', 'Colorful RAM! Hopefully it''s actually fast!', 100, './images/vengance.jpg' FROM item_type WHERE item_type_name = 'memory');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Corsair R300', 'An Average mid-sized tower', 80, './images/r300.jpg' FROM item_type WHERE item_type_name = 'tower');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Hyper 212 Evo', 'A great air CPU cooler', 30, './images/212evo.jpg' FROM item_type WHERE item_type_name = 'fan');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'EVGA 600W', 'A bugget PSU that works great', 40, './images/evga600.jpg' FROM item_type WHERE item_type_name = 'PSU');

INSERT INTO users(first_name, last_name, email, password) VALUES('Joe', 'Shmoe', 'shmoejoe47@gmail.com', 'dfghou436k=-45ios');


SELECT name, description, price, image_location FROM items AS i 
        JOIN item_type AS it
        ON i.item_type_id = it.item_type_id
        WHERE it.item_type_name = 'motherboard';