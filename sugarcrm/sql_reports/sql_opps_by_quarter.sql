
############################################
#
# Opps grouped by Quarter
# group by user
#
############################################

SELECT CONCAT(u.first_name,' ' ,u.last_name) as 'Usr',
#--- Q1 ------
(SELECT count(*) FROM opportunities as o  WHERE o.created_by = u.id AND o.sales_stage='Closed Won'
AND (o.date_entered>=DATE(NOW() - INTERVAL 3 month) AND o.date_entered<=NOW()) AND o.deleted=0 ) as 'CQ1a',
(SELECT count(*) FROM opportunities as o WHERE o.created_by = u.id
AND (o.date_entered>=DATE(NOW() - INTERVAL 3 month) AND o.date_entered<=NOW()) AND o.deleted=0 ) as 'CQ1b',
(SELECT CONCAT(ROUND((CQ1a/CQ1b)*100),'%')) as 'RQ1',
#--- Q2 ------
(SELECT count(*) FROM opportunities as o  WHERE o.created_by = u.id AND o.sales_stage='Closed Won'
AND (o.date_entered>=DATE(NOW() - INTERVAL 6 month) AND o.date_entered<=DATE(NOW() - INTERVAL 3 month)) AND o.deleted=0) as 'CQ2a',
(SELECT count(*) FROM opportunities as o WHERE o.created_by = u.id
AND (o.date_entered>=DATE(NOW() - INTERVAL 6 month) AND o.date_entered<=DATE(NOW() - INTERVAL 3 month)) AND o.deleted=0) as 'CQ2b',
(SELECT CONCAT(ROUND((CQ2a/CQ2b)*100),'%')) as 'RQ2',
#--- Q3 ------
(SELECT count(*) FROM opportunities as o  WHERE o.created_by = u.id AND o.sales_stage='Closed Won'
AND (o.date_entered>=DATE(NOW() - INTERVAL 9 month) AND o.date_entered<=DATE(NOW() - INTERVAL 6 month)) AND o.deleted=0) as 'CQ3a',
(SELECT count(*) FROM opportunities as o WHERE o.created_by = u.id
AND (o.date_entered>=DATE(NOW() - INTERVAL 9 month) AND o.date_entered<=DATE(NOW() - INTERVAL 6 month)) AND o.deleted=0) as 'CQ3b',
(SELECT CONCAT(ROUND((CQ3a/CQ3b)*100),'%')) as 'RQ3',
#--- Q4 ------
(SELECT count(*) FROM opportunities as o  WHERE o.created_by = u.id AND o.sales_stage='Closed Won'
AND (o.date_entered>=DATE(NOW() - INTERVAL 12 month) AND o.date_entered<=DATE(NOW() - INTERVAL 9 month)) AND o.deleted=0) as 'CQ4a',
(SELECT count(*) FROM opportunities as o WHERE o.created_by = u.id
AND (o.date_entered>=DATE(NOW() - INTERVAL 12 month) AND o.date_entered<=DATE(NOW() - INTERVAL 9 month)) AND o.deleted=0) as 'CQ4b',
(SELECT CONCAT(ROUND((CQ4a/CQ4b)*100),'%')) as 'RQ4'

FROM users as u
WHERE u.first_name <> ''
