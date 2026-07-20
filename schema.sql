-- Run this in phpMyAdmin:
--   InfinityFree panel -> MySQL Databases -> Admin
--   -> pick database `if0_42446707_myfrist` -> SQL tab -> paste -> Go
--
-- The table is named `user`. It is written in backticks everywhere because
-- USER is a reserved word in MySQL and breaks the query without them.

-- The existing table has id / name / age but no status column.
-- This adds it, defaulting every current row to 0:
ALTER TABLE `user` ADD status TINYINT(1) NOT NULL DEFAULT 0;


-- Reference only -- the table as it now stands.
-- (Do NOT run this if the table already exists; it would fail.)
--
-- CREATE TABLE `user` (
--   id     INT(11) AUTO_INCREMENT PRIMARY KEY,
--   name   VARCHAR(255) NOT NULL,
--   age    INT(11)      NOT NULL,
--   status TINYINT(1)   NOT NULL DEFAULT 0
-- );
