<?php

/*
#########################################################

CREATE CSV AND XLS EXAMPLE

https://www.php-einfach.de/mysql-tutorial/crashkurs-mysqli/
https://hotexamples.com/examples/-/PHPExcel/createSheet/php-phpexcel-createsheet-method-examples.html
http://hitautodestruct.github.io/PHPExcelAPIDocs/classes/PHPExcel.html
https://www.cloudways.com/blog/create-edit-excel-sheets-php/
https://agunghelmi.wordpress.com/2013/11/02/create-multiple-sheet-phpexcel/
https://www.cloudways.com/blog/create-edit-excel-sheets-php/
http://apigen.juzna.cz/doc/ouardisoft/PHPExcel/class-PHPExcel.html
https://phpspreadsheet.readthedocs.io/en/develop/topics/worksheets/

#########################################################
*/

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$intWeekNr = date("W", time());

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator(basename(__FILE__)); // set creator
$objPHPExcel->getProperties()->setLastModifiedBy(basename(__FILE__)); // set last modified
$objPHPExcel->getProperties()->setTitle("some title"); // set doc name

$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$CSVsheet = $spreadsheet->getActiveSheet();
$CSVsheet->setCellValue('A1', 'list_number');
$CSVsheet->setCellValue('B1', 'identifier');
$CSVsheet->setCellValue('C1', 'operator');
$CSVsheet->setCellValue('D1', 'instruction');

$arrSheets = array(1, 2, 3);
foreach ($arrSheets as $keySheet => $strSheetName) {

    // add some info for sheet
    $objPHPExcel->createSheet(); // create sheet
    $objPHPExcel->setActiveSheetIndex(intval($keySheet)); // set active sheet
    $objPHPExcel->getActiveSheet()->setTitle($strSheetName); // set sheet title

    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'col1'); // set head table
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'col2'); // set head table
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'col3'); // set head table
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'col4'); // set head table

    // Get Info
    # get SQL data
    mysql_connect("localhost", "mysql_user", "mysql_password") or die("Keine Verbindung möglich: " . mysql_error());
    mysql_select_db("mydb");
    $result = mysql_query("SELECT * name FROM mytable");

    $i = 2;
    while ($row = mysql_fetch_array($result)) {

        // push info into sheet
        $strRow_A = "A" . $i;
        $strRow_B = "B" . $i;
        $strRow_C = "C" . $i;
        $strRow_D = "D" . $i;

        $objPHPExcel->getActiveSheet()->setCellValue($strRow_A, $row["col1"]);
        $objPHPExcel->getActiveSheet()->setCellValue($strRow_B, $row["col2"]);
        $objPHPExcel->getActiveSheet()->setCellValue($strRow_C, $row["col3"]);
        $objPHPExcel->getActiveSheet()->setCellValue($strRow_D, $row["col4"]);

        $CSVsheet->setCellValue($strRow_A, $i - 1);
        $CSVsheet->setCellValue($strRow_B, $row["col1"]);
        $CSVsheet->setCellValue($strRow_C, $row["col2"]);
        $CSVsheet->setCellValue($strRow_D, $row["col3"]);
        $i++;
    }
    mysql_free_result($result);

    if ($spreadsheet->getActiveSheet()->getHighestRow() > 1) {
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $writer->setDelimiter(';');
        $writer->setEnclosure('');
        $writer->setLineEnding("\r\n");
        $writer->setSheetIndex(0);
        $strCSVFilename = "" . FileExport_ . "_" . $intWeekNr . "_" . time() . ".csv";
        // save CSV 2007 file
        $writer->save($strCSVFilename);
        $arrCSVFiles[] = $strCSVFilename;
    }
}

// set first sheet tab active
$objPHPExcel->setActiveSheetIndex(0);
$strFilenameXls = 'FileExport_' . $intWeekNr . '_' . time() . '.xlsx';

// save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($strFilenameXls);
chmod($strFilenameXls, 0660);

/*
#########################################################

CREATE CSV

https://github.com/PHPOffice/PhpSpreadsheet/issues/202
https://github.com/PHPOffice/PhpSpreadsheet/issues/53
https://phpspreadsheet.readthedocs.io/en/develop/topics/reading-and-writing-to-file/
https://github.com/PHPOffice/PHPExcel
https://phpspreadsheet.readthedocs.io/en/develop/topics/accessing-cells/

#########################################################
*/

/*
require 'phptoexcel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
*/


/*
#########################################################

Export as Excel5 Format Force Download
https://hotexamples.com/examples/-/PHPExcel_IOFactory/createWriter/php-phpexcel_iofactory-createwriter-method-examples.html

#########################################################
*/


//load our new PHPExcel library
$this->load->library('excel');
//activate worksheet number 1
$this->excel->setActiveSheetIndex(0);
//name the worksheet
$this->excel->getActiveSheet()->setTitle('test worksheet');
//set cell A1 content with some text
$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
//change the font size
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
//make the font become bold
$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//merge cell A1 until D1
$this->excel->getActiveSheet()->mergeCells('A1:D1');
//set aligment to center for that merged cell (A1 to D1)
$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$filename = 'just_some_random_name.xls';
//save our workbook as this file name
header('Content-Type: application/vnd.ms-excel');
//mime type
header('Content-Disposition: attachment;filename="' . $filename . '"');
//tell browser what's the file name
header('Cache-Control: max-age=0');
//no cache
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');


#########################################################
#
#
#
#########################################################

/*
https://phpspreadsheet.readthedocs.io/en/develop/
https://phpspreadsheet.readthedocs.io/en/develop/topics/accessing-cells/
https://artisansweb.net/read-csv-excel-file-php-using-phpspreadsheet/
https://phpspreadsheet.readthedocs.io/en/develop/topics/reading-and-writing-to-file/
https://phpspreadsheet.readthedocs.io/en/develop/topics/reading-and-writing-to-file/
https://phpspreadsheet.readthedocs.io/en/develop/topics/recipes/
*/

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
$writer->save("05featuredemo.xls");

/* Here there will be some code where you create $spreadsheet */

// redirect output to client browser
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="myfile.xls"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');


#########################################################
#
#   write a newline character n in a cell altenter
#
#########################################################

/*
 * https://phpspreadsheet.readthedocs.io/en/latest/topics/accessing-cells/
 * https://phpspreadsheet.readthedocs.io/en/latest/topics/worksheets/
 * https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/#csv-comma-separated-values
 * https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#write-a-newline-character-n-in-a-cell-altenter
 * https://phpspreadsheet.readthedocs.io/en/latest/
 * https://phpspreadsheet.readthedocs.io/en/latest/
 * https://github.com/PHPOffice/PhpSpreadsheet/releases/tag/1.7.0
 * https://github.com/PHPOffice/PhpSpreadsheet/releases
 * https://phpspreadsheet.readthedocs.io/en/latest/#installation
 * */

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$str1 = "My String1";
$str2 = "My String2";

$spreadsheet = new Spreadsheet();
$spreadsheet->getActiveSheet()->getCell('A1')->setValue($str1 . PHP_EOL . $str2);
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getCell('B1')->setValue("wello norld");
#$spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setWrapText(true);
# write an Excel XLS
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
$writer->save("05featuredemo.xls");

/*
# write an CSV
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
$writer->setDelimiter(';');
$writer->setEnclosure('');
$writer->setLineEnding("\r\n");
$writer->setSheetIndex(0);
$writer->setUseBOM(true);
$writer->save("05featuredemo.csv");*/

