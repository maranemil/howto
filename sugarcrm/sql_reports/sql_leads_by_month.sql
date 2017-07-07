
SELECT

    (EXTRACT(YEAR_MONTH FROM DATE_ADD(leads.date_modified,INTERVAL 7200 SECOND))) AS 'Date Modified',

    (SELECT COUNT(*) AS Total2 FROM leads AS l2  LEFT JOIN opportunities as op ON op.id = l2.opportunity_id
        WHERE l2.status = 'New' AND SUBSTR(leads.date_modified,1,7) = SUBSTR(l2.date_modified,1,7)
         LIMIT 1 ) AS 'New',

    (SELECT  COUNT(*) AS Total2 FROM leads AS l2
        WHERE l2.status = 'Converted'  AND SUBSTR(leads.date_modified,1,7) = SUBSTR(l2.date_modified,1,7)
        LIMIT 1 ) AS 'Converted',

	(SELECT  COUNT(*) AS Total2 FROM leads AS l2
        WHERE l2.status = 'Closed'  AND SUBSTR(leads.date_modified,1,7) = SUBSTR(l2.date_modified,1,7)
        LIMIT 1 ) AS 'Closed',

	(SELECT  COUNT(*) AS Total2 FROM leads AS l2
        WHERE l2.status = 'Invalid'  AND SUBSTR(leads.date_modified,1,7) = SUBSTR(l2.date_modified,1,7)
        LIMIT 1 ) AS 'Invalid',

        	(SELECT  COUNT(*) AS Total2 FROM leads AS l2
        WHERE l2.status = 'In Process'  AND SUBSTR(leads.date_modified,1,7) = SUBSTR(l2.date_modified,1,7)
        LIMIT 1 ) AS 'In Process',


    COUNT(leads.status) AS 'Total'
FROM
    leads
WHERE
    leads.deleted = 0
        AND (leads.date_modified BETWEEN '2014-11-30 22:00:00' AND '2016-06-30 21:59:59')
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(leads.date_modified, INTERVAL 7200 SECOND)))
LIMIT 0 , 15