#######################################################
#
# Generate Random Date Beans with mySQL query sugarCRM
#
#######################################################

UPDATE `accounts` SET `date_entered`= CONCAT('2015-0',ROUND(1+RAND()*6),'-01 08:55:22') WHERE 1


# OK rand accounts
# ---
UPDATE accounts SET date_entered= CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1
UPDATE accounts SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1 LIMIT 1

# OK rand calls
# ---
UPDATE calls SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1
UPDATE calls SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1 LIMIT 1

# OK rand contacts
# ---
UPDATE contacts SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1;
UPDATE contacts SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1;

# OK rand emails
# ---
UPDATE emails SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1;
UPDATE emails SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1;

# OK rand leads
# ---
UPDATE leads SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1;
UPDATE leads SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1;

# OK rand meetings
# ---
UPDATE meetings SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1;
UPDATE meetings SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1;

# OK rand notes
# ---
UPDATE notes SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1;
UPDATE notes SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1;

# OK rand opportunities
# ---
UPDATE opportunities SET date_entered = CONCAT('2015-0',ROUND(1+RAND()*7),'-0',ROUND(1+RAND()*8),' 0',ROUND(1+RAND()*4),':55:22') WHERE 1;
UPDATE opportunities SET date_modified = (SELECT CONCAT(date_entered + INTERVAL ROUND(1+RAND()*7) DAY,'') ) WHERE 1;
