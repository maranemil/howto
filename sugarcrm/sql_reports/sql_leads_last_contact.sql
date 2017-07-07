############################################
#
# Leads Last Activity
#
############################################

SELECT

DATEDIFF(NOW(),ml.date_modified) as  m_days,		# Meeting Days last contact
DATEDIFF(NOW(),cl.date_modified) as  c_days,		# Call Days last contact
DATEDIFF(NOW(),leads.date_entered) as l_days,	# Lead Days since created
DATEDIFF(NOW(),la.date_created) as la_days,		# Lead Days since status changed
DATEDIFF(NOW(),e.`date_entered`) as e_days,		# Email Days since created


substr(la.date_created,1,10) as la_created, 		# Lead Date last status changed
substr(leads.date_entered,1,10) as l_created, 		# Lead Date created
#IFNULL(leads.id,'') primaryid
concat(leads.first_name,' ',leads.last_name) as l_name,  # Lead Name
IFNULL(leads.status,'') as l_status,					# Lead Status
IFNULL(leads.account_name,'') as acc_name,				# Account Name
substr(ml.date_modified,1,10) as last_meeting,				# Date last meeting
substr(cl.date_modified,1,10) as last_call,					# Date last call
substr(e.`date_entered`,1,10) as last_email			# Email Created

FROM leads

LEFT OUTER JOIN calls_leads cl ON leads.id=cl.lead_id AND cl.deleted=0
LEFT OUTER JOIN calls c ON c.id=cl.call_id AND c.deleted=0

LEFT OUTER JOIN meetings_leads ml ON leads.id=ml.lead_id AND ml.deleted=0
LEFT OUTER JOIN meetings m ON m.id=ml.meeting_id AND m.deleted=0

LEFT OUTER JOIN leads_audit la ON la.parent_id = leads.id
LEFT OUTER JOIN emails as e ON e.parent_id = leads.id AND e.parent_type='Leads'

WHERE leads.deleted=0
AND ((leads.status = 'New') OR (leads.status = 'Assigned') )
#AND m.date_entered IS NOT NULL
#AND c.date_entered IS NOT NULL
GROUP BY leads.id
ORDER BY la.date_created DESC
LIMIT 100