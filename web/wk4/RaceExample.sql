/*************** events *************/
DROP TABLE events CASCADE;

CREATE TABLE events
(
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    -- distance INT,
    date DATE
);

-- INSERT INTO events(name, location, date) VALUES ('Dat one Run', 'Dat one location', NULL);

ALTER TABLE events ADD distance INTEGER;
INSERT INTO events(name, location, distance, date) VALUES ('5 K Run', 'Mt. Rushmore', 5, '2018-07-20');


/*************** participants *************/
DROP TABLE participants;

-- if id is primary key, you don't have to mention it here
CREATE TABLE participants
(
    id SERIAL PRIMARY KEY,
    eventId INT REFERENCES events(id) NOT NULL, 
    firstName VARCHAR(60) NOT NULL,
    lastName VARCHAR(60) NOT NULL,
    age INTEGER NOT NULL,
    weight INTEGER,
    gender VARCHAR(5)
);

INSERT INTO participants(eventId, firstName, lastName, age, weight, gender) VALUES (1, 'Joe', 'Biglot', 27, 375, 'male');



/* view changes */
SELECT * FROM participants;
SELECT * FROM events;
