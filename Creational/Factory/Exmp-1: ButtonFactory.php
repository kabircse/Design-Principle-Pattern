<?php
/*
*
*/
Abstract class Button {
	protected $html;
	function getHtml(){
		return $this->html;
	}
}

class ImageButton extends Button{
	protected $html = '<img src="">';
}
class InputButton extends Button{
	protected $html = '<input type="text">';
}

class ButtonFactory{//this class create another classes, so this is factory pattern
	public static function createButton($type){
		$baseClass = 'Button';
		$targetClass = ucfirst($type).$baseClass;
		if(class_exists($targetClass) && is_subclass_of($targetClass, $baseClass)){
			return new $targetClass;
		}
		else{
			throw new exception("Not found class '.$type.'");
		}
	}
}
$button = ButtonFactory::createButton('input');
echo $button->getHtml();
