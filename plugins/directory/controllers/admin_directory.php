<?php
class admin_directory extends adminController
{
	function __construct() {
		parent::__construct("directory");
		
		$this->menuPermission("directory");
	}
	
	### DISPLAY ######################
	function index() {
		$oDirectory = $this->loadModel("directory");
		
		// Clear saved form info
		$_SESSION["admin"]["admin_directory"] = null;
		
		$this->tplAssign("aCategories", $oDirectory->getCategories());
		$this->tplAssign("sCategory", $_GET["category"]);
		$this->tplAssign("aListings", $oDirectory->getListings($_GET["category"], true));
		$this->tplAssign("sUseImage", $oDirectory->useImage);
		
		$this->tplDisplay("admin/index.tpl");
	}
	function add() {
		$oDirectory = $this->loadModel("directory");
		
		if(!empty($_SESSION["admin"]["admin_directory"]))
			$this->tplAssign("aListing", $_SESSION["admin"]["admin_directory"]);
		else
			$this->tplAssign("aListing",
				array(
					"active" => 1
					,"categories" => array()
				)
			);
		
		$this->tplAssign("aCategories", $oDirectory->getCategories());
		$this->tplAssign("sUseImage", $oDirectory->useImage);
		$this->tplDisplay("admin/add.tpl");
	}
	function add_s() {
		$oDirectory = $this->loadModel("directory");
		
		if(empty($_POST["name"]) || count($_POST["categories"]) == 0) {
			$_SESSION["admin"]["admin_directory"] = $_POST;
			$this->forward("/admin/directory/add/?error=".urlencode("Please fill in all required fields!"));
		}
		
		$sID = $this->dbQuery(
			"INSERT INTO `{dbPrefix}directory`"
				." (`name`, `address1`, `address2`, `city`, `state`, `zip`, `phone`, `fax`, `website`, `email`, `active`, `created_datetime`, `created_by`, `updated_datetime`, `updated_by`)"
				." VALUES"
				." ("
					.$this->dbQuote($_POST["name"], "text")
					.", ".$this->dbQuote($_POST["address1"], "text")
					.", ".$this->dbQuote($_POST["address2"], "text")
					.", ".$this->dbQuote($_POST["city"], "text")
					.", ".$this->dbQuote($_POST["state"], "text")
					.", ".$this->dbQuote($_POST["zip"], "text")
					.", ".$this->dbQuote($_POST["phone"], "text")
					.", ".$this->dbQuote($_POST["fax"], "text")
					.", ".$this->dbQuote($_POST["website"], "text")
					.", ".$this->dbQuote($_POST["email"], "text")
					.", ".$this->boolCheck($_POST["active"])
					.", ".$this->dbQuote(time(), "integer")
					.", ".$this->dbQuote($_SESSION["admin"]["userid"], "integer")
					.", ".$this->dbQuote(time(), "integer")
					.", ".$this->dbQuote($_SESSION["admin"]["userid"], "integer")
				.")"
			,"insert"
		);
		
		foreach($_POST["categories"] as $sCategory) {
			$this->dbQuery(
				"INSERT INTO `{dbPrefix}directory_categories_assign`"
					." (`listingid`, `categoryid`)"
					." VALUES"
					." (".$sID.", ".$sCategory.")"
			);
		}
		
		$_SESSION["admin"]["admin_directory"] = null;
		
		$this->forward("/admin/directory/?notice=".urlencode("Listing created successfully!"));
	}
	function edit() {
		$oDirectory = $this->loadModel("directory");
		
		if(!empty($_SESSION["admin"]["admin_directory"])) {
			$aListingRow = $this->dbQuery(
				"SELECT * FROM `{dbPrefix}directory`"
					." WHERE `id` = ".$this->dbQuote($this->_urlVars->dynamic["id"], "integer")
				,"row"
			);
			
			$aListing = $_SESSION["admin"]["admin_directory"];
			
			$directory["updated_datetime"] = $aListingRow["updated_datetime"];
			$directory["updated_by"] = $this->dbQuery(
				"SELECT * FROM `{dbPrefix}users`"
					." WHERE `id` = ".$aListingRow["updated_by"]
				,"row"
			);
			
			$this->tplAssign("aListing", $aListing);
		} else {
			$aListing = $this->dbQuery(
				"SELECT * FROM `{dbPrefix}directory`"
					." WHERE `id` = ".$this->dbQuote($this->_urlVars->dynamic["id"], "integer")
				,"row"
			);
			
			$aListing["categories"] = $this->dbQuery(
				"SELECT `categories`.`id` FROM `{dbPrefix}directory_categories` AS `categories`"
					." INNER JOIN `directory_categories_assign` AS `directory_assign` ON `categories`.`id` = `directory_assign`.`categoryid`"
					." WHERE `directory_assign`.`listingid` = ".$aListing["id"]
					." GROUP BY `categories`.`id`"
					." ORDER BY `categories`.`name`"
				,"col"
			);
			
			$aListing["updated_by"] = $this->dbQuery(
				"SELECT * FROM `{dbPrefix}users`"
					." WHERE `id` = ".$aListing["updated_by"]
				,"row"
			);
			
			$this->tplAssign("aListing", $aListing);
		}
		
		$this->tplAssign("aCategories", $oDirectory->getCategories());
		$this->tplAssign("sUseImage", $oDirectory->useImage);
		$this->tplDisplay("admin/edit.tpl");
	}
	function edit_s() {
		if(empty($_POST["name"]) || count($_POST["categories"]) == 0) {
			$_SESSION["admin"]["admin_directory"] = $_POST;
			$this->forward("/admin/directory/edit/".$_POST["id"]."/?error=".urlencode("Please fill in all required fields!"));
		}
		
		$this->dbQuery(
			"UPDATE `{dbPrefix}directory` SET"
				." `name` = ".$this->dbQuote($_POST["name"], "text")
				.", `address1` = ".$this->dbQuote($_POST["address1"], "text")
				.", `address2` = ".$this->dbQuote($_POST["address2"], "text")
				.", `city` = ".$this->dbQuote($_POST["city"], "text")
				.", `state` = ".$this->dbQuote($_POST["state"], "text")
				.", `zip` = ".$this->dbQuote($_POST["zip"], "text")
				.", `phone` = ".$this->dbQuote($_POST["phone"], "text")
				.", `fax` = ".$this->dbQuote($_POST["fax"], "text")
				.", `website` = ".$this->dbQuote($_POST["website"], "text")
				.", `email` = ".$this->dbQuote($_POST["email"], "text")
				.", `active` = ".$this->boolCheck($_POST["active"])
				.", `updated_datetime` = ".$this->dbQuote(time(), "integer")
				.", `updated_by` = ".$this->dbQuote($_SESSION["admin"]["userid"], "integer")
				." WHERE `id` = ".$this->dbQuote($_POST["id"], "integer")
		);
		
		$this->dbQuery(
			"DELETE FROM `{dbPrefix}directory_categories_assign`"
				." WHERE `listingid` = ".$this->dbQuote($_POST["id"], "integer")
		);
		foreach($_POST["categories"] as $sCategory) {
			$this->dbQuery(
				"INSERT INTO `{dbPrefix}directory_categories_assign`"
					." (`listingid`, `categoryid`)"
					." VALUES"
					." (".$this->dbQuote($_POST["id"], "integer").", ".$sCategory.")"
			);
		}
		
		$_SESSION["admin"]["admin_directory"] = null;
		
		$this->forward("/admin/directory/?notice=".urlencode("Changes saved successfully!"));
	}
	function delete() {
		$this->dbQuery(
			"DELETE FROM `{dbPrefix}directory`"
				." WHERE `id` = ".$this->dbQuote($this->_urlVars->dynamic["id"], "integer")
		);
		$this->dbQuery(
			"DELETE FROM `{dbPrefix}directory_categories_assign`"
				." WHERE `listingid` = ".$this->dbQuote($this->_urlVars->dynamic["id"], "integer")
		);
		
		$this->forward("/admin/directory/?notice=".urlencode("Listing removed successfully!"));
	}
	function categories_index() {
		$_SESSION["admin"]["admin_directory_categories"] = null;
		
		$aCategories = $this->dbQuery(
			"SELECT * FROM `{dbPrefix}directory_categories`"
				." ORDER BY `name`"
			,"all"
		);
		
		$this->tplAssign("aCategories", $aCategories);
		$this->tplDisplay("admin/categories.tpl");
	}
	function categories_add_s() {
		$this->dbQuery(
			"INSERT INTO `{dbPrefix}directory_categories`"
				." (`name`)"
				." VALUES"
				." ("
				.$this->dbQuote($_POST["name"], "text")
				.")"
			,"insert"
		);

		echo "/admin/directory/categories/?notice=".urlencode("Category added successfully!");
	}
	function categories_edit_s() {
		$this->dbQuery(
			"UPDATE `{dbPrefix}directory_categories` SET"
				." `name` = ".$this->dbQuote($_POST["name"], "text")
				." WHERE `id` = ".$this->dbQuote($_POST["id"], "integer")
		);

		echo "/admin/directory/categories/?notice=".urlencode("Changes saved successfully!");
	}
	function categories_delete() {
		$this->dbQuery(
			"DELETE FROM `{dbPrefix}directory_categories`"
				." WHERE `id` = ".$this->dbQuote($this->_urlVars->dynamic["id"], "integer")
		);
		$this->dbQuery(
			"DELETE FROM `{dbPrefix}directory_categories_assign`"
				." WHERE `categoryid` = ".$this->dbQuote($this->_urlVars->dynamic["id"], "integer")
		);

		$this->forward("/admin/directory/categories/?notice=".urlencode("Category removed successfully!"));
	}
}