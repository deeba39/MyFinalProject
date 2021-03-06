<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "audittrailinfo.php" ?>
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
$audittrail_add = new caudittrail_add();
$Page =& $audittrail_add;

// Page init
$audittrail_add->Page_Init();

// Page main
$audittrail_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var audittrail_add = new ew_Page("audittrail_add");

// page properties
audittrail_add.PageID = "add"; // page ID
audittrail_add.FormID = "faudittrailadd"; // form ID
var EW_PAGE_ID = audittrail_add.PageID; // for backward compatibility

// extend page with ValidateForm function
audittrail_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_datetime"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($audittrail->datetime->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_datetime"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($audittrail->datetime->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
audittrail_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
audittrail_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
audittrail_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $audittrail->TableCaption() ?><br><br>
<a href="<?php echo $audittrail->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$audittrail_add->ShowMessage();
?>
<form name="faudittrailadd" id="faudittrailadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return audittrail_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="audittrail">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->datetime->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $audittrail->datetime->CellAttributes() ?>><span id="el_datetime">
<input type="text" name="x_datetime" id="x_datetime" title="<?php echo $audittrail->datetime->FldTitle() ?>" value="<?php echo $audittrail->datetime->EditValue ?>"<?php echo $audittrail->datetime->EditAttributes() ?>>
</span><?php echo $audittrail->datetime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->script->FldCaption() ?></td>
		<td<?php echo $audittrail->script->CellAttributes() ?>><span id="el_script">
<input type="text" name="x_script" id="x_script" title="<?php echo $audittrail->script->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->script->EditValue ?>"<?php echo $audittrail->script->EditAttributes() ?>>
</span><?php echo $audittrail->script->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->user->FldCaption() ?></td>
		<td<?php echo $audittrail->user->CellAttributes() ?>><span id="el_user">
<input type="text" name="x_user" id="x_user" title="<?php echo $audittrail->user->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->user->EditValue ?>"<?php echo $audittrail->user->EditAttributes() ?>>
</span><?php echo $audittrail->user->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->action->Visible) { // action ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->action->FldCaption() ?></td>
		<td<?php echo $audittrail->action->CellAttributes() ?>><span id="el_action">
<input type="text" name="x_action" id="x_action" title="<?php echo $audittrail->action->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->action->EditValue ?>"<?php echo $audittrail->action->EditAttributes() ?>>
</span><?php echo $audittrail->action->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->table->Visible) { // table ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->table->FldCaption() ?></td>
		<td<?php echo $audittrail->table->CellAttributes() ?>><span id="el_table">
<input type="text" name="x_table" id="x_table" title="<?php echo $audittrail->table->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->table->EditValue ?>"<?php echo $audittrail->table->EditAttributes() ?>>
</span><?php echo $audittrail->table->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->zfield->Visible) { // field ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->zfield->FldCaption() ?></td>
		<td<?php echo $audittrail->zfield->CellAttributes() ?>><span id="el_zfield">
<input type="text" name="x_zfield" id="x_zfield" title="<?php echo $audittrail->zfield->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->zfield->EditValue ?>"<?php echo $audittrail->zfield->EditAttributes() ?>>
</span><?php echo $audittrail->zfield->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->keyvalue->Visible) { // keyvalue ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->keyvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->keyvalue->CellAttributes() ?>><span id="el_keyvalue">
<textarea name="x_keyvalue" id="x_keyvalue" title="<?php echo $audittrail->keyvalue->FldTitle() ?>" cols="35" rows="4"<?php echo $audittrail->keyvalue->EditAttributes() ?>><?php echo $audittrail->keyvalue->EditValue ?></textarea>
</span><?php echo $audittrail->keyvalue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->oldvalue->Visible) { // oldvalue ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->oldvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->oldvalue->CellAttributes() ?>><span id="el_oldvalue">
<textarea name="x_oldvalue" id="x_oldvalue" title="<?php echo $audittrail->oldvalue->FldTitle() ?>" cols="35" rows="4"<?php echo $audittrail->oldvalue->EditAttributes() ?>><?php echo $audittrail->oldvalue->EditValue ?></textarea>
</span><?php echo $audittrail->oldvalue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($audittrail->newvalue->Visible) { // newvalue ?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $audittrail->newvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->newvalue->CellAttributes() ?>><span id="el_newvalue">
<textarea name="x_newvalue" id="x_newvalue" title="<?php echo $audittrail->newvalue->FldTitle() ?>" cols="35" rows="4"<?php echo $audittrail->newvalue->EditAttributes() ?>><?php echo $audittrail->newvalue->EditValue ?></textarea>
</span><?php echo $audittrail->newvalue->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$audittrail_add->Page_Terminate();
?>
<?php

//
// Page class
//
class caudittrail_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'audittrail';

	// Page object name
	var $PageObjName = 'audittrail_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $audittrail;
		if ($audittrail->UseTokenInUrl) $PageUrl .= "t=" . $audittrail->TableVar . "&"; // Add page token
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
		global $objForm, $audittrail;
		if ($audittrail->UseTokenInUrl) {
			if ($objForm)
				return ($audittrail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($audittrail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caudittrail_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (audittrail)
		$GLOBALS["audittrail"] = new caudittrail();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'audittrail', TRUE);

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
		global $audittrail;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("audittraillist.php");
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $audittrail;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $audittrail->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $audittrail->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$audittrail->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $audittrail->CurrentAction = "C"; // Copy record
		  } else {
		    $audittrail->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($audittrail->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("audittraillist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$audittrail->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $audittrail->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$audittrail->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $audittrail;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $audittrail;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $audittrail;
		$audittrail->datetime->setFormValue($objForm->GetValue("x_datetime"));
		$audittrail->datetime->CurrentValue = ew_UnFormatDateTime($audittrail->datetime->CurrentValue, 7);
		$audittrail->script->setFormValue($objForm->GetValue("x_script"));
		$audittrail->user->setFormValue($objForm->GetValue("x_user"));
		$audittrail->action->setFormValue($objForm->GetValue("x_action"));
		$audittrail->table->setFormValue($objForm->GetValue("x_table"));
		$audittrail->zfield->setFormValue($objForm->GetValue("x_zfield"));
		$audittrail->keyvalue->setFormValue($objForm->GetValue("x_keyvalue"));
		$audittrail->oldvalue->setFormValue($objForm->GetValue("x_oldvalue"));
		$audittrail->newvalue->setFormValue($objForm->GetValue("x_newvalue"));
		$audittrail->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $audittrail;
		$audittrail->id->CurrentValue = $audittrail->id->FormValue;
		$audittrail->datetime->CurrentValue = $audittrail->datetime->FormValue;
		$audittrail->datetime->CurrentValue = ew_UnFormatDateTime($audittrail->datetime->CurrentValue, 7);
		$audittrail->script->CurrentValue = $audittrail->script->FormValue;
		$audittrail->user->CurrentValue = $audittrail->user->FormValue;
		$audittrail->action->CurrentValue = $audittrail->action->FormValue;
		$audittrail->table->CurrentValue = $audittrail->table->FormValue;
		$audittrail->zfield->CurrentValue = $audittrail->zfield->FormValue;
		$audittrail->keyvalue->CurrentValue = $audittrail->keyvalue->FormValue;
		$audittrail->oldvalue->CurrentValue = $audittrail->oldvalue->FormValue;
		$audittrail->newvalue->CurrentValue = $audittrail->newvalue->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $audittrail;
		$sFilter = $audittrail->KeyFilter();

		// Call Row Selecting event
		$audittrail->Row_Selecting($sFilter);

		// Load SQL based on filter
		$audittrail->CurrentFilter = $sFilter;
		$sSql = $audittrail->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$audittrail->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $audittrail;
		$audittrail->id->setDbValue($rs->fields('id'));
		$audittrail->datetime->setDbValue($rs->fields('datetime'));
		$audittrail->script->setDbValue($rs->fields('script'));
		$audittrail->user->setDbValue($rs->fields('user'));
		$audittrail->action->setDbValue($rs->fields('action'));
		$audittrail->table->setDbValue($rs->fields('table'));
		$audittrail->zfield->setDbValue($rs->fields('field'));
		$audittrail->keyvalue->setDbValue($rs->fields('keyvalue'));
		$audittrail->oldvalue->setDbValue($rs->fields('oldvalue'));
		$audittrail->newvalue->setDbValue($rs->fields('newvalue'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $audittrail;

		// Initialize URLs
		// Call Row_Rendering event

		$audittrail->Row_Rendering();

		// Common render codes for all row types
		// datetime

		$audittrail->datetime->CellCssStyle = ""; $audittrail->datetime->CellCssClass = "";
		$audittrail->datetime->CellAttrs = array(); $audittrail->datetime->ViewAttrs = array(); $audittrail->datetime->EditAttrs = array();

		// script
		$audittrail->script->CellCssStyle = ""; $audittrail->script->CellCssClass = "";
		$audittrail->script->CellAttrs = array(); $audittrail->script->ViewAttrs = array(); $audittrail->script->EditAttrs = array();

		// user
		$audittrail->user->CellCssStyle = ""; $audittrail->user->CellCssClass = "";
		$audittrail->user->CellAttrs = array(); $audittrail->user->ViewAttrs = array(); $audittrail->user->EditAttrs = array();

		// action
		$audittrail->action->CellCssStyle = ""; $audittrail->action->CellCssClass = "";
		$audittrail->action->CellAttrs = array(); $audittrail->action->ViewAttrs = array(); $audittrail->action->EditAttrs = array();

		// table
		$audittrail->table->CellCssStyle = ""; $audittrail->table->CellCssClass = "";
		$audittrail->table->CellAttrs = array(); $audittrail->table->ViewAttrs = array(); $audittrail->table->EditAttrs = array();

		// field
		$audittrail->zfield->CellCssStyle = ""; $audittrail->zfield->CellCssClass = "";
		$audittrail->zfield->CellAttrs = array(); $audittrail->zfield->ViewAttrs = array(); $audittrail->zfield->EditAttrs = array();

		// keyvalue
		$audittrail->keyvalue->CellCssStyle = ""; $audittrail->keyvalue->CellCssClass = "";
		$audittrail->keyvalue->CellAttrs = array(); $audittrail->keyvalue->ViewAttrs = array(); $audittrail->keyvalue->EditAttrs = array();

		// oldvalue
		$audittrail->oldvalue->CellCssStyle = ""; $audittrail->oldvalue->CellCssClass = "";
		$audittrail->oldvalue->CellAttrs = array(); $audittrail->oldvalue->ViewAttrs = array(); $audittrail->oldvalue->EditAttrs = array();

		// newvalue
		$audittrail->newvalue->CellCssStyle = ""; $audittrail->newvalue->CellCssClass = "";
		$audittrail->newvalue->CellAttrs = array(); $audittrail->newvalue->ViewAttrs = array(); $audittrail->newvalue->EditAttrs = array();
		if ($audittrail->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$audittrail->id->ViewValue = $audittrail->id->CurrentValue;
			$audittrail->id->CssStyle = "";
			$audittrail->id->CssClass = "";
			$audittrail->id->ViewCustomAttributes = "";

			// datetime
			$audittrail->datetime->ViewValue = $audittrail->datetime->CurrentValue;
			$audittrail->datetime->ViewValue = ew_FormatDateTime($audittrail->datetime->ViewValue, 7);
			$audittrail->datetime->CssStyle = "";
			$audittrail->datetime->CssClass = "";
			$audittrail->datetime->ViewCustomAttributes = "";

			// script
			$audittrail->script->ViewValue = $audittrail->script->CurrentValue;
			$audittrail->script->CssStyle = "";
			$audittrail->script->CssClass = "";
			$audittrail->script->ViewCustomAttributes = "";

			// user
			$audittrail->user->ViewValue = $audittrail->user->CurrentValue;
			$audittrail->user->CssStyle = "";
			$audittrail->user->CssClass = "";
			$audittrail->user->ViewCustomAttributes = "";

			// action
			$audittrail->action->ViewValue = $audittrail->action->CurrentValue;
			$audittrail->action->CssStyle = "";
			$audittrail->action->CssClass = "";
			$audittrail->action->ViewCustomAttributes = "";

			// table
			$audittrail->table->ViewValue = $audittrail->table->CurrentValue;
			$audittrail->table->CssStyle = "";
			$audittrail->table->CssClass = "";
			$audittrail->table->ViewCustomAttributes = "";

			// field
			$audittrail->zfield->ViewValue = $audittrail->zfield->CurrentValue;
			$audittrail->zfield->CssStyle = "";
			$audittrail->zfield->CssClass = "";
			$audittrail->zfield->ViewCustomAttributes = "";

			// keyvalue
			$audittrail->keyvalue->ViewValue = $audittrail->keyvalue->CurrentValue;
			$audittrail->keyvalue->CssStyle = "";
			$audittrail->keyvalue->CssClass = "";
			$audittrail->keyvalue->ViewCustomAttributes = "";

			// oldvalue
			$audittrail->oldvalue->ViewValue = $audittrail->oldvalue->CurrentValue;
			$audittrail->oldvalue->CssStyle = "";
			$audittrail->oldvalue->CssClass = "";
			$audittrail->oldvalue->ViewCustomAttributes = "";

			// newvalue
			$audittrail->newvalue->ViewValue = $audittrail->newvalue->CurrentValue;
			$audittrail->newvalue->CssStyle = "";
			$audittrail->newvalue->CssClass = "";
			$audittrail->newvalue->ViewCustomAttributes = "";

			// datetime
			$audittrail->datetime->HrefValue = "";
			$audittrail->datetime->TooltipValue = "";

			// script
			$audittrail->script->HrefValue = "";
			$audittrail->script->TooltipValue = "";

			// user
			$audittrail->user->HrefValue = "";
			$audittrail->user->TooltipValue = "";

			// action
			$audittrail->action->HrefValue = "";
			$audittrail->action->TooltipValue = "";

			// table
			$audittrail->table->HrefValue = "";
			$audittrail->table->TooltipValue = "";

			// field
			$audittrail->zfield->HrefValue = "";
			$audittrail->zfield->TooltipValue = "";

			// keyvalue
			$audittrail->keyvalue->HrefValue = "";
			$audittrail->keyvalue->TooltipValue = "";

			// oldvalue
			$audittrail->oldvalue->HrefValue = "";
			$audittrail->oldvalue->TooltipValue = "";

			// newvalue
			$audittrail->newvalue->HrefValue = "";
			$audittrail->newvalue->TooltipValue = "";
		} elseif ($audittrail->RowType == EW_ROWTYPE_ADD) { // Add row

			// datetime
			$audittrail->datetime->EditCustomAttributes = "";
			$audittrail->datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime($audittrail->datetime->CurrentValue, 7));

			// script
			$audittrail->script->EditCustomAttributes = "";
			$audittrail->script->EditValue = ew_HtmlEncode($audittrail->script->CurrentValue);

			// user
			$audittrail->user->EditCustomAttributes = "";
			$audittrail->user->EditValue = ew_HtmlEncode($audittrail->user->CurrentValue);

			// action
			$audittrail->action->EditCustomAttributes = "";
			$audittrail->action->EditValue = ew_HtmlEncode($audittrail->action->CurrentValue);

			// table
			$audittrail->table->EditCustomAttributes = "";
			$audittrail->table->EditValue = ew_HtmlEncode($audittrail->table->CurrentValue);

			// field
			$audittrail->zfield->EditCustomAttributes = "";
			$audittrail->zfield->EditValue = ew_HtmlEncode($audittrail->zfield->CurrentValue);

			// keyvalue
			$audittrail->keyvalue->EditCustomAttributes = "";
			$audittrail->keyvalue->EditValue = ew_HtmlEncode($audittrail->keyvalue->CurrentValue);

			// oldvalue
			$audittrail->oldvalue->EditCustomAttributes = "";
			$audittrail->oldvalue->EditValue = ew_HtmlEncode($audittrail->oldvalue->CurrentValue);

			// newvalue
			$audittrail->newvalue->EditCustomAttributes = "";
			$audittrail->newvalue->EditValue = ew_HtmlEncode($audittrail->newvalue->CurrentValue);
		}

		// Call Row Rendered event
		if ($audittrail->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$audittrail->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $audittrail;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($audittrail->datetime->FormValue) && $audittrail->datetime->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $audittrail->datetime->FldCaption();
		}
		if (!ew_CheckEuroDate($audittrail->datetime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $audittrail->datetime->FldErrMsg();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $audittrail;
		$rsnew = array();

		// datetime
		$audittrail->datetime->SetDbValueDef($rsnew, ew_UnFormatDateTime($audittrail->datetime->CurrentValue, 7, FALSE), ew_CurrentDate());

		// script
		$audittrail->script->SetDbValueDef($rsnew, $audittrail->script->CurrentValue, NULL, FALSE);

		// user
		$audittrail->user->SetDbValueDef($rsnew, $audittrail->user->CurrentValue, NULL, FALSE);

		// action
		$audittrail->action->SetDbValueDef($rsnew, $audittrail->action->CurrentValue, NULL, FALSE);

		// table
		$audittrail->table->SetDbValueDef($rsnew, $audittrail->table->CurrentValue, NULL, FALSE);

		// field
		$audittrail->zfield->SetDbValueDef($rsnew, $audittrail->zfield->CurrentValue, NULL, FALSE);

		// keyvalue
		$audittrail->keyvalue->SetDbValueDef($rsnew, $audittrail->keyvalue->CurrentValue, NULL, FALSE);

		// oldvalue
		$audittrail->oldvalue->SetDbValueDef($rsnew, $audittrail->oldvalue->CurrentValue, NULL, FALSE);

		// newvalue
		$audittrail->newvalue->SetDbValueDef($rsnew, $audittrail->newvalue->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $audittrail->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($audittrail->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($audittrail->CancelMessage <> "") {
				$this->setMessage($audittrail->CancelMessage);
				$audittrail->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$audittrail->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $audittrail->id->DbValue;

			// Call Row Inserted event
			$audittrail->Row_Inserted($rsnew);
		}
		return $AddRow;
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
