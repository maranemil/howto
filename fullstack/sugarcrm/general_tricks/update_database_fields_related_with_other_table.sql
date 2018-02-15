/* # SET SQL_MODE = ANSI_QUOTES; # SELECT * FROM "my-table"; */
/*# Error Code: 1175. You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column To disable safe mode, toggle the option in Preferences */

SET SQL_SAFE_UPDATES = 0;
#UPDATE accounts_cstm AS ac INNER JOIN  accounts AS a ON ac.id_c = a.id SET ac.bank_account_c = a.id;
UPDATE accounts_cstm AS ac INNER JOIN  accounts AS a ON ac.id_c = a.id
SET ac.map_quest_datum_c = NOW(),
ac.map_quest_lat_c = '64.1308070',
ac.map_quest_lon_c = '-21.8146367',
ac.map_quest_stats_c = '1',
ac.map_quest_token_c = ( SELECT CASE
	WHEN SUBSTR(MD5(CONCAT(TRIM(ax.billing_address_street),TRIM(ax.billing_address_postalcode),TRIM(ax.billing_address_country),TRIM(ax.billing_address_city))),1,25)
		THEN  SUBSTR(MD5(CONCAT(TRIM(ax.billing_address_street),TRIM(ax.billing_address_postalcode),TRIM(ax.billing_address_country),TRIM(ax.billing_address_city))),1,25)
	ELSE SUBSTR(MD5('notfound'),1,25)
END AS Token FROM accounts as ax  WHERE ax.id = a.id
) WHERE ( ac.map_quest_token_c='' OR ac.map_quest_token_c IS NULL ) ;
SET SQL_SAFE_UPDATES = 1;

/*
SELECT COUNT( * ) AS Total, map_quest_datum_c
FROM  `accounts_cstm`
GROUP BY map_quest_datum_c
ORDER BY Total DESC
LIMIT 0 , 30
*/

/* # Error Code: 1175. You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column To disable safe mode, toggle the option in Preferences */

SET SQL_SAFE_UPDATES = 0;
#UPDATE accounts_cstm AS ac INNER JOIN  accounts AS a ON ac.id_c = a.id SET ac.bank_account_c = a.id;
UPDATE users_cstm AS uc INNER JOIN  users AS u ON uc.id_c = u.id
SET uc.map_quest_datum_c = NOW(),
uc.map_quest_lat_c = '64.1308070',
uc.map_quest_lon_c = '-21.8146367',
uc.map_quest_stats_c = '1',
uc.map_quest_token_c = ( SELECT CASE
	WHEN SUBSTR(MD5(CONCAT(TRIM(ux.address_street),TRIM(ux.address_postalcode),TRIM(ux.address_country),TRIM(ux.address_city))),1,25)
		THEN SUBSTR(MD5(CONCAT(TRIM(ux.address_street),TRIM(ux.address_postalcode),TRIM(ux.address_country),TRIM(ux.address_city))),1,25)
	ELSE SUBSTR(MD5('notfound'),1,25)
END AS Token FROM users as ux  WHERE ux.id = u.id
) WHERE ( uc.map_quest_token_c='' OR uc.map_quest_token_c IS NULL );
SET SQL_SAFE_UPDATES = 1;

/*
SELECT COUNT( * ) AS Total, map_quest_datum_c
FROM  `users_cstm`
GROUP BY map_quest_datum_c
ORDER BY Total DESC
LIMIT 0 , 30
*/


##########################################
#
# UPDATE WITH JOIN
#
##########################################

UPDATE accounts_cstm
LEFT JOIN accounts ON accounts.id = accounts_cstm.id_c
SET accounts_cstm.map_quest_token_c = SUBSTR(MD5(CONCAT(TRIM(accounts.billing_address_street),TRIM(accounts.billing_address_postalcode),TRIM(accounts.billing_address_country),TRIM(accounts.billing_address_city))),1,25)
WHERE accounts.deleted = 0 AND accounts_cstm.map_quest_token_c IS NULL