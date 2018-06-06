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
    name VARCHAR(40) NOT NULL,
    description TEXT NOT NULL,
    price REAL NOT NULL,
    image_location VARCHAR(100)
);

CREATE TABLE builds
(
    build_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users NOT NULL UNIQUE,
    motherboard_id INT REFERENCES items,
    cpu_id INT REFERENCES items,
    gpu_id INT REFERENCES items,
    gpu_count int REFERENCES items,
    fan_id INT REFERENCES items,
    fan_count INT,
    memory_id INT REFERENCES items,
    memory_count INT,
    storage_id INT REFERENCES items,
    storage_count INT,
    tower_id INT REFERENCES items,
    psu_id INT REFERENCES items
);

-- Technically this shouldn't exist b/c builds already references users, 
-- but at this point it would take a lot of work to move everything around
-- ALTER TABLE users ADD build_id INT REFERENCES builds;


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
(SELECT item_type_id, 'i3-4170', 'A really old processor...', 100, './images/i34170.jpg' FROM item_type WHERE item_type_name = 'cpu');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'GTX 1060 3GB', 'A great graphics card!', 250, './images/10603.jpg' FROM item_type WHERE item_type_name = 'gpu');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'SAMSUNG 960EVO 250GB', 'An NVMe M.2 SSD', 120, './images/960evo.jpg' FROM item_type WHERE item_type_name = 'storage');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Vengance RGB 8GB', 'Colorful RAM! Hopefully it''s actually fast!', 100, './images/vengance.jpg' FROM item_type WHERE item_type_name = 'memory');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Corsair R300', 'An Average mid-sized tower', 80, './images/r300.jpg' FROM item_type WHERE item_type_name = 'tower');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Hyper 212 Evo', 'A great air CPU cooler', 30, './images/212evo.jpg' FROM item_type WHERE item_type_name = 'fan');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'EVGA 600W', 'A bugget PSU that works great', 40, './images/evga600.jpg' FROM item_type WHERE item_type_name = 'psu');



INSERT INTO users(first_name, last_name, email, password) VALUES('Default', 'User', 'shmoejoe47@gmail.com', 'dfghou436k=-45ios');


SELECT name, description, price, image_location FROM items AS i 
        JOIN item_type AS it
        ON i.item_type_id = it.item_type_id
        WHERE it.item_type_name = 'motherboard';

-- TODO Clean this up. It should be dynamic...
INSERT INTO builds(user_id, motherboard_id, cpu_id, gpu_id, gpu_count, fan_id, fan_count, memory_id, memory_count, storage_id, tower_id, psu_id)
(SELECT user_id, 1, 2, 3, 2, 7, 1, 5, 4, 4, 6, 8 FROM users WHERE user_id=1);



-- SELECT i.name, i.price, it.item_type_name
-- FROM items AS i
-- INNER JOIN builds AS bu ON (bu.user_id = 1)
-- INNER JOIN item_type AS it USING (item_type_id)
-- WHERE bu.motherboard_id = i.item_id
-- OR bu.cpu_id = i.item_id
-- OR bu.gpu_id = i.item_id
-- OR bu.storage_id = i.item_id
-- OR bu.memory_id = i.item_id
-- OR bu.tower_id = i.item_id
-- OR bu.fan_id = i.item_id
-- OR bu.psu_id = i.item_id;

-- ADD ADDITIONAL ITEMS

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'ASUS ROG STRIX X299-E', 'An old motherboard...', 320, './images/x299e.jpg' FROM item_type WHERE item_type_name = 'motherboard');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'i7-8700K', '3.7GHz LGA 1151', 350, './images/i78700k.jpg' FROM item_type WHERE item_type_name = 'cpu');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'GTX 1080', '8GB Founders edition', 600, './images/1080.jpg' FROM item_type WHERE item_type_name = 'gpu');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'WD Blue 1TB HDD', '7,200 RPM SATA III 6.0Gb/s 3.5" Internal Hard Drive', 52, './images/wd1t.jpg' FROM item_type WHERE item_type_name = 'storage');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'G.Skill Trident Z RGB', '16GB 2 x 8GB DDR4-3200 PC4-25600 CL16 Dual Channel', 210, './images/tridentz.jpg' FROM item_type WHERE item_type_name = 'memory');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Thermaltake View 71 RGB', 'Full-Tower RGB fans. Glass sides', 180, './images/71rgb.jpg' FROM item_type WHERE item_type_name = 'tower');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Corsair Hydro Series H110i', 'Liquid cooling. Dual fan radiator', 109, './images/h110i.jpg' FROM item_type WHERE item_type_name = 'fan');

INSERT INTO items(item_type_id, name, description, price, image_location) 
(SELECT item_type_id, 'Corsair RM750x', '750 Watt 80 Plus Gold ATX Modular Power Supply', 119, './images/rm750x.jpg' FROM item_type WHERE item_type_name = 'psu');


SELECT item_id FROM items i 
JOIN builds bu ON user_id=1 AND bu.motherboard_id=i.item_id;


INSERT INTO users(first_name, last_name, email, password) VALUES ('Joe', 'Shmoe', 'shmoe@gmail.com', 'password');
INSERT INTO builds(user_id) VALUES (2);