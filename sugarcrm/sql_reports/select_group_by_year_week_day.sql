
-----------
#select by year
SELECT COUNT( * ) , YEAR( DATE_ADD( o.date_entered, INTERVAL 7200 SECOND ))
FROM opportunities AS o
GROUP BY YEAR( DATE_ADD( o.date_entered, INTERVAL 7200 SECOND ))
LIMIT 20


#select by week
SELECT COUNT( WEEK( DATE_ADD( o.date_entered, INTERVAL 7200
SECOND ) , 7 ) ) , WEEK( DATE_ADD( o.date_entered, INTERVAL 7200
SECOND ) , 7 )
FROM opportunities AS o
WHERE YEAR( DATE_ADD( o.date_entered, INTERVAL 5
SECOND ) ) =  '2016'
GROUP BY WEEK( DATE_ADD( o.date_entered, INTERVAL 7200
SECOND ) , 7 )
LIMIT 60

#select by day
SELECT COUNT( WEEKDAY( o.date_entered ) ) , WEEKDAY( o.date_entered )
FROM opportunities AS o
WHERE YEAR( DATE_ADD( o.date_entered, INTERVAL 5 SECOND ) ) =  '2016'
GROUP BY WEEKDAY( o.date_entered )
LIMIT 60

# WHERE WEEKDAY(date_entered)> 0 AND WEEKDAY(date_entered) < 6;
# 0 monday 6 sunday

# http://www.w3resource.com/mysql/date-and-time-functions/mysql-weekday-function.php