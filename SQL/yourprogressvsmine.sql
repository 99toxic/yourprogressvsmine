-- create the database
DROP DATABASE IF EXISTS yourprogressvsmine;
CREATE DATABASE yourprogressvsmine;

-- select the database
USE yourprogressvsmine;

-- create the tables
CREATE TABLE goal
(
  goal_id         INT(11)          PRIMARY KEY           AUTO_INCREMENT          NOT NULL,
  goal_name       TINYTEXT         NOT NULL
);

CREATE TABLE workout_type
(
  type_id          INT(11)         PRIMARY KEY           AUTO_INCREMENT          NOT NULL,
  type_name        TINYTEXT        NOT NULL
);

CREATE TABLE users
(
  user_id          INT(11)         PRIMARY KEY           AUTO_INCREMENT          NOT NULL,
  user_name        TINYTEXT        NOT NULL,
  user_email       TINYTEXT        NOT NULL,
  user_date        DATE            NOT NULL,
  goal_id          INT(11)         NOT NULL,
  user_pwd         LONGTEXT        NOT NULL,
  user_login       DATETIME        NOT NULL,
  user_level       BOOLEAN         NOT NULL              DEFAULT FALSE,
  CONSTRAINT  users_fk_user_goal
    FOREIGN KEY (goal_id)
    REFERENCES  goal (goal_id)
);

CREATE TABLE admin
(
  admin_id          INT(11)         PRIMARY KEY           AUTO_INCREMENT          NOT NULL,
  user_id           INT             NOT NULL,
  ad_url            TEXT            NOT NULL,
  CONSTRAINT  admin_fk_users
    FOREIGN KEY (user_id)
    REFERENCES  users (user_id)
);

CREATE TABLE pwd_reset
(
  reset_id          INT(11)         PRIMARY KEY           AUTO_INCREMENT          NOT NULL,
  user_id           INT             NOT NULL,
  reset_selector    TEXT            NOT NULL,
  reset_token       LONGTEXT        NOT NULL,
  reset_expires     DATETIME        NOT NULL,
  CONSTRAINT  pwd_reset_fk_users
    FOREIGN KEY (user_id)
    REFERENCES  users (user_id)
);

CREATE TABLE chat
(
  chat_id            INT(11)         PRIMARY KEY          AUTO_INCREMENT          NOT NULL,
  user_id            INT(11)         NOT NULL,
  chat_message       TEXT            NOT NULL,
  chat_timestamp     DATETIME        NOT NULL             DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT  chat_fk_users
    FOREIGN KEY (user_id)
    REFERENCES  users (user_id)
);

CREATE TABLE workout_desc
(
  wrk_id             INT(11)         PRIMARY KEY          AUTO_INCREMENT          NOT NULL,
  user_id            INT(11)         NOT NULL,
  wrk_name           TINYTEXT        NOT NULL,
  type_id            INT(11)         NOT NULL,
  wrk_sets           INT             NOT NULL,
  wrk_desc           TEXT,
  day                INT(1)          NOT NULL,
  active             BOOLEAN         NOT NULL             DEFAULT FALSE,
  CONSTRAINT  workout_desc_fk_users
    FOREIGN KEY (user_id)
    REFERENCES  users (user_id),
  CONSTRAINT  workout_desc_fk_workout_type
    FOREIGN KEY (type_id)
    REFERENCES  workout_type (type_id)
);

CREATE TABLE exe_details
(
  exe_id             INT(11)         PRIMARY KEY          AUTO_INCREMENT          NOT NULL,
  wrk_id             INT(11)         NOT NULL,
  exe_name           TINYTEXT        NOT NULL,
  exe_equip          TINYTEXT        NOT NULL,
  exe_sets           INT,
  exe_reps           INT,
  exe_time           TIME,
  CONSTRAINT  exe_details_fk_workout_desc
    FOREIGN KEY (wrk_id)
    REFERENCES  workout_desc (wrk_id)
);


-- Insert data into the tables
INSERT INTO goal (goal_id, goal_name) VALUES
(1, 'Build Muscle'),
(2, 'Lose Fat'),
(3, 'Transform'),
(4, 'Improve'),
(5, 'Endurance'),
(6, 'Flexibility'),
(7, 'Other');

INSERT INTO workout_type (type_id, type_name) VALUES
(1, 'Strength'),
(2, 'Cardio'),
(3, 'Stretching'),
(4, 'Plyometrics'),
(5, 'Other'),
(6, 'Rest');
