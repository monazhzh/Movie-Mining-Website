DROP TABLE IF EXISTS MovieGenre;
DROP TABLE IF EXISTS MovieDirector;
DROP TABLE IF EXISTS MovieActor;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS MaxPersonID;
DROP TABLE IF EXISTS MaxMovieID;
DROP TABLE IF EXISTS Movie;
DROP TABLE IF EXISTS Actor;
DROP TABLE IF EXISTS Director;

CREATE TABLE Movie(
	id INT, 
	title VARCHAR(100) NOT NULL,
	year INT,   
	rating VARCHAR(10), 
	company VARCHAR(50),  
	PRIMARY KEY (id),  -- Every movie has a unique id
	CHECK (length(title)>0),  -- The title of each movie should be a non-empty string
	CHECK (id>=0)  -- The movie id should be a non-negative number
)ENGINE = INNODB;

CREATE TABLE Actor(
	id INT,
	last VARCHAR(20),
	first VARCHAR(20),
	sex VARCHAR(6),
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id),  -- Every actor has a unique id
	-- The date of death of an actor can be null. But if the actor has a dod, it should not be earlier than dob
	CHECK((dod IS NOT NULL and dob IS NOT NULL and dob < dod) or dod IS NULL),
	-- The last name and first name of each actor should not be null and should be non-empty
	CHECK((last IS NOT NULL and LENGTH(last) > 0) or (first IS NOT NULL and LENGTH(first) > 0)),
	CHECK (id>=0),  -- The actor id should be a non-negative number
	CHECK(dob<date_format(curdate(),'%Y%M%D'))  -- The date of birth of each actor should be ealier than current date
)ENGINE = INNODB;

CREATE TABLE Director(
	id INT,
	last VARCHAR(20),
	first VARCHAR(20),
	dob DATE,
	dod DATE,
	PRIMARY KEY (id),  -- Every director has a unique id
	-- The date of death of a director can be null. But if the director has a dod, it should not be earlier than dob
	CHECK((dod IS NOT NULL and dob IS NOT NULL and dob < dod) or dod IS NULL),
	-- The last name and first name of each director should not be null and should be non-empty
	CHECK((last IS NOT NULL and LENGTH(last) > 0) or (first IS NOT NULL and LENGTH(first) > 0)),
	CHECK (id>=0),  -- The director id should be a non-negative number
	CHECK(dob<date_format(curdate(),'%Y%M%D'))  -- The date of birth of each director should be ealier than current date
)ENGINE = INNODB;

CREATE TABLE MovieGenre(
	mid INT,
	genre VARCHAR(20) NOT NULL,
	PRIMARY KEY (mid, genre),  -- Every movie genre is uniquely identified by mid and genre
	FOREIGN KEY (mid) references Movie(id)  -- Every movie id appears MovieGenre should exist in Movie table
)ENGINE = INNODB;

CREATE TABLE MovieDirector(
	mid INT,
	did INT,
	PRIMARY KEY (mid, did),  -- Every movie director is uniquely identified by mid and did
	FOREIGN KEY (mid) references Movie(id),  -- Every movie id appears in MovieDirector should exist in Movie table
	FOREIGN KEY (did) references Director(id)  -- Every director id appears in MovieDirector should exist in Director table
)ENGINE = INNODB;

CREATE TABLE MovieActor(
	mid INT,
	aid INT,
	role VARCHAR(50) NOT NULL,
	PRIMARY KEY (mid, aid, role),  -- Every movie actor is uniquely identified by mid, aid and role
	FOREIGN KEY (mid) references Movie(id),  -- Every movie id appears in MovieActor should exist in Movie table
	FOREIGN KEY (aid) references Actor(id)  -- Every actor id appears in MovieActor should exist in Actor table
)ENGINE = INNODB;

CREATE TABLE Review(
	name VARCHAR(20),
	time TIMESTAMP,
	mid INT,
	rating INT,
	comment VARCHAR(500),
	PRIMARY KEY (name, mid),  -- Every review is uniquely identified by name and mid
	FOREIGN KEY (mid) references Movie(id),  -- Every movie id appears in Review should exist in Movie table
	CHECK(rating >= 0 and rating <= 5)  -- Every rating should be a integer between 0 and 5
)ENGINE = INNODB;

CREATE TABLE MaxPersonID(
	id INT,
	PRIMARY KEY (id)  -- Every max person id is unique
)ENGINE = INNODB;

CREATE TABLE MaxMovieID(
	id INT,
	PRIMARY KEY (id)  -- Every max movie id is unique
)ENGINE = INNODB;