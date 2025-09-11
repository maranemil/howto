PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE prompts (
            id INTEGER PRIMARY KEY,
            name TEXT,
            prompt VARCHAR(6000),
            type TEXT,
            score REAL,
			created_date datetime default current_timestamp
        );
INSERT INTO prompts VALUES(1,'pre','23werwt','1',1.0,'2025-09-11 19:42:31');
INSERT INTO prompts VALUES(2,'pre','sdfdfsg','1',1.0,'2025-09-11 19:43:33');
INSERT INTO prompts VALUES(3,'1','sfszerzerz','1',1.0,'2025-09-11 19:43:38');
COMMIT;
