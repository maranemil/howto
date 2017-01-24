############################################
#
# Accounts Last Call Held
#
############################################

SELECT

accounts.name AS 'Name',
calls0000.date_entered AS 'Calls Date Created',
calls0000.status AS 'Calls Status',
calls0000.name AS 'Calls Subject',

((SELECT CONCAT(first_name,'',last_name) FROM users WHERE id = calls0000.assigned_user_id)) AS 'Calls Assigned UserName',
((SELECT CONCAT(c.first_name,'',c.last_name) FROM contacts AS c LEFT JOIN calls_contacts AS cc
ON cc.contact_id = c.id WHERE cc.call_id = calls0000.id LIMIT 1)) AS 'Contact Person'

FROM accounts
LEFT JOIN calls calls0000 ON (accounts.id=calls0000.parent_id AND calls0000.deleted=0)
WHERE accounts.deleted = 0 AND ( calls0000.status = 'Held' )
ORDER BY calls0000.date_entered DESC