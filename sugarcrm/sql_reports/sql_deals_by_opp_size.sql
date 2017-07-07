##################################################
#
#   Deals closed by Deal size Opps
#
##################################################

SELECT
opportunities.sales_stage AS 'Sales Stage',
#opportunities.amount AS 'Amount2000',

(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE ROUND(o1.amount) <= '2000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT2000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE ROUND(o1.amount) <= '2000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT2000Cnt',
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '2000' and o1.amount <= '5000' AND o1.sales_stage = 'Closed Won'  ) AS 'AMT5000 EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '2000' and o1.amount <= '5000' AND o1.sales_stage = 'Closed Won'  ) AS 'AMT5000Cnt',
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '5000' and o1.amount <= '10000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT10000 EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '5000' and o1.amount <= '10000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT10000Cnt',


(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '10000' and o1.amount <= '25000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT25000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '10000' and o1.amount <= '25000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT25000Cnt',
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '25000' and o1.amount <= '50000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT50000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '25000' and o1.amount <= '50000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT50000Cnt',
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '50000' and o1.amount <= '100000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT100000 EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '50000' and o1.amount <= '100000' AND o1.sales_stage = 'Closed Won' ) AS 'AMT100000Cnt',

COUNT(*) AS 'TOTAL'

FROM opportunities
WHERE opportunities.deleted = 0 AND ( opportunities.sales_stage = 'Closed Won' )
#AND opportunities.date_entered BETWEEN '2004-02-29 22:00:00' AND '2016-08-31 21:59:59'
GROUP BY opportunities.sales_stage
 LIMIT 0,15


 /*


 ################################################################
# Deals closed by Deal size Opps V3 Total CASES EXAMPLE
################################################################

SELECT

case
when ROUND(amount) between 0 and 2000 then ' 2000'
when ROUND(amount) between 2001 and 5000 then ' 5000'
when ROUND(amount) between 5001 and 10000 then '10000'
when ROUND(amount) between 10001 and 25000 then '25000'
when ROUND(amount) between 25001 and 50000 then '50000'
when ROUND(amount) between 50001 and 100000 then '100000'
else '1'
end as RangeAmout,

  opportunities.name,
 #ROUND(opportunities.amount,2) AS 'Amount',
 ROUND(SUM(opportunities.amount),2) AS 'Amount',
 COUNT(*) AS 'TOTAL'

FROM opportunities
WHERE opportunities.deleted = 0
AND opportunities.sales_stage='Closed Won'
#AND opportunities.amount > 30

GROUP BY RangeAmout #opportunities.amount  RangeAmout
HAVING TOTAL > 0 #AND RangeAmout = 100000
ORDER BY TOTAL DESC

 */



 /*

 ###########################################################
# Deals closed by Deal size Opps Pro Jahr
##########################################################

 SELECT

(YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) AS 'Date Created',
opportunities.sales_stage AS 'Sales Stage',
 #----------2000-------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE ROUND(o1.amount) <= '2000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT2000 EUR',
(SELECT count(*) FROM opportunities as o1 WHERE ROUND(o1.amount) <= '2000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT2000Cnt',
 #----------5000-------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '2000' and o1.amount <= '5000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT5000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '2000' and o1.amount <= '5000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT5000Cnt',
 #----------10000------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '5000' and o1.amount <= '10000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))  ) AS 'AMT10000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '5000' and o1.amount <= '10000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT10000Cnt',
 #----------25000------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '10000' and o1.amount <= '25000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT25000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '10000' and o1.amount <= '25000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT25000Cnt',
 #----------50000----------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '25000' and o1.amount <= '50000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT50000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '25000' and o1.amount <= '50000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT50000Cnt',
 #----------100000----------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '50000' and o1.amount <= '100000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT00000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '50000' and o1.amount <= '100000' AND o1.sales_stage = 'Closed Won'
AND (YEAR(DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT100000Cnt',

 COUNT(*) AS 'TOTAL'


 FROM opportunities

 WHERE opportunities.deleted = 0 AND ( opportunities.sales_stage = 'Closed Won'   )

 GROUP BY (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
 ORDER BY (YEAR(DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) DESC
 LIMIT 0,15

 */



 /*

 SELECT
(EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) AS 'Date Created',
opportunities.sales_stage AS 'Sales Stage',
#----------2000-------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE ROUND(o1.amount) <= '2000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT2000 EUR',
(SELECT count(*) FROM opportunities as o1 WHERE ROUND(o1.amount) <= '2000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT2000Cnt',

 #----------5000-------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '2000' and o1.amount <= '5000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT5000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '2000' and o1.amount <= '5000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT5000Cnt',
 #----------10000------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '5000' and o1.amount <= '10000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))  ) AS 'AMT10000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '5000' and o1.amount <= '10000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT10000Cnt',
 #----------25000------------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '10000' and o1.amount <= '25000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT25000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '10000' and o1.amount <= '25000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT25000Cnt',
 #----------50000----------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '25000' and o1.amount <= '50000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT50000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '25000' and o1.amount <= '50000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT50000Cnt',
 #----------100000----------
(SELECT SUM(ROUND(o1.amount,2)) FROM opportunities as o1 WHERE o1.amount > '50000' and o1.amount <= '100000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT00000EUR',
(SELECT count(*) FROM opportunities as o1 WHERE o1.amount > '50000' and o1.amount <= '100000' AND o1.sales_stage = 'Closed Won'
AND (EXTRACT(YEAR_MONTH FROM DATE_ADD(o1.date_entered, INTERVAL 7200 SECOND)))= (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND))) ) AS 'AMT100000Cnt',

 COUNT(*) AS 'TOTAL'

 FROM opportunities
 WHERE opportunities.deleted = 0 AND ( opportunities.sales_stage = 'Closed Won'   )
 GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))
 ORDER BY  (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_entered, INTERVAL 7200 SECOND)))  DESC
 #LIMIT 0,15


 */