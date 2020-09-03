<?php
interface Renderable
{
    public function render(): string;
}
class Form implements Renderable
{
    /**
     * @var Renderable[]
     */
    private array $elements;
    /**
     * runs through all elements and calls render() on them, then returns the complete representation
     * of the form.
     *
     * from the outside, one will not see this and the form will act like a single object instance
     */
    public function render(): string
    {
        $formCode = '<form>';
        foreach ($this->elements as $element) {
            $formCode .= $element->render();
        }
        $formCode .= '</form>';
        return $formCode;
    }

    public function addElement(Renderable $element)
    {
        $this->elements[] = $element;
    }
}
class InputElement implements Renderable
{
    public function render(): string
    {
        return '<input type="text" />';
    }
}
class TextElement implements Renderable
{
    private string $text;
    public function __construct(string $text)
    {
        $this->text = $text;
    }
    public function render(): string
    {
        return $this->text;
    }
}
$form = new Form();
$form->addElement(new TextElement('Email:'));
$form->addElement(new InputElement());
$embed = new Form();
$embed->addElement(new TextElement('Password:'));
$embed->addElement(new InputElement());
$form->addElement($embed);

// This is just an example, in a real world scenario it is important to remember that web browsers do not
// currently support nested forms
echo($form->render()); //'<form>Email:<input type="text" /><form>Password:<input type="text" /></form></form>'
