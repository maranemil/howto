-- Hello world in MySQL FUNCTION

DELIMITER $$
CREATE FUNCTION hello_world() RETURNS TEXT COMMENT 'Hello World'
BEGIN
  RETURN 'Hello World';
END;
$$
DELIMITER ;

SELECT hello_world();