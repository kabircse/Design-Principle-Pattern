<?php
interface Text
{
    public function render(string $extrinsicState): string;
}
class Word implements Text
{
    private string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function render(string $font): string
    {
        return sprintf('Word %s with font %s', $this->name, $font);
    }
}
class Character implements Text
{
    /**
     * Any state stored by the concrete flyweight must be independent of its context.
     * For flyweights representing characters, this is usually the corresponding character code.
     */
    private string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function render(string $font): string
    {
         // Clients supply the context-dependent information that the flyweight needs to draw itself
         // For flyweights representing characters, extrinsic state usually contains e.g. the font.
        return sprintf('Character %s with font %s', $this->name, $font);
    }
}
class TextFactory implements Countable
{
    /**
     * @var Text[]
     */
    private array $charPool = [];
    public function get(string $name): Text
    {
        if (!isset($this->charPool[$name])) {
            $this->charPool[$name] = $this->create($name);
        }
        return $this->charPool[$name];
    }
    private function create(string $name): Text
    {
        if (strlen($name) == 1) {
            return new Character($name);
        } else {
            return new Word($name);
        }
    }
    public function count(): int
    {
        return count($this->charPool);
    }
}

private array $characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
private array $fonts = ['Arial', 'Times New Roman', 'Verdana', 'Helvetica'];
$factory = new TextFactory();
for ($i = 0; $i <= 10; $i++) {
    foreach ($this->characters as $char) {
        foreach ($this->fonts as $font) {
            $flyweight = $factory->get($char);
            $rendered = $flyweight->render($font);
            // Output of the booth line should be same;
            echo(sprintf('Character %s with font %s', $char, $font));
            echo $rendered;
        }
    }
}

foreach ($this->fonts as $word) {
    $flyweight = $factory->get($word);
    $rendered = $flyweight->render('foobar');
    // Output of the booth line should be same;
    echo(sprintf('Word %s with font foobar', $word));
    echo $rendered;
}

// Flyweight pattern ensures that instances are shared
// instead of having hundreds of thousands of individual objects
// there must be one instance for every char that has been reused for displaying in different fonts
// Output of the booth line should be same;
echo (count($this->characters) + count($this->fonts));
echo $factory
