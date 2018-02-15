###############################################
#
# Migrated Contacts
#
###############################################

SELECT
c.first_name, c.last_name,
(SELECT a.name FROM accounts as a WHERE a.id = ac.account_id AND ac.deleted = 1) as 'OldAccount',

(SELECT a1.name FROM accounts as a1
LEFT JOIN `accounts_contacts` as ac1 ON ac1.account_id = a1.id
WHERE ac1.deleted = 0
AND c.id = ac1.contact_id
AND ac1.account_id != ac.account_id
ORDER BY a1.date_modified DESC
LIMIT 1
) as 'NewAccount',

(SELECT SUBSTR(a1.date_entered,1,11) FROM accounts as a1
LEFT JOIN `accounts_contacts` as ac1 ON ac1.account_id = a1.id
WHERE ac1.deleted = 0
AND c.id = ac1.contact_id
AND ac1.account_id != ac.account_id
ORDER BY a1.date_modified DESC
LIMIT 1
) as 'LastChange'

FROM contacts as c
LEFT OUTER JOIN `accounts_contacts` as ac ON ac.contact_id = c.id
WHERE ac.deleted = 1

GROUP BY first_name,last_name
HAVING NewAccount <> ''
ORDER BY LastChange DESC

