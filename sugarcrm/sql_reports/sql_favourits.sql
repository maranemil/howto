SELECT

users.user_name AS 'User Name',
sugarfavorites0000.date_modified AS 'Favorites Date Modified',
sugarfavorites0000.module AS 'Favorites module',

(CONCAT('
<a href="index.php?','module=',sugarfavorites0000.module,'&record=',sugarfavorites0000.record_id,'&action=DetailView">', (
SELECT (
	SELECT accounts.name AS 'namex' FROM accounts WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT CONCAT(contacts.first_name, ' ', contacts.last_name) AS 'namex' FROM contacts WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT opportunities.name AS 'namex' FROM opportunities WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT CONCAT(leads.first_name, ' ', leads.last_name) AS 'namex' FROM leads WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT saved_reports.name AS 'namex' FROM saved_reports WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT meetings.name AS 'namex' FROM meetings WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT calls.name AS 'namex' FROM calls WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT quotes.name AS 'namex' FROM quotes WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT cases.name AS 'namex' FROM cases WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT bugs.name AS 'namex' FROM bugs WHERE id = sugarfavorites0000.record_id LIMIT 1
		UNION
	SELECT tasks.name AS 'namex' FROM tasks WHERE id = sugarfavorites0000.record_id LIMIT 1 ) as 'Name' ) ,'</a>
')) AS 'Favorites Name'

FROM users
LEFT JOIN sugarfavorites sugarfavorites0000 ON (users.id=sugarfavorites0000.assigned_user_id AND sugarfavorites0000.deleted=0)
WHERE users.deleted = 0
 LIMIT 0,30