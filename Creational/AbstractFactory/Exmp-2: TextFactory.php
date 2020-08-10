<?php
// Abstract Factoy Class
abstract class TextFactory
{
    abstract public function createText(string $text) : Text;
}
 
// Different implementions of factory 
class JsonFactory extends TextFactory
{
    public function createText(string $text) : Text 
    {
        return new JsonText($text);
    }
}
 
class HtmlFactory extends TextFactory
{
    public function createText(string $text) : Text 
    {
        return new HtmlText($text);
    }
}

$factory = new HtmlFactory();
var_dump($factory->createText("<h2>This is sample html content</h2>"));
 
$factory = new JsonFactory();
var_dump($factory->createText("'name': 'Test','description': 'sample json content', 'version': '1.0.0'"));
echo "</pre>";
