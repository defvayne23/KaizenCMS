<?php
class testimonials extends appController {
	function __construct() {
		// Load model when creating appController
		parent::__construct("testimonials");
	}
	
	function index() {
		$aTestimonials = $this->model->getTestimonials($_GET["category"]);
		
		$this->tplAssign("aTestimonials", $aTestimonials);
		$this->tplAssign("aCategories", $this->model->getCategories(false));
		$this->tplDisplay("testimonials.tpl");
	}
	function testimonial() {
		$aTestimonial = $this->model->getTestimonial(null, $this->urlVars->dynamic["tag"]);
		
		if(empty($aTestimonial))
			$this->error('404');
		
		$this->tplAssign("aTestimonial", $aTestimonial);
		
		if($this->tplExists("testimonial-".$aTestimonial["id"].".tpl"))
			$this->tplDisplay("testimonial-".$aTestimonial["id"].".tpl");
		else
			$this->tplDisplay("testimonial.tpl");
	}
}