################################################
#
# Opps changes
#
################################################

SELECT

opportunities.name AS 'Name',

(SELECT a.name FROM accounts AS a
INNER JOIN accounts_opportunities AS oa ON oa.account_id=a.id
WHERE oa.opportunity_id = opportunities.id
LIMIT 1
) as 'Firma',

ROUND(opportunities.amount,2) AS 'Amount',
(SELECT count(*) FROM opportunities_audit as oa WHERE oa.parent_id = opportunities.id and oa.field_name='amount') AS 'Amount Changed',
opportunities.sales_stage AS 'Stage',
opportunities.date_entered AS 'Created Date',
opportunities.date_closed AS 'Expected Closed Date',
(SELECT count(*) FROM opportunities_audit as oa WHERE oa.parent_id = opportunities.id and oa.field_name='date_closed') AS 'Closed Date Changed',
(SELECT CONCAT(first_name,' ',last_name) FROM users WHERE id=opportunities.assigned_user_id) AS 'User',
(SELECT count(*) FROM opportunities_audit as oa WHERE oa.parent_id = opportunities.id and oa.field_name='assigned_user_id') AS 'Assigned Changed',

(SELECT count(*) FROM calls AS cl WHERE cl.parent_id=opportunities.id and cl.status='Held') as 'Calls',
(SELECT count(*) FROM meetings AS mt WHERE mt.parent_id=opportunities.id and mt.status='Held') as 'Meetings',
(SELECT count(*) FROM emails AS em WHERE em.parent_id=opportunities.id and em.status IN ('sent','draft')) as 'Emails',

(
(SELECT count(*) FROM calls AS cl WHERE cl.parent_id=opportunities.id and cl.status='Held') +
(SELECT count(*) FROM meetings AS mt WHERE mt.parent_id=opportunities.id and mt.status='Held')
) as 'Activity Calls Meetings',

(
SELECT cl.date_entered FROM calls AS cl WHERE cl.parent_id=opportunities.id and cl.status='Held'  LIMIT 1
UNION
SELECT mt.date_entered FROM meetings AS mt WHERE mt.parent_id=opportunities.id and mt.status='Held'  LIMIT 1
) as 'Last Activity'


FROM opportunities
ORDER BY opportunities.date_entered DESC
LIMIT 8

