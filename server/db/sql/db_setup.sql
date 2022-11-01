CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    post_code VARCHAR(7) NOT NULL,
    address VARCHAR(255) NOT NULL,
    age VARCHAR(3) NOT NULL,
    sex VARCHAR(1) NOT NULL,
    tel VARCHAR(20) NOT NULL,
    image VARCHAR(255) NOT NULL,
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

CREATE TABLE IF NOT EXISTS saraly_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS ofer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    company_id INT NOT NULL,
    saraly_category_id INT NOT NULL,
    saraly_price INT NOT NULL,
    profile TEXT NOT NULL,
    area VARCHAR(50) NOT NULL,
    cxl_flag BIT(1) NOT NULL DEFAULT 1,
    image VARCHAR(255) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT ofer_fk_company_id
    FOREIGN KEY (company_id)
        REFERENCES companies(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT ofer_fk_saraly_category_id
    FOREIGN KEY (saraly_category_id)
        REFERENCES saraly_category(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS appry (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ofer_id INT NOT NULL,
    user_id INT NOT NULL,
    company_id INT NOT NULL,
    motivation TEXT NOT NULL,
    resume VARCHAR(255) NOT NULL,
    status_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT appry_fk_ofer_id
    FOREIGN KEY (ofer_id)
        REFERENCES ofer(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT appry_fk_user_id
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT appry_fk_company_id
    FOREIGN KEY (company_id)
        REFERENCES companies(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT appry_fk_status_id
    FOREIGN KEY (status_id)
        REFERENCES status(id)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);
