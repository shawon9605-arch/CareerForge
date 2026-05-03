CREATE TABLE students (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100) UNIQUE,
password VARCHAR(255),
image VARCHAR(255),
skills TEXT,
interests TEXT,
gpa FLOAT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE students 
ADD education TEXT,
ADD experience TEXT,
ADD projects TEXT;

ALTER TABLE students MODIFY projects TEXT;