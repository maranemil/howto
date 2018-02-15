###############################################
#
# Calls by MOnth
#
###############################################

SELECT
(EXTRACT(YEAR_MONTH FROM DATE_ADD(calls.date_modified, INTERVAL 7200 SECOND))) AS 'Date Modified',

COUNT(calls.status) AS 'Total',((SELECT count(*) FROM calls AS ca WHERE SUBSTR(ca.date_modified, 1, 7) = SUBSTR(calls.date_modified, 1, 7)  AND ca.status ='Not Held')) AS 'NotHeld',
((SELECT count(*) FROM calls AS ca WHERE SUBSTR(ca.date_modified, 1, 7) = SUBSTR(calls.date_modified, 1, 7)  AND ca.status ='Planned') ) AS 'Planned',
((SELECT count(*) FROM calls AS ca WHERE SUBSTR(ca.date_modified, 1, 7) = SUBSTR(calls.date_modified, 1, 7)  AND ca.status ='Held')) AS 'Held'


FROM calls
WHERE calls.deleted = 0
AND ( calls.date_modified BETWEEN '2014-06-30 22:00:00' AND '2016-06-30 21:59:59'  )
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(calls.date_modified, INTERVAL 7200 SECOND)))  LIMIT 0,15