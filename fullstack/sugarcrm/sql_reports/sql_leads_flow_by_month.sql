SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(leads_audit.date_created, INTERVAL 7200 SECOND))) AS 'Date Created',

#COUNT(leads_audit.after_value_text) AS 'New Value Text',

(SELECT COUNT(*) FROM leads as ld WHERE SUBSTR(leads_audit.date_created, 1, 7) = SUBSTR(ld.date_entered, 1,7)  ) AS 'Created',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='New'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'New',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='Converted'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Converted',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='Invalid'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Invalid',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='Closed'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Closed',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='In Process'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'In Process',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string IN ('Closed','Invalid')
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Dead',

(
(SELECT COUNT(*) FROM leads as ld WHERE SUBSTR(leads_audit.date_created, 1, 7) = SUBSTR(ld.date_entered, 1,7)  )  -
(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string IN ('Closed','Invalid','Converted')
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   )
) as 'NetFlow'


# Converted
# In Process
# New
# Closed
# Invalid

FROM leads_audit
LEFT JOIN leads ON (leads_audit.parent_id=leads.id)

WHERE leads.deleted = 0 AND ( leads_audit.field_name = 'status'
AND leads_audit.date_created BETWEEN '2013-12-31 22:00:00' AND '2016-06-30 21:59:59'  )
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(leads_audit.date_created, INTERVAL 7200 SECOND)))
LIMIT 0,15


/*

SELECT

(EXTRACT(YEAR_MONTH FROM DATE_ADD(leads_audit.date_created, INTERVAL 7200 SECOND))) AS 'Date Created',

(SELECT COUNT(*) FROM leads as ld WHERE SUBSTR(leads.date_entered, 1, 7) = SUBSTR(ld.date_entered, 1,7)  ) AS 'New',
(SELECT COUNT(*) FROM leads as ld WHERE SUBSTR(leads.date_entered, 1, 7) = SUBSTR(ld.date_entered, 1,7) AND ld.deleted =1 ) AS 'Deleted',

(SELECT COUNT(la.field_name) FROM leads_audit AS la
WHERE la.field_name='status' AND la.before_value_string='New'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'New',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='Converted'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Converted',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='Invalid'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Invalid',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='Closed'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Closed',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string='In Process'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'In Process',

(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string IN ('Closed','Invalid')
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) AS 'Dead',

(
(SELECT COUNT(*) FROM leads as ld WHERE SUBSTR(leads_audit.date_created, 1, 7) = SUBSTR(ld.date_entered, 1,7)  )  -
(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string IN ('Closed','Invalid','Converted')
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   )
) as 'NetFlow',


(
(SELECT COUNT(*) FROM leads_audit AS la WHERE la.field_name='status' AND la.before_value_string='New'
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   )  -
(SELECT COUNT(la.field_name) FROM leads_audit AS la WHERE la.field_name='status' AND la.after_value_string IN ('Closed','Invalid','Converted')
AND SUBSTR(leads.date_modified, 1, 7) = SUBSTR(la.date_created, 1,7)   ) -
(SELECT COUNT(*) FROM leads as ld WHERE SUBSTR(leads.date_entered, 1, 7) = SUBSTR(ld.date_entered, 1,7) AND ld.deleted =1 )
) as 'NetFlow2'


# Converted
# In Process
# New
# Closed
# Invalid

FROM leads_audit
LEFT JOIN leads ON (leads_audit.parent_id=leads.id)

WHERE leads.deleted = 0 AND ( leads_audit.field_name = 'status'
AND leads_audit.date_created BETWEEN '2013-12-31 22:00:00' AND '2016-06-30 21:59:59'  )
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(leads_audit.date_created, INTERVAL 7200 SECOND)))
LIMIT 0,15



*/


/*

SELECT
    (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified,
            INTERVAL 7200 SECOND))) AS 'Date Modified',
    ((SELECT
            COUNT(*)
        FROM
            opportunities AS opp2
        WHERE
            opp2.sales_stage = 'Closed Won'
                AND SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified,
                1,
                7)
        LIMIT 1)) AS 'Closed Won',
    ((SELECT
            COUNT(*)
        FROM
            opportunities AS opp2
        WHERE
            opp2.sales_stage = 'Closed Lost'
                AND SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified,
                1,
                7)
        LIMIT 1)) AS 'Closed Lost',
    COUNT(opportunities.sales_stage) AS 'Created',
    ((SELECT
            COUNT(*)
        FROM
            opportunities AS opp2
        WHERE
            opp2.sales_stage IN ('Closed Won' , 'Closed Lost')
                AND SUBSTR(opp2.date_modified, 1, 7) = SUBSTR(opportunities.date_modified,
                1,
                7)
        LIMIT 1)) AS 'Net Flow'
FROM
    opportunities
WHERE
    opportunities.deleted = 0
        AND (opportunities.date_modified BETWEEN '2013-06-30 22:00:00' AND '2016-06-30 21:59:59')
GROUP BY (EXTRACT(YEAR_MONTH FROM DATE_ADD(opportunities.date_modified,
        INTERVAL 7200 SECOND)))
LIMIT 0 , 15

*/
