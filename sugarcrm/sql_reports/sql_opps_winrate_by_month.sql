SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) AS 'Date Created', # date_entered date_modified
#ROUND(AVG (opportunities.amount)) AS 'AVGAmount',
(SELECT ROUND(AVG(o3.amount),2) FROM opportunities AS o3 WHERE o3.id = opportunities.id ) AS 'AVGAmountWon',
#COUNT(*) AS 'TOTALOpps',

/*
(SELECT COUNT(*) FROM opportunities AS o5 WHERE o5.sales_stage IN('Closed Won','Closed Lost')
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o5.date_entered, INTERVAL 7200 SECOND)))
) AS 'TOTALOpps',
*/

/*
(SELECT COUNT(*) FROM opportunities AS o3 WHERE o3.id = opportunities.id AND o3.sales_stage IN('Closed Won')
AND opportunities.date_entered=o3.date_entered ) AS 'CountWon',
(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.id = opportunities.id AND o4.sales_stage IN('Closed Lost') ) AS 'CountLost'
*/

(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.sales_stage IN('Closed Won')
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
= (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered, INTERVAL 7200 SECOND))) ) AS 'Won',

#(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.sales_stage IN('Closed Lost')
#AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered, INTERVAL 7200 SECOND))) ) AS 'CntL',

(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.sales_stage IN('Closed Won','Closed Lost')
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
 = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered, INTERVAL 7200 SECOND))) ) AS 'WonLost',

/*(
 (SELECT COUNT(*) FROM opportunities AS o1 WHERE o1.id = opportunities.id AND o1.sales_stage IN('Closed Won') LIMIT 1) -
 (SELECT COUNT(*) FROM opportunities AS o2 WHERE o2.id = opportunities.id AND o2.sales_stage IN('Closed Lost') LIMIT 1)
) AS 'WinRate',
*/

CONCAT(  ROUND(( ( SELECT COUNT( * ) FROM opportunities AS o1 WHERE o1.sales_stage IN ( 'Closed Won' )  AND ( EXTRACT( YEAR_MONTH FROM DATE_ADD( o1.date_entered, INTERVAL 7200 SECOND ) ) ) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) )  )   * 100 /

( SELECT COUNT( * ) FROM opportunities AS o1 WHERE o1.sales_stage IN ( 'Closed Won','Closed Lost' )  AND ( EXTRACT( YEAR_MONTH FROM DATE_ADD( o1.date_entered, INTERVAL 7200 SECOND ) ) ) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))

 )),'%')  AS 'WinRate Proc'




FROM opportunities

LEFT JOIN opportunities_cstm ON (opportunities.id=opportunities_cstm.id_c)
WHERE opportunities.deleted = 0
AND (amount > 2000 AND  amount < 10000)
AND ( opportunities.date_entered BETWEEN '2013-03-30 22:00:00' AND '2016-02-30 21:59:59'  )
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) # date_modified date_entered
LIMIT 0,17


/*

SELECT
    (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
            INTERVAL 7200 SECOND))) AS 'Month',
    AVG(opportunities.amount) AS 'Amount AVG',
    ((SELECT
            COUNT(*)
        FROM
            opportunities AS o4
        WHERE
            o4.sales_stage IN ('Closed Won')
                AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
                    INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered,
                    INTERVAL 7200 SECOND))))) AS 'Won',
    ((SELECT
            COUNT(*)
        FROM
            opportunities AS o4
        WHERE
            o4.sales_stage IN ('Closed Won' , 'Closed Lost')
                AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
                    INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered,
                    INTERVAL 7200 SECOND))))) AS 'WonLost',
    (CONCAT(ROUND(((SELECT
                            COUNT(*)
                        FROM
                            opportunities AS o1
                        WHERE
                            o1.sales_stage IN ('Closed Won')
                                AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered,
                                    INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
                                    INTERVAL 7200 SECOND))))) * 100 / (SELECT
                            COUNT(*)
                        FROM
                            opportunities AS o1
                        WHERE
                            o1.sales_stage IN ('Closed Won' , 'Closed Lost')
                                AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered,
                                    INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
                                    INTERVAL 7200 SECOND))))),
            '%')) AS 'WinRate',
    ((SELECT
            ROUND(AVG(DATEDIFF(oa1.date_created, o1.date_entered)))
        FROM
            opportunities AS o1
                INNER JOIN
            opportunities_audit AS oa1 ON oa1.parent_id = o1.id
                AND oa1.after_value_string = 'Closed Won'
        WHERE
            (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
                    INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered,
                    INTERVAL 7200 SECOND))))) AS 'Pipeline AVG'
FROM
    opportunities
WHERE
    opportunities.deleted = 0
        AND (opportunities.date_entered BETWEEN '2016-02-29 22:00:00' AND '2016-08-31 21:59:59')
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered,
        INTERVAL 7200 SECOND)))
LIMIT 0 , 15


*/


