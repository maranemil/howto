############################################
#
# Opps are grouped by Quarter > date created
#
############################################

SELECT o.sales_stage,
#--- Q1
(SELECT ROUND(AVG(DATEDIFF(oa.date_created ,o1.date_entered)))  FROM opportunities as o1
LEFT JOIN opportunities_audit as oa ON o1.id = oa.parent_id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 3 month) AND o.date_entered<=NOW())
AND o1.sales_stage = o.sales_stage ORDER BY oa.date_created DESC LIMIT 1
) as 'Q1',
#--- Q2
(SELECT ROUND(AVG(DATEDIFF(oa.date_created ,o1.date_entered)))  FROM opportunities as o1
LEFT JOIN opportunities_audit as oa ON o1.id = oa.parent_id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 6 month) AND o.date_entered<=DATE(NOW() - INTERVAL 3 month))
AND o1.sales_stage = o.sales_stage ORDER BY oa.date_created DESC LIMIT 1
) as 'Q2',
#--- Q3
(SELECT ROUND(AVG(DATEDIFF(oa.date_created ,o1.date_entered)))  FROM opportunities as o1
LEFT JOIN opportunities_audit as oa ON o1.id = oa.parent_id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 9 month) AND o.date_entered<=DATE(NOW() - INTERVAL 6 month))
AND o1.sales_stage = o.sales_stage ORDER BY oa.date_created DESC LIMIT 1
) as 'Q3',
#--- Q4
(SELECT ROUND(AVG(DATEDIFF(oa.date_created ,o1.date_entered)))  FROM opportunities as o1
LEFT JOIN opportunities_audit as oa ON o1.id = oa.parent_id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 12 month) AND o.date_entered<=DATE(NOW() - INTERVAL 9 month))
AND o1.sales_stage = o.sales_stage ORDER BY oa.date_created DESC LIMIT 1
) as 'Q4',
#--- Q5
(SELECT ROUND(AVG(DATEDIFF(oa.date_created ,o1.date_entered)))  FROM opportunities as o1
LEFT JOIN opportunities_audit as oa ON o1.id = oa.parent_id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 15 month) AND o.date_entered<=DATE(NOW() - INTERVAL 12 month))
AND o1.sales_stage = o.sales_stage ORDER BY oa.date_created DESC LIMIT 1
) as 'Q5',
#--- Q6
(SELECT ROUND(AVG(DATEDIFF(oa.date_created ,o1.date_entered)))  FROM opportunities as o1
LEFT JOIN opportunities_audit as oa ON o1.id = oa.parent_id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 18 month) AND o.date_entered<=DATE(NOW() - INTERVAL 15 month))
AND o1.sales_stage = o.sales_stage ORDER BY oa.date_created DESC LIMIT 1
) as 'Q6'
FROM opportunities as o
WHERE o.sales_stage <> 'Closed Won' AND o.sales_stage <> 'Closed Lost'
AND o.deleted = 0
GROUP BY o.sales_stage