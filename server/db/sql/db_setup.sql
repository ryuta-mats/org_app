CREATE TABLE IF NOT EXISTS pre_users (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
urltoken VARCHAR(128) NOT NULL,
mail VARCHAR(50) NOT NULL,
date DATETIME NOT NULL,
flag TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password varchar(255) NOT NULL,
    name varchar(50) NOT NULL,
    post_code varchar(7) NOT NULL,
    address varchar(255) NOT NULL,
    age varchar(3) DEFAULT NULL,
    sex varchar(1) DEFAULT NULL,
    tel varchar(20) NOT NULL,
    image varchar(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS companies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    manager_name VARCHAR(50) NOT NULL,
    post_code VARCHAR(7) NOT NULL,
    address VARCHAR(255) NOT NULL,
    profile TEXT NOT NULL,
    url VARCHAR(255),
    image VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO status (name) VALUES ("選考中");
INSERT INTO status (name) VALUES ("採用");
INSERT INTO status (name) VALUES ("不採用");
INSERT INTO status (name) VALUES ("辞退");

CREATE TABLE IF NOT EXISTS saraly_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO saraly_category (name) VALUES ("月給");
INSERT INTO saraly_category (name) VALUES ("時給");
INSERT INTO saraly_category (name) VALUES ("年俸");


CREATE TABLE IF NOT EXISTS ofer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    company_id int(11) NOT NULL,
    category_id int(11) NOT NULL,
    price int(11) NOT NULL,
    profile text NOT NULL,
    area varchar(50) NOT NULL,
    cxl_flag tinyint(1) NOT NULL DEFAULT 1,
    image varchar(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    start_date datetime NOT NULL,
    end_date datetime NOT NULL,
    CONSTRAINT ofer_fk_company_id FOREIGN KEY (company_id) REFERENCES companies (id),
    CONSTRAINT ofer_fk_saraly_category_id FOREIGN KEY (category_id) REFERENCES saraly_category (id)
);

CREATE TABLE IF NOT EXISTS appry (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ofer_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    company_id int(11) NOT NULL,
    motivation text NOT NULL,
    resume varchar(255) NOT NULL,
    status_id int(11) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    cxl_flag tinyint(1) NOT NULL DEFAULT 1,
    CONSTRAINT appry_fk_company_id FOREIGN KEY (company_id) REFERENCES companies (id),
    CONSTRAINT appry_fk_ofer_id FOREIGN KEY (ofer_id) REFERENCES ofer (id),
    CONSTRAINT appry_fk_status_id FOREIGN KEY (status_id) REFERENCES status (id),
    CONSTRAINT appry_fk_user_id FOREIGN KEY (user_id) REFERENCES users (id)
);

CREATE TABLE IF NOT EXISTS message (
    id INT PRIMARY KEY AUTO_INCREMENT,
    appry_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    company_id int(11) NOT NULL,
    body text NOT NULL,
    msg_from tinyint(1) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT message_fk_company_id FOREIGN KEY (company_id) REFERENCES companies (id),
    CONSTRAINT message_fk_appry_id FOREIGN KEY (appry_id) REFERENCES appry (id),
    CONSTRAINT message_fk_user_id FOREIGN KEY (user_id) REFERENCES users (id));
