<?php
###############################################
$aConfig["encryption"]["key"] = ""; // example: sha1("domain.com")
$aConfig["encryption"]["salt"] = ""; // example: sha1("random string")
###############################################

### ADMIN INFO ################################
// Info used to send when an error happens when debug is off
$aConfig["admin_info"] = array(
	"name" => "",
	"email" => ""
);
###############################################

### OPTIONS ###################################
$aConfig["options"]["pear"] = "server"; //PEAR file locations; server = packages installed on server, folder = packages sit with site in .pear
$aConfig["options"]["debug"] = true;
###############################################

### SOFTWARE ##################################
$aConfig["software"]["firephp"] = true; // Set if you want to use/have FirePHP
###############################################

### PEAR ######################################
# PEAR MDB2
# http://pear.php.net/MDB2/
$aConfig["database"]["type"] = "mysql";
$aConfig["database"]["host"] = "localhost";
$aConfig["database"]["username"] = "";
$aConfig["database"]["password"] = "";
$aConfig["database"]["database"] = "";
$aConfig["database"]["fetch"] = 2; // 1 = Ordered (0=>value,1=>value), 2 = Assoc (col=>value,col=>val), 3 = Object {col->value,col->value}

$aConfig["database"]["dsn"] = $aConfig["database"]["type"]."://".$aConfig["database"]["username"].":".$aConfig["database"]["password"]."@".$aConfig["database"]["host"]."/".$aConfig["database"]["database"];
$aConfig["database"]["options"] = array(
	"quote_identifier" => true
);

# PEAR MAIL
# http://pear.php.net/mail/
$aConfig["mail"]["type"] = "mail"; // mail, sendmail, smtp
$aConfig["mail"]["params"] = array(); //mail
/*$aConfig["mail"]["params"] = array("sendmail_path" => "", "sendmail_args" => "") // sendmail */
/*$aConfig["mail"]["params"] = array(
	"host" => "",
	//"port" => "25",
	"auth" => true,
	"username" => "",
	"password" => ""
); //smtp */
###############################################

### TEMPLATES #################################
# PHP Smarty Template Engine
# http://smarty.php.net/
$aConfig["smarty"]["dir"]["smarty"] = $site_root.".smarty/Smarty.class.php";
$aConfig["smarty"]["dir"]["templates"] = $site_root."views";
$aConfig["smarty"]["dir"]["compile"] = $site_root.".compiled";
$aConfig["smarty"]["dir"]["cache"] = $site_root.".cache";
$aConfig["smarty"]["dir"]["plugins"] = array(
	$site_root."components",
	$site_root."components/html"
);

// Add plugin components
$oPlugins = dir($site_root."plugins");
while (false !== ($sPlugin = $oPlugins->read())) {
	if(substr($sPlugin, 0, 1) != "." && is_dir($site_root."plugins/".$sPlugin."/components/"))
		$aConfig["smarty"]["dir"]["plugins"][] = $site_root."plugins/".$sPlugin."/components/";
}
$oPlugins->close();

/* Caching */
$aConfig["smarty"]["cache"]["type"] = false;// false, 1 = 1 lifetime, 2 = lifetime per template;
$aConfig["smarty"]["cache"]["lifetime"] = 30;// -1 = never expire, 0 = always regenerate, seconds;

/* Filters */
$aConfig["smarty"]["filters"] = Array(
	//[0] = Type (pre,post,output), [1] = name of filter
	array("output", "move_to_head")
);

/* Settings */
$aConfig["smarty"]["subdirs"] = FALSE;//Potential Speed Boost on large sites while on
$aConfig["smarty"]["debug"] = FALSE;//Javascript popup of assigned variables
$aConfig["smarty"]["debug_ctrl"] = "URL";//NONE = No alt method, URL = "SMARTY_DEBUG" found in query string, ingnored when debug = true;
###############################################