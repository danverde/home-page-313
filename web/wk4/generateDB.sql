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
    item_type INT NOT NULL
);

CREATE TABLE items
(
    item_id SERIAL PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(3,2) NOT NULL,
    image_location VARCHAR(30),
    item_type INT REFERENCES item_type
);

CREATE TABLE builds
(
    build_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users,
    motherboard_id INT REFERENCES items,
    processor_id INT REFERENCES items,
    fan_id INT REFERENCES items,
    fan_amount INT,
    memory_id INT REFERENCES items,
    memory_amount INT
);

ALTER TABLE users ADD build_id INT REFERENCES builds NOT NULL;

