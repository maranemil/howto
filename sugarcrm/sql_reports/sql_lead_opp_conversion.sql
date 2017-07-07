
###############################################
#
# Lead to Opp won Conversion
#
###############################################

SELECT

#**************  Q1 quarter
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 3 month) AND o.date_entered<=NOW())
AND o.sales_stage='Closed Won' AND o.deleted=0) as 'Q1a',
(SELECT  count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 3 month) AND o.date_entered<=NOW()) AND o.deleted=0) as 'Q1b',
(SELECT CONCAT(ROUND((Q1a/Q1b)*100),'%')) as 'RQ1',
#(SELECT DATE(NOW() - INTERVAL 3 month)) as 'QD1',
#**************  Q2 quarter
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 6 month) AND o.date_entered<=DATE(NOW() - INTERVAL 3 month))
AND o.sales_stage='Closed Won' AND o.deleted=0) as 'Q2a',
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 6 month) AND o.date_entered<=DATE(NOW() - INTERVAL 3 month)) AND o.deleted=0) as 'Q2b',
(SELECT CONCAT(ROUND((Q2a/Q2b)*100),'%')) as 'RQ2',
#(SELECT DATE(NOW() - INTERVAL 6 month)) as 'QD2',
 #**************  Q3  quarter
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 9 month) AND o.date_entered<=DATE(NOW() - INTERVAL 6 month))
AND o.sales_stage='Closed Won' AND o.deleted=0) as 'Q3a',
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 9 month) AND o.date_entered<=DATE(NOW() - INTERVAL 6 month))AND o.deleted=0) as 'Q3b',
(SELECT CONCAT(ROUND((Q3a/Q3b)*100),'%')) as 'RQ3',
#(SELECT DATE(NOW() - INTERVAL 9 month)) as 'QD3',
 #**************  Q4 quarter
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 12 month) AND o.date_entered<=DATE(NOW() - INTERVAL 9 month))
AND o.sales_stage='Closed Won' AND o.deleted=0) as 'Q4a',
(SELECT count(*) FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 12 month) AND o.date_entered<=DATE(NOW() - INTERVAL 9 month)) AND o.deleted=0) as 'Q4b',
(SELECT CONCAT(ROUND((Q4a/Q4b)*100),'%')) as 'RQ4'


/*
# Lead to Opp Created Conversion
#

SELECT
#---Q1------------------------
(SELECT count(*)  FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 3 month) AND o.date_entered<=NOW()) AND o.deleted=0) as 'Q1a',
(SELECT  count(*) FROM leads as l
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 3 month) AND l.date_entered<=NOW()) AND l.deleted=0 ) as 'Q1b',
(SELECT CONCAT(ROUND((Q1a/Q1b)*100),'%')) as 'RQ1',
(SELECT DATE(NOW() - INTERVAL 3 month)) as 'QD1',
#---Q2------------------------
(SELECT count(*)  FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 6 month) AND o.date_entered<=DATE(NOW() - INTERVAL 3 month)) AND o.deleted=0) as 'Q2a',
(SELECT  count(*) FROM leads as l
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 6 month) AND l.date_entered<=DATE(NOW() - INTERVAL 3 month))  AND l.deleted=0) as 'Q2b',
(SELECT CONCAT(ROUND((Q2a/Q2b)*100),'%')) as 'RQ2',
(SELECT DATE(NOW() - INTERVAL 6 month)) as 'QD2',
#---Q3------------------------
(SELECT count(*)  FROM leads as l LEFT JOIN opportunities as o ON l.opportunity_id = o.id
WHERE (o.date_entered>=DATE(NOW() - INTERVAL 9 month) AND o.date_entered<=DATE(NOW() - INTERVAL 6 month)) AND o.deleted=0) as 'Q3a',
(SELECT  count(*) FROM leads as l
WHERE (l.date_entered>=DATE(NOW() - INTERVAL 9 month) AND l.date_entered<=DATE(NOW() - INTERVAL 6 month)) AND l.deleted=0 ) as 'Q3b',
(SELECT CONCAT(ROUND((Q3a/Q3b)*100),'%')) as 'RQ3',
(SELECT DATE(NOW() - INTERVAL 9 month)) as 'QD3'


*/
