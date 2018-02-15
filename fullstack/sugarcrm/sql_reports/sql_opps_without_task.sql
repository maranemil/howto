SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified, INTERVAL 7200 SECOND))) AS 'Geändert am',
(SELECT COUNT(*) FROM opportunities AS opp2 WHERE SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified, 1, 7) LIMIT 1) AS 'Total2',

# -------------------------------------------------------------
( SELECT COUNT(*) FROM opportunities as opp2 WHERE NOT EXISTS
    (SELECT * FROM tasks
		WHERE opp2.id = tasks.parent_id)
		AND SUBSTR(opportunities.date_modified, 1, 7) = SUBSTR(opp2.date_modified, 1, 7)
        AND opp2.sales_stage NOT IN ('Closed Won','Closed Lost')
        LIMIT 1
     ) AS 'WithoutTask',



# -------------------------------------------------------------
(SELECT COUNT(*)
FROM opportunities AS opp2
LEFT JOIN tasks AS tk ON tk.parent_id = opp2.id AND tk.parent_type='Opportunities' AND tk.date_due < NOW()
WHERE SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified, 1, 7)
AND opp2.sales_stage NOT IN ('Closed Won','Closed Lost')
LIMIT 1) AS 'WithTaskCount'


FROM opportunities
WHERE opportunities.deleted = 0
        AND (opportunities.date_modified BETWEEN '2014-05-31 22:00:00' AND '2016-06-30 21:59:59')
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified,
        INTERVAL 7200 SECOND)))
LIMIT 0 , 15