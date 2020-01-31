-- Hello World in PL/pgSQL (PostgreSQL Procedural Language)
-- In old versions replace '$$' by double qoutes

CREATE FUNCTION hello_world() RETURNS text AS $$
BEGIN
RETURN 'Hello World';
END
$$ LANGUAGE plpgsql;

SELECT hello_world();