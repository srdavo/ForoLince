CREATE DATABASE "foro-lince";
USE "foro-lince";

CREATE TABLE users (
  id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
  name varchar(120) NOT NULL,
  email varchar(255) NOT NULL,
  pwd varchar(128) NOT NULL
);
CREATE TABLE users_data (
  id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT(20) NOT NULL,
  user_token VARCHAR(8) UNIQUE,
  permissions int(1) NOT NULL,
  store_name varchar(200) NOT NULL,
  credits int(11) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
); 

CREATE TABLE news (
  id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
  new_title VARCHAR(255) NOT NULL,
  new_content TEXT NOT NULL,

  new_date DATE NOT NULL,
  new_time TIME NOT NULL,
  new_image VARCHAR(255) NULL,
  
  user_id BIGINT(20) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE events (
  id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
  event_name VARCHAR(255) NOT NULL,
  event_description TEXT NOT NULL,
  event_date DATE NOT NULL,
  event_time TIME NOT NULL,
  event_address VARCHAR(255) NOT NULL,
  event_image VARCHAR(255) NULL,
  event_credits VARCHAR(255) NULL,
  event_completed int(1) NOT NULL,
  
  user_id BIGINT(20) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE event_inscriptions (
  id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
  event_id BIGINT(20) NOT NULL,
  user_id BIGINT(20) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE event_absences (
  id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
  event_id BIGINT(20) NOT NULL,
  user_id BIGINT(20) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);


-- ignorar
ALTER TABLE events ADD COLUMN event_credits int AFTER event_image;
ALTER TABLE events ADD COLUMN event_completed varchar(1) AFTER event_credits;
ALTER TABLE users_data ADD COLUMN credits int(11) AFTER store_name;