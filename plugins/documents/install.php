<?php
$aDatabases = array(
	"documents" => array(
		"fields" => array(
			"id" => array(
				"type" => "integer",
				"unsigned" => 1,
				"notnull" => 1,
				"default" => 0,
				"auto_increment"
			),
			"name" => array("type" => "text","length" => 100),
			"description" => array("type" => "clob"),
			"document" => array("type" => "text","length" => 100),
			"active" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"created_datetime" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"created_by" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"updated_datetime" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"updated_by" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0)
		),
		"index" => array("active")
	),
	"documents_categories" => array(
		"fields" => array(
			"id" => array(
				"type" => "integer",
				"unsigned" => 1,
				"notnull" => 1,
				"default" => 0,
				"auto_increment"
			),
			"name" => array("type" => "text","length" => 100)
		)
	),
	"documents_categories_assign" => array(
		"fields" => array(
			"documentid" => array(
				"type" => "integer",
				"unsigned" => 1,
				"notnull" => 1,
				"default" => 0
			),
			"categoryid" => array(
				"type" => "integer",
				"unsigned" => 1,
				"notnull" => 1,
				"default" => 0
			)
		),
		"index" => array("documentid", "categoryid")
	)
);

$aSettings = array();

$aMenuAdmin = array(
	"title" => "Documents",
	"menu" => array(
		array(
			"text" => "Add Document",
			"link" => "/admin/documents/add/",
			"icon" => "circle-plus"
		),
		array(
			"text" => "Manage Documents",
			"link" => "/admin/documents/"
		),
		array(
			"text" => "Add Category",
			"link" => "/admin/documents/categories/?addcategory=1",
			"icon" => "circle-plus"
		),
		array(
			"text" => "Manage Categories",
			"link" => "/admin/documents/categories/"
		)
	)
);