<?php

// Include classes
include_once('tbs_class.php'); // Load the TinyButStrong template engine
include_once('tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
}

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// Retrieve the user name to display
$partnerCompanyName = (isset($_POST['partnerCompanyName'])) ? $_POST['partnerCompanyName'] : '';
$partnerCompanyName = trim(''.$partnerCompanyName);
if ($partnerCompanyName=='') $partnerCompanyName = "(no required)";

$partnerRegistrationNumber = (isset($_POST['partnerRegistrationNumber'])) ? $_POST['partnerRegistrationNumber'] : '';
$partnerRegistrationNumber = trim(''.$partnerRegistrationNumber);
if ($partnerRegistrationNumber=='') $partnerRegistrationNumber = "(no required)";

$partnerAddress = (isset($_POST['partnerAddress'])) ? $_POST['partnerAddress'] : '';
$partnerAddress = trim(''.$partnerAddress);
if ($partnerAddress=='') $partnerAddress = "(no required)";

$partnerURL = (isset($_POST['partnerURL'])) ? $_POST['partnerURL'] : '';
$partnerURL = trim(''.$partnerURL);
if ($partnerURL=='') $partnerURL = "(no required)";

$commissionStructure = (isset($_POST['commissionStructure'])) ? $_POST['commissionStructure'] : '';
$commissionStructure = trim(''.$commissionStructure);
if ($commissionStructure=='') $commissionStructure = "(no required)";

$commissionPercent = (isset($_POST['commissionPercent'])) ? $_POST['commissionPercent'] : '';
$commissionPercent = trim(''.$commissionPercent);
if ($commissionPercent=='') $commissionPercent = "(no required)";

$commissionPayment = (isset($_POST['commissionPayment'])) ? $_POST['commissionPayment'] : '';
$commissionPayment = trim(''.$commissionPayment);
if ($commissionPayment=='') $commissionPayment = "(no required)";

$commissionNote = (isset($_POST['indemntiyClause']) && $_POST['indemntiyClause'] == 'No') ? 
	"The Partner acknowledges that this Agreement does not create any direct contractual relationships between the Partner and any of the Booking Providers. \n\n4.7	 The Partner will indemnify and hold the Company harmless from all claims, damages, and expenses (including, without limitation, attorney's fees) relating to the Partner's breach of this Agreement and/or the development, operation, maintenance, and contents of the Partner Site." 
	: 
	"The Partner acknowledges that this Agreement does not create any direct contractual relationships between the Partner and any of the Booking Providers.";
$commissionNote = trim(''.$commissionNote);
if ($commissionNote=='') $commissionNote = "";

$indemntiyClause = (isset($_POST['indemntiyClause'])) ? $_POST['indemntiyClause'] : '';
$indemntiyClause = trim(''.$indemntiyClause);
if ($indemntiyClause=='') $indemntiyClause = "(no required)";

$takeMonth = (isset($_POST['takeMonth'])) ? $_POST['takeMonth'] : '';
$takeMonth = trim(''.$takeMonth);
if ($takeMonth=='') $takeMonth = "(no required)";

$jurisdiction = (isset($_POST['jurisdiction'])) ? $_POST['jurisdiction'] : '';
$jurisdiction = trim(''.$jurisdiction);
if ($jurisdiction=='') $jurisdiction = "(no required)";

$contactPhone = (isset($_POST['contactPhone'])) ? $_POST['contactPhone'] : '';
$contactPhone = trim(''.$contactPhone);
if ($contactPhone=='') $contactPhone = "(no required contact phone number)";

$contactEmail = (isset($_POST['contactEmail'])) ? $_POST['contactEmail'] : '';
$contactEmail = trim(''.$contactEmail);
if ($contactEmail=='') $contactEmail = "(no required contact email)";

// -----------------
// Load the template
// -----------------

$template = 'demo_oo_text.odt';
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// Define the name of the output file
$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
if ($save_as==='') {
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
}