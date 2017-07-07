###############################################
#
# Opps - Days since closed
#
###############################################


SELECT
opp.name as 'OppName',
opp.amount as 'Amount',
opp.sales_stage as 'SalesStage',

(SELECT DATEDIFF(NOW(),opp1.date_closed) FROM opportunities as opp1
WHERE opp1.id = opp.id LIMIT 1) as 'ClosedDate',

(SELECT CONCAT(u.user_name,' ') FROM users as u WHERE u.id=opp.assigned_user_id) AS 'AssignedTo',

(
SELECT DATEDIFF(NOW(),callc.date_modified)
FROM opportunities as opp1
LEFT OUTER JOIN opportunities_contacts as oppc ON oppc.opportunity_id = opp1.id
LEFT OUTER JOIN calls_contacts as callc ON callc.contact_id = oppc.contact_id
LEFT OUTER JOIN calls as cl ON cl.id = callc.call_id
WHERE cl.status = 'Held'
AND opp1.id = opp.id
#GROUP BY opp.id
ORDER BY opp1.date_modified DESC
LIMIT 1
) as 'LastCallHeld',

(
SELECT DATEDIFF(NOW(),meetc.date_modified)
FROM opportunities as opp1
LEFT OUTER JOIN opportunities_contacts as oppc ON oppc.opportunity_id = opp1.id
LEFT OUTER JOIN meetings_contacts as meetc ON meetc.contact_id = oppc.contact_id
LEFT OUTER JOIN meetings as mt ON mt.id = meetc.meeting_id
WHERE mt.status = 'Held'
AND opp1.id = opp.id
GROUP BY opp.id
ORDER BY opp1.date_modified DESC
LIMIT 1
) as 'LastMeetingHeld',

(
SELECT DATEDIFF(NOW(),em.date_sent)
FROM opportunities as opp1
LEFT OUTER JOIN emails as em ON em.parent_id = opp1.id AND em.parent_type='Opportunities'
WHERE em.status = 'sent'
AND opp1.id = opp.id
GROUP BY opp1.id
LIMIT 1
) as 'LastEmail',

(SELECT DATEDIFF(NOW(),opp1.date_entered) FROM opportunities as opp1 WHERE opp.id = opp1.id) as 'Age'
FROM opportunities as opp
WHERE opp.sales_stage <> "Closed Won" AND opp.sales_stage <> "Closed Lost" AND opp.deleted = 0
GROUP BY opp.id
HAVING ClosedDate <> ''   #AND LastCallHeld <> '' AND LastEmail <> '' ClosedDate <> ''
ORDER BY ClosedDate ASC
LIMIT 10