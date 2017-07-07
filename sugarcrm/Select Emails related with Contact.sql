########################################################
##
## SugarCRM Query Get All Emails related with Contact
##
########################################################

SELECT l1.email_address FROM contacts
LEFT JOIN email_addr_bean_rel l1_1 ON contacts.id=l1_1.bean_id
AND l1_1.deleted=0
#AND l1_1.primary_address = '1'
AND l1_1.bean_module = 'Contacts'
LEFT JOIN email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
WHERE contacts.deleted=0 AND contacts.id= 'ffcd0f4b-b3a2-b523-9382-55b910c7dec2'

########################################################
##
## SugarCRM Query Get All Contacts with Primary Email
##
########################################################

SELECT * FROM contacts
LEFT JOIN email_addr_bean_rel l1_1 ON contacts.id=l1_1.bean_id AND l1_1.deleted=0 AND l1_1.primary_address = '1' AND l1_1.bean_module = 'Contacts'
LEFT JOIN email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
WHERE ((((coalesce(LENGTH(contacts.first_name),0) > 0) )
AND ((coalesce(LENGTH(contacts.last_name),0) > 0) )
AND ((coalesce(LENGTH(l1.email_address),0) > 0) )))
AND contacts.deleted=0


########################################################
##
## SugarCRM Override all email addresses with default for test case
##
########################################################

# SELECT ONLY USERS EMAIL ADDRESSES
SELECT *
FROM  `email_addresses` AS ea
LEFT JOIN  `email_addr_bean_rel` AS eabr ON eabr.email_address_id = ea.id
WHERE eabr.bean_module =  'Users'
LIMIT 0 , 30

# UPDATE ONLY USERS EMAIL ADDRESSES
UPDATE  `email_addresses` AS ea LEFT JOIN  `email_addr_bean_rel` AS eabr ON eabr.email_address_id = ea.id
SET ea.`email_address` =  'emil@lol.de',email_address_caps= UPPER('emil@lol.de')
WHERE eabr.bean_module =  'Users'


########################################################
##
## SugarCRM Query Get All Emails related with User X
##
########################################################


SELECT
IFNULL(users.id,'') primaryid ,
IFNULL(users.last_name,'') users ,
IFNULL(users.first_name,'') contacts_first_name ,
IFNULL(l1.id,'') l1_id ,l1.email_address l1_email_address
FROM users
LEFT JOIN email_addr_bean_rel l1_1 ON users.id=l1_1.bean_id AND l1_1.deleted=0
AND l1_1.primary_address = '1'
AND l1_1.bean_module = 'Users'
LEFT JOIN email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
WHERE ((((coalesce(LENGTH(users.first_name),0) > 0) )
AND ((coalesce(LENGTH(users.last_name),0) > 0) )
AND ((coalesce(LENGTH(l1.email_address),0) > 0) )))
AND users.first_name = 'Sandra'
AND l1.email_address =  'sandra@example.com‎'
AND users.deleted=0