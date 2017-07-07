/*SELECT IF(inty = 1, 'YES', 'No') AS internetApproved FROM Table1*/
/*SELECT CASE  WHEN inty = 0 then 'No' WHEN inty = 1 then 'Yes ELSE 'Maybe' END AS InternetApproved FROM Table1*/

###########################################
#
# SELECT WIN LOST OPPS GROUP BY OPPS
#
###########################################

SELECT
c.lead_source as LeadSource,
IF(o.sales_stage='Closed Won','WON','LOST') as OppStage,
#AVG(o.amount) as OppAmountAVG,
o.name as OppName,
#a.name as AccountName,
#o.date_entered,
count(*) as Total,
(SELECT IF(count(*)=0,'NO','YES') FROM meetings_contacts AS mc WHERE mc.contact_id = c.id LIMIT 1) AS CountMeet,
(SELECT IF(count(*)=0,'NO','YES')  FROM calls_contacts AS cc WHERE cc.contact_id = c.id LIMIT 1) AS CountCalls,
(SELECT IF(count(*)=0,'NO','YES')  FROM emails AS ee WHERE ee.parent_id = c.id AND ee.status='sent' LIMIT 1) AS CountEmails

FROM `contacts` as c
INNER JOIN opportunities_contacts as oc ON oc.contact_id = c.id
INNER JOIN opportunities as o ON o.id = oc.opportunity_id

INNER JOIN accounts_contacts AS ac ON ac.contact_id = c.id
INNER JOIN accounts AS a ON a.id = ac.account_id

#meetings_contacts
#meetings_leads
#calls_contacts
#calls_leads

WHERE o.sales_stage IN ('Closed Won','Closed Lost') #
#AND c.lead_source IN ('Existing Customer')
AND c.lead_source IS NOT NULL AND c.lead_source!='' AND c.lead_source!='0'
#GROUP BY c.lead_source
GROUP BY o.name
ORDER BY Total DESC
#ORDER BY o.amount DESC
LIMIT 0 , 1000

###############################################
#
# SELECT BEST WIN SOURCES FROM CONVERTED LEADS
#
###############################################

SELECT
	lead_source,
	count( * ) AS Total

FROM `contacts`
WHERE `lead_source` != ''
GROUP BY lead_source
ORDER BY Total DESC
LIMIT 0 , 30