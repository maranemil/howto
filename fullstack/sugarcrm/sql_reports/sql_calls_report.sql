
SELECT
    accounts.name AS 'Name',
    accounts.id AS 'ID',

    ( SELECT CONCAT('<a target="_blank" href="/#Calls/', c.id,'">', c.name, '</a>') FROM calls AS c
    WHERE c.id = calls0000.id ) AS 'Call Name',

    ((SELECT
            CONCAT('<a target="_blank" href="/#Contact/', c.id,'">', c.first_name, ' ', c.last_name, '</a>')
        FROM
            contacts AS c
                LEFT JOIN
            calls_contacts AS cc ON cc.contact_id = c.id
        WHERE
            cc.call_id = calls0000.id
        LIMIT 1)) AS 'Contact Person',
    ((SELECT
            c.id
        FROM
            contacts AS c
                LEFT JOIN
            calls_contacts AS cc ON cc.contact_id = c.id
        WHERE
            cc.call_id = calls0000.id
        LIMIT 1)) AS 'Contact Name',

    teams1000.name AS 'Firmen Teams Primär',
    calls0000.date_start AS 'Anrufe Startdatum',
    calls0000.status AS 'Calls Status',
    calls0000.name AS 'Calls Subject',
    ((SELECT
            CONCAT(first_name, ' ', last_name)
        FROM
            users
        WHERE
            id = calls0000.assigned_user_id)) AS 'Calls Assigned UserName'
FROM
    accounts
        LEFT JOIN
    calls calls0000 ON (accounts.id = calls0000.parent_id
        AND calls0000.deleted = 0)
        LEFT JOIN
    accounts_contacts accounts_contacts0001 ON (accounts.id = accounts_contacts0001.account_id
        AND accounts_contacts0001.deleted = 0)
        LEFT JOIN
    contacts contacts0001 ON (accounts_contacts0001.contact_id = contacts0001.id
        AND contacts0001.deleted = 0)
        LEFT JOIN
    contacts_cstm contacts_cstm0001 ON (contacts0001.id = contacts_cstm0001.id_c)
        LEFT JOIN
    teams teams1000 ON (accounts.team_id = teams1000.id
        AND teams1000.deleted = 0)
        LEFT JOIN
    accounts_cstm ON (accounts.id = accounts_cstm.id_c)
WHERE
    accounts.deleted = 0
GROUP BY accounts.name
ORDER BY calls0000.date_start DESC