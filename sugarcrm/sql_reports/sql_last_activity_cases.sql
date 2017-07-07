############################################
#
# Cases Last Activity
#
############################################

SELECT

cs.name as 'Ticket Name',
#EXTRACT(year_month FROM DATE_ADD(cs.date_modified, INTERVAL 7200 SECOND)) AS 'modified',
substr(cs.date_modified,1,11) AS 'Modified',
DATEDIFF(NOW(),cs.date_modified) AS 'Days since created',

(SELECT CONCAT(u.user_name,' ') FROM users as u WHERE u.id=cs.assigned_user_id) AS 'Assigned to',
cs.status as 'Ticket Status',

(SELECT count(csa.field_name) FROM cases_audit AS csa
WHERE csa.field_name='Status' AND csa.before_value_string = 'Closed' AND csa.parent_id = cs.id) AS 'Reopened',

(SELECT count(e.id) FROM emails as e WHERE e.parent_id = cs.id ) as 'Nr Emails',

(SELECT DATEDIFF(NOW(),e1.date_entered) FROM emails as e1
WHERE e1.parent_id = cs.id AND e1.parent_type = 'Cases' AND e1.status = 'sent' LIMIT 1
) as 'Days since last Email sent',

(SELECT DATEDIFF(NOW(),e1.date_entered) FROM emails as e1
WHERE e1.parent_id = cs.id AND e1.parent_type = 'Cases' AND e1.status = 'read' LIMIT 1
) as 'Days since last Email arrived',

(SELECT DATEDIFF(NOW(),calls.date_entered) FROM calls
WHERE calls.parent_id = cs.id AND calls.parent_type = 'Cases' AND calls.status = 'Held' LIMIT 1
) as 'Days since last Call'

FROM cases as cs
WHERE (cs.status = 'Assigned' OR cs.status = 'NEW')
ORDER BY cs.date_modified DESC

