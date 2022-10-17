CREATE DATABASE taskforce DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE task
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    description CHAR(255)   NOT NULL,
    category_id INT         NOT NULL,
    user_id     INT         NOT NULL,
    price       INT         NOT NULL,
    created_at  TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP,
    finished_at TIMESTAMP
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
    description CHAR(255)   NOT NULL,
    photo       CHAR(255)   NOT NULL,
    city_id     INT         NOT NULL,
    is_employee BOOL,
    created_at  TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP
);

CREATE TABLE category
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL
);

CREATE TABLE category_user
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    user_id     INT         NOT NULL,
    category_id INT         NOT NULL
);

CREATE TABLE city
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    lat         DECIMAL (8, 5),
    lng         DECIMAL (8, 5)
);

CREATE TABLE review
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(64)    NOT NULL,
    user_id     INT         NOT NULL,
    task_id     INT         NOT NULL,
    rating      TINYINT(1)  NOT NULL,
    created_at  TIMESTAMP   DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP
);

CREATE TABLE response
(
    id          INT          AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(500) NOT NULL,
    user_id     INT          NOT NULL,
    task_id     INT          NOT NULL,
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP
);

CREATE TABLE file
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    title       CHAR(255)   NOT NULL,
    url         CHAR(255)   NOT NULL
);

CREATE TABLE task_file
(
    id          INT         AUTO_INCREMENT PRIMARY KEY,
    task_id     INT         NOT NULL,
    file_id     INT         NOT NULL
);
