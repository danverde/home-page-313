CREATE TABLE users
(
    userId SERIAL,
    firstName VARCHAR(40),
    lastName VARCHAR(100),
    "password" VARCHAR(60),
    email VARCHAR(40)
);

CREATE TABLE conferences 
(

)

CREATE TABLE speakers
(

)

INSERT INTO users(firstName, lastName, email) VALUES ('Joe', 'biglot', 'hi@aol.com');
SELECT * FROM users;