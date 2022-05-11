```

#######################################################
#
#   Date last month
#
#######################################################

https://stackoverflow.com/questions/2094797/the-first-day-of-the-current-month-in-php-using-date-modify-as-datetime-object
http://phptester.net/

echo '<br>First day of the month:' . date('Y-m-01');
echo '<br>Last day of the month:'.  date('Y-m-t');
echo '<hr>' ;

$d = date_create();
print '<BR>First day of this month: ' .date_create($d->format('Y-m-01'))->format('Y-m-d') ;
echo '<BR>First day of last month: ' .
date('m/d/y h:i a',(strtotime('last month',strtotime(date('m/01/y')))));
echo '<BR>Last day of last month: ' .
date('m/d/y h:i a',(strtotime('last day of last month',strtotime(date('Y-m-t')))));

$week_start = strtotime('last Sunday', time());
$week_end = strtotime('next Sunday', time());

$month_start = strtotime('first day of this month', time());
$month_end = strtotime('last day of this month', time());

$year_start = strtotime('first day of January', time());
$year_end = strtotime('last day of December', time());

$last_month_start = strtotime('first day of last month', time());
$last_month_end = strtotime('last day of last month', time());

echo '<hr>' ;
echo date('D, M jS Y', $week_start).'<br/>';
echo date('D, M jS Y', $week_end).'<br/>';
echo date('D, M jS Y', $month_start).'<br/>';
echo date('D, M jS Y', $month_end).'<br/>';
echo date('D, M jS Y', $year_start).'<br/>';
echo date('D, M jS Y', $year_end).'<br/>';
echo date('D, M jS Y', $last_month_start).'<br/>';
echo date('D, M jS Y', $last_month_end).'<br/>';

echo '<hr>' ;
//
$d = new DateTime('first day of this month');
echo '<br>First day of this month:' .$d->format('jS, F Y');
//
$d = new DateTime('2010-01-19');
$d->modify('first day of this month');
echo '<br>First day of a specific month:' .$d->format('jS, F Y');
//
echo '<br>alternatively...:' .date_create('2010-01-19')
->modify('first day of this month')
->format('jS, F Y');

```



```
#######################################################
Moving from MySQL to ADOdb
#######################################################

https://adodb.org/dokuwiki/doku.php?id=v5:reference:recordset:fetchobj
https://hotexamples.com/examples/-/-/NewADOConnection/php-newadoconnection-function-examples.html
https://adodb.org/dokuwiki/doku.php?id=v5:database:mysql
https://adodb.org/dokuwiki/doku.php?id=v5:userguide:mysql_tutorial

/*
* Enable ADOdb
*/
$db = newAdoConnection('mysqli')
/*
* Set the SSL parameters
*/
$db->ssl_key    = "key.pem";
$db->ssl_cert   = "cert.pem";
$db->ssl_ca     = "cacert.pem";
$db->ssl_capath = null;
$db->ssl_cipher = null;
 
/*
* Open the connection
*/
$db->connect($host, $user, $password, $database);



$SQL = "SELECT * FROM Employees"
$result = $db->execute($SQL);
$r = $result->fetchObj()
print_r($r);
print $r->first_name;

....

include('adodb.inc.php');
include('tohtml.inc.php'); /* includes the rs2html function */
$conn = newADOConnection('mysqli');
$conn->pConnect('localhost','userid','password','database');
$rs = $conn->execute('select * from table');
rs2html($rs); /* recordset to html table */

...

include("adodb.inc.php");
$db = newADOConnection('mysql');
$db->connect("localhost", "root", "password", "mydb");

...

// Section 1
include("adodb.inc.php");
$db = newADOConnection('mysqli');
$db->connect("localhost", "root", "password", "mydb");
 
// Section 2
$result = $db->execute("SELECT * FROM employees");
if ($result === false) die("failed");
 
// Section 3
while (!$result->EOF) {
    for ($i=0, $max=$result->fieldCount(); $i < $max; $i++) {
        print $result->fields[$i].' ';
    }
    $result->moveNext();
    print "<br>\n";
}

...

http://cdc.gy/sahana/3rd/adodb/docs/docs-adodb.htm#ex2
https://www.uoyep.org.ar/utiles/phpgrid/lib/inc/adodb/docs/docs-adodb.htm#ex1
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getall
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getarray
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:setfetchmode
https://adodb.org/dokuwiki/doku.php?id=v5:reference:connection:getrow
https://adodb.org/dokuwiki/doku.php?id=v5:reference:recordset:fetchobj
https://adodb.org/dokuwiki/doku.php?id=v5:reference:recordset:fetchrow
https://adodb.org/dokuwiki/doku.php?id=v5:reference:reference_index

$recordSet = $conn->Execute('select CustomerID,OrderDate from Orders');
if (!$recordSet)
    print $conn->ErrorMsg();
else
    while (!$recordSet->EOF) {
        $fld = $recordSet->FetchField(1);
        $type = $recordSet->MetaType($fld->type);

        if ( $type == 'D' || $type == 'T')
            print $recordSet->fields[0].' '.
            $recordSet->UserDate($recordSet->fields[1],'m/d/Y').'<BR>';
        else
            print $recordSet->fields[0].' '.$recordSet->fields[1].'<BR>';

        $recordSet->MoveNext();
    }
$recordSet->Close(); # optional
$conn->Close(); # optional

.......

$db->SetFetchMode(ADODB_FETCH_NUM);
$rs1 = $db->Execute('select * from table');

$db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs2 = $db->Execute('select * from table');

print_r($rs1->fields); # shows array([0]=>'v0',[1] =>'v1')
print_r($rs2->fields); # shows array(['col1']=>'v0',['col2'] =>'v1')


```
```

#######################################################
#   Address REGEX formating
#######################################################

$string = "Via Villaggio Primavera 8 22010 Brienno Co, Italy";
$pattern = '/\s(\d+){5}/i';
$replacement = ', $0,';
echo preg_replace($pattern, $replacement, $string);
// Via Villaggio Primavera 8, 22010, Brienno Co, Italy


```

