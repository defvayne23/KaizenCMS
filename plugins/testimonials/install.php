<?php
$aDatabases = array(
	"testimonials" => array(
		"fields" => array(
			"id" => array(
				"type" => "integer",
				"unsigned" => 1,
				"notnull" => 1,
				"default" => 0,
				"auto_increment"
			),
			"name" => array("type" => "text","length" => 100),
			"text" => array("type" => "clob"),
			"active" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"created_datetime" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"created_by" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"updated_datetime" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0),
			"updated_by" => array("type" => "integer","unsigned" => 1,"notnull" => 1,"default" => 0)
		),
		"index" => array("active")
	),
	"testimonials_categories" => array(
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
	"testimonials_categories_assign" => array(
		"fields" => array(
			"testimonialid" => array(
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
		"index" => array("testimonialid", "categoryid")
	)
);

$aSettings = array(
	array(
		"group" => "Testimonials",
		"tag" => "testimonial_tag1",
		"title" => "Tag 1",
		"text" => "Test 1",
		"value" => "Value 1",
		"type" => "text",
		"order" => 1
	)
	,array(
		"group" => "Testimonials",
		"tag" => "testimonial_tag2",
		"title" => "Tag 2",
		"text" => "Test 2",
		"value" => "Value 2",
		"type" => "text",
		"order" => 2
	)
	,array(
		"group" => "Testimonials",
		"tag" => "testimonial_tag3",
		"title" => "Tag 3",
		"text" => "Test 3",
		"value" => "Value 3",
		"type" => "text",
		"order" => 3
	)
);

$aMenuAdmin = array(
	"title" => "Testimonials",
	"menu" => array(
		array(
			"text" => "Add Testimonial",
			"link" => "/admin/testimonials/add/",
			"icon" => "circle-plus"
		),
		array(
			"text" => "Manage Testimonials",
			"link" => "/admin/testimonials/"
		),
		array(
			"text" => "Add Category",
			"link" => "/admin/testimonials/categories/?addcategory=1",
			"icon" => "circle-plus"
		),
		array(
			"text" => "Manage Categories",
			"link" => "/admin/testimonials/categories/"
		)
	)
);