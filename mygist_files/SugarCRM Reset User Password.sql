####################################################
#
# SugarCRM Reset User Password
#
####################################################

# MySQL
update users set user_hash = md5('jim') where user_name = 'jim';  

# MSSQL
update users set user_hash = '5e027396789a18c37aeda616e3d7991b' where user_name = 'jim';
