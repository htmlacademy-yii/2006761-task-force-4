CREATE DATABASE taskforce DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE task
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    description CHAR(255)   NOT NULL,
    category_id INT         NOT NULL,
    city_id     INT         NOT NULL,
    user_id     INT         NOT NULL,
    budget      INT         NOT NULL,
    dt_finish   TIMESTAMP,
    dt_create   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    file        CHAR(128)   NOT NULL
);

CREATE TABLE user
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    name        CHAR(64)    NOT NULL,
    password    CHAR(255)   NOT NULL,
    email       CHAR(128)   NOT NULL UNIQUE,
    dt_birth    TIMESTAMP,
    phone       CHAR(32)    NOT NULL,
    telegram    CHAR(64)    NOT NULL,
    rating      TINYINT(1)  NOT NULL,
    description CHAR(255)   NOT NULL,
    photo       CHAR(255)   NOT NULL,
    dt_create   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    category_id INT         NOT NULL,
    city_id     INT         NOT NULL,
    task_id     INT         NOT NULL,
    is_executor BOOL
);

CREATE TABLE category
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    user_id     INT         NOT NULL
);

CREATE TABLE city
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    lat         DECIMAL (8, 5),
    lng         DECIMAL (8, 5),
    user_id     INT         NOT NULL
);

CREATE TABLE review
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    user_id     INT         NOT NULL,
    dt_create   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    price       INT         NOT NULL,
    rating      INT         NOT NULL,
    task_id     INT         NOT NULL
);

CREATE TABLE response
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    user_id     INT         NOT NULL,
    task_id     INT         NOT NULL,
    dt_create   TIMESTAMP   DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE file
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(255)   NOT NULL,
    url         CHAR(255)   NOT NULL,
    task_id     INT         NOT NULL
);
