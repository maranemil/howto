###############################################
#
# Opp Closed Duration
#
###############################################


SELECT
name,count(*),
amount,
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1
LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE oa1.after_value_string = 'Closed Won'
AND o1.sales_stage = 'Closed Won' AND o1.amount = opportunities.amount
#AND DATEDIFF(oa1.date_created,o1.date_entered) != ''
LIMIT 1
) as 'Duration'

FROM opportunities
WHERE sales_stage = 'Closed Won'
GROUP BY amount
ORDER BY amount DESC

/*

SELECT
sales_stage,
#(SELECT count(*) FROM opportunities	) as 'All',
count(*) as 'TOTAL',

Concat(
Round(
(SELECT count(*) FROM opportunities as o1
#LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = opportunities.sales_stage)
* 100 / (SELECT count(*) FROM opportunities)
),'%')
 as 'Duration'


FROM opportunities
GROUP BY sales_stage
ORDER BY TOTAL DESC

*/