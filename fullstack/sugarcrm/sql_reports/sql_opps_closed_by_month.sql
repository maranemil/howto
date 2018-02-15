SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified, INTERVAL 7200 SECOND))) AS 'Date Modified',

COUNT(opportunities.sales_stage) AS 'Total',((SELECT COUNT(*) FROM opportunities AS opp2
WHERE opp2.sales_stage = 'Closed Won' AND SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified, 1,7) LIMIT 1) ) AS 'ClosedWon',

((SELECT COUNT(*) FROM opportunities AS opp2 WHERE opp2.sales_stage = 'Closed Lost' AND SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified, 1,7) LIMIT 1) ) AS 'ClosedLost'

FROM opportunities
WHERE opportunities.deleted = 0
AND ( opportunities.date_modified BETWEEN '2013-06-30 22:00:00' AND '2016-06-30 21:59:59'  )
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified, INTERVAL 7200 SECOND)))
LIMIT 0,15