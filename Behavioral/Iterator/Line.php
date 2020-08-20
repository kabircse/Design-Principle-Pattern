<?php
class Line
{
    private $id;
    private $name;
    private $surname; 
    public function __construct(int $id, string $name, string $surname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
    } 
    public function getId(): int
    {
        return $this->id;
    } 
    public function getName(): string
    {
        return $this->name;
    } 
    public function getSurname(): string
    {
        return $this->surname;
    } 
    public function __toString(): string
    {
        return sprintf('%d, %s, %s', $this->id, $this->name, $this->surname);
    }
}

class LineCollection implements \Countable, \IteratorAggregate
{
    private $lines; 
    public function getLines(): ?array
    {
        return $this->lines;
    } 
    public function addLine(Line $line): self
    {
        $this->lines[] = $line;
 
        return $this;
    } 
    public function removeLine(Line $line)
    {
        foreach ($this->lines as $key => $value) {
            if ($value === $line) {
                unset($this->lines[$key]); 
                break;
            }
        }
    } 
    public function count(): int
    {
        return count($this->lines);
    } 
    public function getIterator(): LineIterator
    {
        return new LineIterator($this);
    } 
    public function getReverseIterator(): LineIterator
    {
        return new LineIterator($this, true);
    }
}
class LineIterator implements \Iterator
{
    private $lineCollection;
    private $position;
    private $reverse; 
    public function __construct(LineCollection $lineCollection, bool $reverse = false)
    {
        $this->lineCollection = $lineCollection;
        $this->reverse = $reverse;
    } 
    public function current(): ?Line
    {
        return $this->lineCollection->getLines()
            ? $this->lineCollection->getLines()[$this->position]
            : null;
    } 
    public function next(): void
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    } 
    public function key(): int
    {
        return is_null($this->position) ? 0 : $this->position;
    } 
    public function valid(): bool
    {
        return $this->lineCollection->getLines() && isset($this->lineCollection->getLines()[$this->position]);
    } 
    public function rewind(): void
    {
        $this->position = $this->reverse ? $this->lineCollection->count() - 1 : 0;
    }
}

// Assume that this is a CSV file
$csvFile[0]['id'] = 1;
$csvFile[0]['name'] = 'John';
$csvFile[0]['surname'] = 'Travolta';
$csvFile[1]['id'] = 2;
$csvFile[1]['name'] = 'Robert';
$csvFile[1]['surname'] = 'De Niro';
 
// Populate collection
$lineCollection = new LineCollection();
foreach ($csvFile as $row) {
    $line = new Line($row['id'], $row['name'], $row['surname']);
 
    $lineCollection->addLine($line);
}
 
print_r($lineCollection);
echo PHP_EOL; 
// Iterate in normal order
foreach ($lineCollection->getIterator() as $line) {
    echo $line->__toString().PHP_EOL;
}
 
echo PHP_EOL; 
// Iterate in reverse order
foreach ($lineCollection->getReverseIterator() as $line) {
    echo $line->__toString().PHP_EOL;
 
    $lineCollection->removeLine($line); // Clear for demonstration purposes
}
 
echo PHP_EOL;
print_r($lineCollection);
