<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "financial_yearinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$financial_year_edit = new cfinancial_year_edit();
$Page =& $financial_year_edit;

// Page init
$financial_year_edit->Page_Init();

// Page main
$financial_year_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var financial_year_edit = new ew_Page("financial_year_edit");

// page properties
financial_year_edit.PageID = "edit"; // page ID
financial_year_edit.FormID = "ffinancial_yearedit"; // form ID
var EW_PAGE_ID = financial_year_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
financial_year_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_date_start"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($financial_year->date_start->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_date_end"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($financial_year->date_end->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
financial_year_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
financial_year_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
financial_year_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $financial_year->TableCaption() ?><br><br>
<a href="<?php echo $financial_year->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$financial_year_edit->ShowMessage();
?>
<form name="ffinancial_yearedit" id="ffinancial_yearedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return financial_year_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="financial_year">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($financial_year->financial_year_id->Visible) { // financial_year_id ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->financial_year_id->FldCaption() ?></td>
		<td<?php echo $financial_year->financial_year_id->CellAttributes() ?>><span id="el_financial_year_id">
<div<?php echo $financial_year->financial_year_id->ViewAttributes() ?>><?php echo $financial_year->financial_year_id->EditValue ?></div><input type="hidden" name="x_financial_year_id" id="x_financial_year_id" value="<?php echo ew_HtmlEncode($financial_year->financial_year_id->CurrentValue) ?>">
</span><?php echo $financial_year->financial_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($financial_year->year_name->Visible) { // year_name ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->year_name->FldCaption() ?></td>
		<td<?php echo $financial_year->year_name->CellAttributes() ?>><span id="el_year_name">
<input type="text" name="x_year_name" id="x_year_name" title="<?php echo $financial_year->year_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $financial_year->year_name->EditValue ?>"<?php echo $financial_year->year_name->EditAttributes() ?>>
</span><?php echo $financial_year->year_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($financial_year->date_start->Visible) { // date_start ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->date_start->FldCaption() ?></td>
		<td<?php echo $financial_year->date_start->CellAttributes() ?>><span id="el_date_start">
<input type="text" name="x_date_start" id="x_date_start" title="<?php echo $financial_year->date_start->FldTitle() ?>" value="<?php echo $financial_year->date_start->EditValue ?>"<?php echo $financial_year->date_start->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date_start" name="cal_x_date_start" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_date_start", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_date_start" // button id
});
</script>
</span><?php echo $financial_year->date_start->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($financial_year->date_end->Visible) { // date_end ?>
	<tr<?php echo $financial_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $financial_year->date_end->FldCaption() ?></td>
		<td<?php echo $financial_year->date_end->CellAttributes() ?>><span id="el_date_end">
<input type="text" name="x_date_end" id="x_date_end" title="<?php echo $financial_year->date_end->FldTitle() ?>" value="<?php echo $financial_year->date_end->EditValue ?>"<?php echo $financial_year->date_end->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date_end" name="cal_x_date_end" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_date_end", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_date_end" // button id
});
</script>
</span><?php echo $financial_year->date_end->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$financial_year_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cfinancial_year_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'financial_year';

	// Page object name
	var $PageObjName = 'financial_year_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $financial_year;
		if ($financial_year->UseTokenInUrl) $PageUrl .= "t=" . $financial_year->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $financial_year;
		if ($financial_year->UseTokenInUrl) {
			if ($objForm)
				return ($financial_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($financial_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfinancial_year_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (financial_year)
		$GLOBALS["financial_year"] = new cfinancial_year();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'financial_year', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $financial_year;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("financial_yearlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $financial_year;

		// Load key from QueryString
		if (@$_GET["financial_year_id"] <> "")
			$financial_year->financial_year_id->setQueryStringValue($_GET["financial_year_id"]);
		if (@$_POST["a_edit"] <> "") {
			$financial_year->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$financial_year->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$financial_year->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$financial_year->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($financial_year->financial_year_id->CurrentValue == "")
			$this->Page_Terminate("financial_yearlist.php"); // Invalid key, return to list
		switch ($financial_year->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("financial_yearlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$financial_year->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $financial_year->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$financial_year->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$financial_year->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $financial_year;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $financial_year;
		$financial_year->financial_year_id->setFormValue($objForm->GetValue("x_financial_year_id"));
		$financial_year->year_name->setFormValue($objForm->GetValue("x_year_name"));
		$financial_year->date_start->setFormValue($objForm->GetValue("x_date_start"));
		$financial_year->date_start->CurrentValue = ew_UnFormatDateTime($financial_year->date_start->CurrentValue, 7);
		$financial_year->date_end->setFormValue($objForm->GetValue("x_date_end"));
		$financial_year->date_end->CurrentValue = ew_UnFormatDateTime($financial_year->date_end->CurrentValue, 7);
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $financial_year;
		$this->LoadRow();
		$financial_year->financial_year_id->CurrentValue = $financial_year->financial_year_id->FormValue;
		$financial_year->year_name->CurrentValue = $financial_year->year_name->FormValue;
		$financial_year->date_start->CurrentValue = $financial_year->date_start->FormValue;
		$financial_year->date_start->CurrentValue = ew_UnFormatDateTime($financial_year->date_start->CurrentValue, 7);
		$financial_year->date_end->CurrentValue = $financial_year->date_end->FormValue;
		$financial_year->date_end->CurrentValue = ew_UnFormatDateTime($financial_year->date_end->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $financial_year;
		$sFilter = $financial_year->KeyFilter();

		// Call Row Selecting event
		$financial_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$financial_year->CurrentFilter = $sFilter;
		$sSql = $financial_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$financial_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $financial_year;
		$financial_year->financial_year_id->setDbValue($rs->fields('financial_year_id'));
		$financial_year->year_name->setDbValue($rs->fields('year_name'));
		$financial_year->date_start->setDbValue($rs->fields('date_start'));
		$financial_year->date_end->setDbValue($rs->fields('date_end'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $financial_year;

		// Initialize URLs
		// Call Row_Rendering event

		$financial_year->Row_Rendering();

		// Common render codes for all row types
		// financial_year_id

		$financial_year->financial_year_id->CellCssStyle = ""; $financial_year->financial_year_id->CellCssClass = "";
		$financial_year->financial_year_id->CellAttrs = array(); $financial_year->financial_year_id->ViewAttrs = array(); $financial_year->financial_year_id->EditAttrs = array();

		// year_name
		$financial_year->year_name->CellCssStyle = ""; $financial_year->year_name->CellCssClass = "";
		$financial_year->year_name->CellAttrs = array(); $financial_year->year_name->ViewAttrs = array(); $financial_year->year_name->EditAttrs = array();

		// date_start
		$financial_year->date_start->CellCssStyle = ""; $financial_year->date_start->CellCssClass = "";
		$financial_year->date_start->CellAttrs = array(); $financial_year->date_start->ViewAttrs = array(); $financial_year->date_start->EditAttrs = array();

		// date_end
		$financial_year->date_end->CellCssStyle = ""; $financial_year->date_end->CellCssClass = "";
		$financial_year->date_end->CellAttrs = array(); $financial_year->date_end->ViewAttrs = array(); $financial_year->date_end->EditAttrs = array();
		if ($financial_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// financial_year_id
			$financial_year->financial_year_id->ViewValue = $financial_year->financial_year_id->CurrentValue;
			$financial_year->financial_year_id->CssStyle = "";
			$financial_year->financial_year_id->CssClass = "";
			$financial_year->financial_year_id->ViewCustomAttributes = "";

			// year_name
			$financial_year->year_name->ViewValue = $financial_year->year_name->CurrentValue;
			$financial_year->year_name->CssStyle = "";
			$financial_year->year_name->CssClass = "";
			$financial_year->year_name->ViewCustomAttributes = "";

			// date_start
			$financial_year->date_start->ViewValue = $financial_year->date_start->CurrentValue;
			$financial_year->date_start->ViewValue = ew_FormatDateTime($financial_year->date_start->ViewValue, 7);
			$financial_year->date_start->CssStyle = "";
			$financial_year->date_start->CssClass = "";
			$financial_year->date_start->ViewCustomAttributes = "";

			// date_end
			$financial_year->date_end->ViewValue = $financial_year->date_end->CurrentValue;
			$financial_year->date_end->ViewValue = ew_FormatDateTime($financial_year->date_end->ViewValue, 7);
			$financial_year->date_end->CssStyle = "";
			$financial_year->date_end->CssClass = "";
			$financial_year->date_end->ViewCustomAttributes = "";

			// financial_year_id
			$financial_year->financial_year_id->HrefValue = "";
			$financial_year->financial_year_id->TooltipValue = "";

			// year_name
			$financial_year->year_name->HrefValue = "";
			$financial_year->year_name->TooltipValue = "";

			// date_start
			$financial_year->date_start->HrefValue = "";
			$financial_year->date_start->TooltipValue = "";

			// date_end
			$financial_year->date_end->HrefValue = "";
			$financial_year->date_end->TooltipValue = "";
		} elseif ($financial_year->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// financial_year_id
			$financial_year->financial_year_id->EditCustomAttributes = "";
			$financial_year->financial_year_id->EditValue = $financial_year->financial_year_id->CurrentValue;
			$financial_year->financial_year_id->CssStyle = "";
			$financial_year->financial_year_id->CssClass = "";
			$financial_year->financial_year_id->ViewCustomAttributes = "";

			// year_name
			$financial_year->year_name->EditCustomAttributes = "";
			$financial_year->year_name->EditValue = ew_HtmlEncode($financial_year->year_name->CurrentValue);

			// date_start
			$financial_year->date_start->EditCustomAttributes = "";
			$financial_year->date_start->EditValue = ew_HtmlEncode(ew_FormatDateTime($financial_year->date_start->CurrentValue, 7));

			// date_end
			$financial_year->date_end->EditCustomAttributes = "";
			$financial_year->date_end->EditValue = ew_HtmlEncode(ew_FormatDateTime($financial_year->date_end->CurrentValue, 7));

			// Edit refer script
			// financial_year_id

			$financial_year->financial_year_id->HrefValue = "";

			// year_name
			$financial_year->year_name->HrefValue = "";

			// date_start
			$financial_year->date_start->HrefValue = "";

			// date_end
			$financial_year->date_end->HrefValue = "";
		}

		// Call Row Rendered event
		if ($financial_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$financial_year->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $financial_year;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($financial_year->date_start->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $financial_year->date_start->FldErrMsg();
		}
		if (!ew_CheckEuroDate($financial_year->date_end->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $financial_year->date_end->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $financial_year;
		$sFilter = $financial_year->KeyFilter();
		$financial_year->CurrentFilter = $sFilter;
		$sSql = $financial_year->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// year_name
			$financial_year->year_name->SetDbValueDef($rsnew, $financial_year->year_name->CurrentValue, NULL, FALSE);

			// date_start
			$financial_year->date_start->SetDbValueDef($rsnew, ew_UnFormatDateTime($financial_year->date_start->CurrentValue, 7, FALSE), NULL);

			// date_end
			$financial_year->date_end->SetDbValueDef($rsnew, ew_UnFormatDateTime($financial_year->date_end->CurrentValue, 7, FALSE), NULL);

			// Call Row Updating event
			$bUpdateRow = $financial_year->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($financial_year->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($financial_year->CancelMessage <> "") {
					$this->setMessage($financial_year->CancelMessage);
					$financial_year->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$financial_year->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
