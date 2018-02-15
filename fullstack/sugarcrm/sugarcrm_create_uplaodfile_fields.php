<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 20.05.16
 * Time: 14:00
 */

########################################################################
#
# ADD UPLOAD FIELD
# http://www.bhea.com/blog/creating-file-upload-field-core-modulecustom-module-sugar-7-x/
#
########################################################################

// Add into
//custom/Extension/modules/MySpecialModule/Ext/Vardefs/mycustomfield.php

$GLOBALS['dictionary']['MySpecialModule']['fields']['filename'] = array (
	'name' => 'filename',
	'vname' => 'LBL_FILENAME',
	'type' => 'file',
	'dbType' => 'varchar',
	'len' => '255',
	'reportable' => true,
	'comment' => 'File name associated with the note (attachment)',
	'importable' => false,

);
$GLOBALS['dictionary']['MySpecialModule']['fields']['file_mime_type'] = array(
	'name' => 'file_mime_type',
	'vname' => 'LBL_FILE_MIME_TYPE',
	'type' => 'varchar',
	'len' => '100',
	'comment' => 'Attachment MIME type',
	'importable' => false,
);
$GLOBALS['dictionary']['MySpecialModule']['fields']['file_url'] = array (
	'name' => 'file_url',
	'vname' => 'LBL_FILE_URL',
	'type' => 'varchar',
	'source' => 'non-db',
	'reportable' => false,
	'comment' => 'Path to file (can be URL)',
	'importable' => false,
);

// Add into
//custom/Extension/modules/MySpecialModule/Ext/Language/mycustomfield.en_us.lang.php

$mod_strings['LBL_FILE_MIME_TYPE'] = 'File Mime Type';
$mod_strings['LBL_FILE_URL'] = 'File URL';
$mod_strings['LBL_FILENAME'] = 'File';
