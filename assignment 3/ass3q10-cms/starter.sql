CREATE DATABASE simple_cms;
USE simple_cms;

CREATE TABLE pages (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a dummy page
INSERT INTO pages (title, content) VALUES ('Hello World', 'Welcome to my first CMS site.'); 