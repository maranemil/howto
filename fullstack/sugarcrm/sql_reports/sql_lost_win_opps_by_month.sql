###############################################
#
# Lost Won Opps By Month
#
###############################################

SELECT
(EXTRACT(YEAR_MONTH FROM opportunities.date_closed)) AS 'CloseDate',

(SELECT COUNT(*) FROM opportunities as o3 WHERE EXTRACT(YEAR_MONTH FROM o3.date_closed)
= CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
#GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
LIMIT 1
) AS 'CreatedOpps',

(SELECT COUNT(*) FROM opportunities as o1 WHERE o1.sales_stage ='Closed Won'
AND EXTRACT(YEAR_MONTH FROM o1.date_closed) = CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
#GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
LIMIT 1
)  AS 'WonOpps',

(SELECT COUNT(*) FROM opportunities as o2 WHERE o2.sales_stage ='Closed Lost'
AND EXTRACT(YEAR_MONTH FROM o2.date_closed) = CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
#GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
LIMIT 1
) AS 'LostOpps',


ROUND(
(SELECT COUNT(*) FROM opportunities as o3 WHERE EXTRACT(YEAR_MONTH FROM o3.date_closed)
= CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
#GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
LIMIT 1) -
ABS(
(SELECT COUNT(*) FROM opportunities as o1 WHERE o1.sales_stage ='Closed Won'
AND EXTRACT(YEAR_MONTH FROM o1.date_closed) = CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
#GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
LIMIT 1)  +
(SELECT COUNT(*) FROM opportunities as o2 WHERE o2.sales_stage ='Closed Lost'
AND EXTRACT(YEAR_MONTH FROM o2.date_closed) = CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
#GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
LIMIT 1))
)
AS 'Net'


FROM opportunities
WHERE opportunities.deleted = 0
GROUP BY (EXTRACT(YEAR_MONTH FROM opportunities.date_closed))
#LIMIT 0,5
#