###############################################
#
# Opp Closed Lost by Month/User
#
###############################################


SELECT
#(EXTRACT(YEAR_MONTH FROM opportunities.o1.date_entered)) AS 'CloseDate',
(EXTRACT(YEAR_MONTH FROM opportunities.date_entered)),
CONCAT( users.first_name,' ',users.last_name) as 'Name',

(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered))) FROM opportunities as o1
LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Closed Lost'
AND EXTRACT(YEAR_MONTH FROM o1.date_closed) =
CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
AND o1.assigned_user_id = users.id) as 'Closed Lost',

(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Closed Won'
AND EXTRACT(YEAR_MONTH FROM o1.date_closed) =
CONCAT(substr(opportunities.date_closed,1,4),substr(opportunities.date_closed,6,2))
AND opportunities.assigned_user_id = users.id) as 'Closed Won'

FROM users
LEFT JOIN opportunities ON opportunities.assigned_user_id = users.id
LEFT JOIN opportunities_audit ON opportunities_audit.parent_id = opportunities.id
WHERE users.first_name <> ''
group by users.id, (EXTRACT(YEAR_MONTH FROM opportunities.date_entered))
ORDER BY (EXTRACT(YEAR_MONTH FROM opportunities.date_entered)) DESC
LIMIT 18


/*

SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified, INTERVAL 7200 SECOND))) AS 'Geändert am',

(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage = 'Prospecting' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 10 ) AS 'Prospecting',
(SELECT COUNT(*) FROM opportunities AS opp2  WHERE opp2.sales_stage = 'Qualification' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 10 ) AS 'Qualification',
(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Needs Analysis' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 10 ) AS 'Needs_Analysis',
(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Value Proposition' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 10 ) AS 'Value_Proposition',(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Id. Decision Makers' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 10 ) AS 'Decision_Makers',(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Perception Analysis' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 1 ) AS 'Perception_Analysis',(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Proposal/Price Quote' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 1 ) AS 'Proposal_Price_Quote',(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Negotiation/Review' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 1 ) AS 'Negotiation_Review',
(SELECT count(*) FROM opportunities AS opp2 WHERE SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 1) AS 'Total',(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Closed Won'  AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 1 ) AS 'Closed_Won',
(SELECT count(*) FROM opportunities AS opp2  WHERE opp2.sales_stage='Closed Lost' AND SUBSTR(opp2.date_modified,1,7) = SUBSTR(opportunities.date_modified,1,7)  LIMIT 1 ) AS 'Closed_Lost'

FROM opportunities
WHERE opportunities.deleted = 0
AND ( opportunities.date_modified BETWEEN '2013-06-30 22:00:00' AND '2016-06-30 21:59:59'  )

GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified, INTERVAL 7200 SECOND)))  LIMIT 0,15



*/