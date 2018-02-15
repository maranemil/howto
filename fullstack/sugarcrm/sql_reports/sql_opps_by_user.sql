###############################################
#
# Opp Sales Stage by User
#
###############################################


SELECT

users.first_name,

/*
Qualification
Closed Lost
Closed Won
Id. Decision Makers
Needs Analysis
Negotiation/Review
Perception Analysis
Proposal/Price Quote
Prospecting
Value Proposition
*/

(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered))) FROM opportunities as o1
LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Closed Lost' AND o1.assigned_user_id = users.id) as 'Closed Lost',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Closed Won' AND o1.assigned_user_id = users.id) as 'Closed Won',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Needs Analysis' AND o1.assigned_user_id = users.id) as 'Needs Analysis',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Negotiation/Review' AND o1.assigned_user_id = users.id) as 'Negotiation/Review',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Perceptions Analysis' AND o1.assigned_user_id = users.id) as 'Perceptions Analysis',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Proposal/Price Quote' AND o1.assigned_user_id = users.id) as 'Proposal/Price Quote',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Prospecting' AND o1.assigned_user_id = users.id) as 'Prospecting',
(SELECT ROUND(AVG(DATEDIFF(oa1.date_created,o1.date_entered)))
FROM opportunities as o1  LEFT JOIN opportunities_audit as oa1 ON oa1.parent_id = o1.id
WHERE o1.sales_stage = 'Value Proposition' AND o1.assigned_user_id = users.id) as 'Value Proposition'

FROM users
WHERE users.first_name <> ''

