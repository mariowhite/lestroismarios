-- MySQL dump 
-- This script helps cleanup the database.  It will drop
-- all views and tables created for the website
set foreign_key_checks = 0;
drop table if exists `users`;
drop table if exists `complaints`;
drop table if exists `contracts`;
drop table if exists `reply`;
drop table if exists `users_contracts`;
drop table if exists `photo`;
drop table if exists `users_autorized`;
set foreign_key_checks = 1;



/*display foreign_key_checks*/
SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME 
     FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
     WHERE REFERENCED_TABLE_SCHEMA IS NOT NULL;