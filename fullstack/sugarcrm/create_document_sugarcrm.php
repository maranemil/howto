<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 20.05.16
 * Time: 18:48
 */

################################################
#
# Sugarcrm Add Document
#
###############################################

require_once('include/upload_file.php');

$upload_file = new UploadFile('uploadfile');
$document->filename = 'robots.txt';
$document->document_name = 'robots.txt';

$document->save();
$contents = file_get_contents($document->filename);

$revision = new DocumentRevision;
$revision->document_id = $document->id;
$revision->file = base64_encode($contents);
$revision->filename = $document->filename;
$revision->revision = 1;
$revision->doc_type = 'Sugar';
$revision->file_mime_type = 'text/plain';
$revision->save();

//$document->revision_id = $revision->id;
//$document->save();

$destination = clean_path($upload_file->get_upload_path($revision->id));
//$destination = clean_path($upload_file->get_upload_path($document->id));

$fp = sugar_fopen($destination, 'wb');

if (!fwrite($fp, $contents)) {
	die("ERROR: can't save file to $destination");
}

fclose($fp);

// http://stackoverflow.com/questions/18241035/sugarcrm-add-document-from-script

// --------------------------------------------------------------------------------

// http://softwarriors.webs.com/apps/blog/show/20850582-create-document-in-sugar

if (!defined('sugarEntry')) define('sugarEntry', true);
require('include/entryPoint.php');
global $db;

$doc_guid = create_guid(); //////create sugar id for doc
$doc_revision_guid = create_guid(); //////////create sugar id for doc revision
$filename = "upload/" . $doc_revision_guid; //////create file in sugar's upload dir
$OpenDoc = fopen($filename, 'w');
$writ_to_doc = "Yo"; //////content to write to file
fwrite($OpenDoc, $writ_to_doc); //////write to file

///////////insert into documents module
$qry = "INSERT INTO documents (id, date_entered, date_modified, modified_user_id, created_by, description, deleted, assigned_user_id, team_id, team_set_id, document_name, doc_id, doc_type, doc_url, active_date, exp_date, category_id, subcategory_id, status_id, document_revision_id, related_doc_id, related_doc_rev_id, is_template, template_type) VALUES ('$doc_guid', now(), now(), '1', '1', '', 0, '1', '1', '1', 'Neels.doc', '', 'Sugar', '', '2012-08-24', NULL, '', '', 'Active', '$doc_revision_guid', '', NULL, 0, '')";
$db->query($qry);

///////////insert into documents revions module
$qry = "INSERT INTO document_revisions (id, change_log, document_id, doc_id, doc_type, doc_url, date_entered, created_by, filename, file_ext, file_mime_type, revision, deleted, date_modified) VALUES ('$doc_revision_guid', 'Document Created', '$doc_guid', '', 'Sugar', '', now(), '1', 'Neels.doc', 'doc', 'application/msword', '1', 0, now())";
$db->query($qry);





