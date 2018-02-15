############################################
#
# Count Opps By User and Sales Stage
#
############################################


SELECT
#ops.assigned_user_id AS 'Assigned User',
(SELECT CONCAT(u.user_name,' ') FROM users as u WHERE u.id=ops.assigned_user_id) as UserName,
#(SELECT CONCAT(u.first_name,' ',u.last_name) FROM users as u WHERE u.id=ops.assigned_user_id) as FullName,

(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Needs Analysis' AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS ' TA Needs Analysis',

(SELECT round(avg(DATEDIFF(NOW(),ops1.date_entered) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Needs Analysis' AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'TNA Needs Analysis',

(SELECT count(*) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Needs Analysis' AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'TOTAL',

(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Negotiation/Review'  AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'Negotiation Review',

(SELECT count(*) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Negotiation/Review' AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'TOTAL',


(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Perception Analysis'  AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'Perception Analysis',

(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Proposal/Price Quote'  AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'Proposal Price Quote',

(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Prospecting'  AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'Prospecting',

(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Qualification'  AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'Qualification',

(SELECT round(avg(DATEDIFF(NOW(),opsa1.date_created) )) FROM opportunities as ops1
LEFT JOIN opportunities_audit as opsa1 ON ops1.id = opsa1.parent_id
WHERE ops1.sales_stage = 'Value Proposition'  AND ops1.assigned_user_id = ops.assigned_user_id
group by ops1.assigned_user_id  ) AS 'Value Proposition',

COUNT(*) AS 'TOTAL'

FROM opportunities as ops
WHERE ops.deleted = 0
GROUP BY ops.assigned_user_id
LIMIT 0,30



