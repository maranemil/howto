# Sugar Query Get All Contacts with Email

SELECT IFNULL(contacts.id,'') primaryid ,IFNULL(contacts.last_name,'') contacts_last_name ,IFNULL(contacts.first_name,'') contacts_first_name ,IFNULL(l1.id,'') l1_id ,l1.email_address l1_email_address FROM contacts
LEFT JOIN email_addr_bean_rel l1_1 ON contacts.id=l1_1.bean_id AND l1_1.deleted=0 AND l1_1.primary_address = '1' AND l1_1.bean_module = 'Contacts'
LEFT JOIN email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
WHERE ((((coalesce(LENGTH(contacts.first_name),0) > 0) ) 
AND ((coalesce(LENGTH(contacts.last_name),0) > 0) ) 
AND ((coalesce(LENGTH(l1.email_address),0) > 0) ))) 
AND contacts.deleted=0 