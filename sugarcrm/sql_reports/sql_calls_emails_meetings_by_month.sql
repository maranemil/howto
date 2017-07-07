###########################################
#
#  Calls Meetings Emails by user
#
###########################################

  SELECT
  (CONCAT(YEAR(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND), 7))) AS 'Date Created',

  (SELECT count(*) FROM calls AS cl1
  WHERE (CONCAT(YEAR(DATE_ADD(cl1.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(cl1.date_entered, INTERVAL 7200 SECOND), 7))) =
  (CONCAT(YEAR(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND), 7)))
  AND cl1.created_by = calls.created_by AND cl1.status='Held' and cl1.direction='Outbound' and cl1.parent_type IN ('Leads','Opportunities')
  AND (CONCAT(YEAR(DATE_ADD(cl1.date_end, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(cl1.date_end, INTERVAL 7200 SECOND), 7))) =
  (CONCAT(YEAR(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND), 7)))
  ) AS Calls,

  (SELECT count(*) FROM meetings AS mt1
  WHERE (CONCAT(YEAR(DATE_ADD(mt1.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(mt1.date_entered, INTERVAL 7200 SECOND), 7))) =
  (CONCAT(YEAR(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND), 7)))
  AND mt1.created_by = calls.created_by and mt1.parent_type IN ('Leads','Opportunities')
  ) AS Meetings,

    (SELECT count(*) FROM emails AS e1
  WHERE (CONCAT(YEAR(DATE_ADD(e1.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(e1.date_entered, INTERVAL 7200 SECOND), 7))) =
  (CONCAT(YEAR(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND), 7)))
  AND e1.created_by = calls.created_by and e1.parent_type IN ('Leads','Opportunities') and e1.status ='sent' and type='out'
  ) AS Emails

  FROM calls
  WHERE calls.deleted = 0
  AND ( calls.date_entered BETWEEN '2016-02-28 22:00:00' AND '2017-08-31 21:59:59' )

  GROUP BY (CONCAT(YEAR(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND)), WEEK(DATE_ADD(calls.date_entered, INTERVAL 7200 SECOND), 7)))
  LIMIT 0,15


