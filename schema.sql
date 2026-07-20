-- Run this in phpMyAdmin (InfinityFree panel -> MySQL Databases -> Admin)
-- against the database `if0_42446707_myfrist`.

-- If the table does not exist yet, create it:
CREATE TABLE IF NOT EXISTS MyGuests (
  id     INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name   VARCHAR(30) NOT NULL,
  age    INT(3)      NOT NULL,
  status TINYINT(1)  NOT NULL DEFAULT 0
);

-- If the table already exists with only id / name / age,
-- add the missing status column instead:
ALTER TABLE MyGuests ADD status TINYINT(1) NOT NULL DEFAULT 0;
