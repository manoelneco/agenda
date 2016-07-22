<?php

namespace Alpha\Engine;

class Template{
	
	public $template;
	
	public function __construct($template){
		$this->template = $template;
	}
	
	public function inject($key, $valor){
		$this->template = str_replace($key, utf8_decode($valor), $this->template);
	}
	
	public function render(){
		return $this->template;
	}
	
}