/*

#####################################################################################
#Deals closed by Deal size in a given period including win and pipeline duration
#####################################################################################

SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) AS 'Date Created', # date_entered date_modified
#ROUND(AVG (opportunities.amount)) AS 'AVGAmount',
(SELECT ROUND(AVG(o3.amount),2) FROM opportunities AS o3 WHERE o3.id = opportunities.id ) AS 'AVGAmountWon',
#COUNT(*) AS 'TOTALOpps',

/*(SELECT COUNT(*) FROM opportunities AS o5 WHERE o5.sales_stage IN('Closed Won','Closed Lost')
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o5.date_entered, INTERVAL 7200 SECOND)))
) AS 'TOTALOpps',*/

/*(SELECT COUNT(*) FROM opportunities AS o3 WHERE o3.id = opportunities.id AND o3.sales_stage IN('Closed Won')
AND opportunities.date_entered=o3.date_entered ) AS 'CountWon',
(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.id = opportunities.id AND o4.sales_stage IN('Closed Lost') ) AS 'CountLost'*/

(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.sales_stage IN('Closed Won')
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
= (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered, INTERVAL 7200 SECOND))) ) AS 'Won',

#(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.sales_stage IN('Closed Lost')
#AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered, INTERVAL 7200 SECOND))) ) AS 'CntL',

(SELECT COUNT(*) FROM opportunities AS o4 WHERE o4.sales_stage IN('Closed Won','Closed Lost')
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
 = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o4.date_entered, INTERVAL 7200 SECOND))) ) AS 'WonLost',

/*(
 (SELECT COUNT(*) FROM opportunities AS o1 WHERE o1.id = opportunities.id AND o1.sales_stage IN('Closed Won') LIMIT 1) -
 (SELECT COUNT(*) FROM opportunities AS o2 WHERE o2.id = opportunities.id AND o2.sales_stage IN('Closed Lost') LIMIT 1)
) AS 'WinRate',*/

CONCAT(  ROUND(( ( SELECT COUNT( * ) FROM opportunities AS o1 WHERE o1.sales_stage IN ( 'Closed Won' )  AND ( EXTRACT( YEAR_MONTH FROM DATE_ADD( o1.date_entered, INTERVAL 7200 SECOND ) ) ) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) )  )   * 100 /
( SELECT COUNT( * ) FROM opportunities AS o1 WHERE o1.sales_stage IN ( 'Closed Won','Closed Lost' )  AND ( EXTRACT( YEAR_MONTH FROM DATE_ADD( o1.date_entered, INTERVAL 7200 SECOND ) ) ) = (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
 )),'%')  AS 'WinRate Proc',

( SELECT ROUND ( AVG( datediff( oa1.date_created,o1.date_entered)))
FROM  opportunities AS o1
INNER JOIN opportunities_audit AS oa1 ON oa1.parent_id = o1.id AND oa1.after_value_string ='Closed Won'
WHERE (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))  = (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))
#AND o1.id='4e0674d2-5ead-d812-5406-5710c23fc965'
#ORDER BY oa1.date_created DESC #LIMIT 5
) as 'AVGPipelineDays'


FROM opportunities

LEFT JOIN opportunities_cstm ON (opportunities.id=opportunities_cstm.id_c)
WHERE opportunities.deleted = 0
AND (amount > 20 AND  amount < 2000)
AND ( opportunities.date_entered BETWEEN '2013-03-30 22:00:00' AND '2016-06-30 21:59:59'  )
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) # date_modified date_entered
LIMIT 0,17

*/