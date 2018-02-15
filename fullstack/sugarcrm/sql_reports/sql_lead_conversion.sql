###############################################
#
#  Lead to Opp conversion
#
###############################################


SELECT
#--- Q1 ------------------
(SELECT ROUND(AVG(DATEDIFF(la.date_created ,l.date_entered))) FROM leads as l
LEFT OUTER JOIN leads_audit as la ON la.parent_id = l.id AND la.after_value_string ='Converted'
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 3 month) AND l.date_entered<=NOW())  AND l.deleted=0
) as 'AvgTQ1',
#--- Q2 ------------------
(SELECT ROUND(AVG(DATEDIFF(la.date_created ,l.date_entered))) FROM leads as l
LEFT OUTER JOIN leads_audit as la ON la.parent_id = l.id AND la.after_value_string ='Converted'
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 6 month) AND l.date_entered<=DATE(NOW() - INTERVAL 3 month))  AND l.deleted=0
) as 'AvgTQ2',
#--- Q3 ------------------
(SELECT ROUND(AVG(DATEDIFF(la.date_created ,l.date_entered))) FROM leads as l
LEFT OUTER JOIN leads_audit as la ON la.parent_id = l.id AND la.after_value_string ='Converted'
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 9 month) AND l.date_entered<=DATE(NOW() - INTERVAL 6 month)) AND l.deleted=0
) as 'AvgTQ3',
#--- Q4 ------------------
(SELECT ROUND(AVG(DATEDIFF(la.date_created ,l.date_entered))) FROM leads as l
LEFT OUTER JOIN leads_audit as la ON la.parent_id = l.id AND la.after_value_string ='Converted'
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 12 month) AND l.date_entered<=DATE(NOW() - INTERVAL 9 month)) AND l.deleted=0
) as 'AvgTQ4',
#--- Q5 ------------------
(SELECT ROUND(AVG(DATEDIFF(la.date_created ,l.date_entered))) FROM leads as l
LEFT OUTER JOIN leads_audit as la ON la.parent_id = l.id AND la.after_value_string ='Converted'
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 15 month) AND l.date_entered<=DATE(NOW() - INTERVAL 12 month)) AND l.deleted=0
) as 'AvgTQ5',
#--- Q6 ------------------
(SELECT ROUND(AVG(DATEDIFF(la.date_created ,l.date_entered))) FROM leads as l
LEFT OUTER JOIN leads_audit as la ON la.parent_id = l.id AND la.after_value_string ='Converted'
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 18 month) AND l.date_entered<=DATE(NOW() - INTERVAL 15 month)) AND l.deleted=0
) as 'AvgTQ6'