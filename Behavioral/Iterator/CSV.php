<?php
/**
 * CSV File Iterator.
 *
 * @author Josh Lockhart
 */
class CsvIterator implements \Iterator
{
    const ROW_SIZE = 4096;
    /**
     * The pointer to the CSV file.
     *
     * @var resource
     */
    protected $filePointer = null;

    /**
     * The current element, which is returned on each iteration.
     *
     * @var array
     */
    protected $currentElement = null;

    /**
     * The row counter.
     *
     * @var int
     */
    protected $rowCounter = null;

    /**
     * The delimiter for the CSV file.
     *
     * @var string
     */
    protected $delimiter = null;

    /**
     * The constructor tries to open the CSV file. It throws an exception on
     * failure.
     *
     * @param string $file The CSV file.
     * @param string $delimiter The delimiter.
     *
     * @throws \Exception
     */
    public function __construct($file, $delimiter = ',')
    {
        try {
            $this->filePointer = fopen($file, 'rb');
            $this->delimiter = $delimiter;
        } catch (\Exception $e) {
            throw new \Exception('The file "' . $file . '" cannot be read.');
        }
    }

    /**
     * This method resets the file pointer.
     */
    public function rewind(): void
    {
        $this->rowCounter = 0;
        rewind($this->filePointer);
    }

    /**
     * This method returns the current CSV row as a 2-dimensional array.
     *
     * @return array The current CSV row as a 2-dimensional array.
     */
    public function current(): array
    {
        $this->currentElement = fgetcsv($this->filePointer, self::ROW_SIZE, $this->delimiter);
        $this->rowCounter++;

        return $this->currentElement;
    }

    /**
     * This method returns the current row number.
     *
     * @return int The current row number.
     */
    public function key(): int
    {
        return $this->rowCounter;
    }

    /**
     * This method checks if the end of file has been reached.
     *
     * @return bool Returns true on EOF reached, false otherwise.
     */
    public function next(): bool
    {
        if (is_resource($this->filePointer)) {
            return !feof($this->filePointer);
        }

        return false;
    }

    /**
     * This method checks if the next row is a valid row.
     *
     * @return bool If the next row is a valid row.
     */
    public function valid(): bool
    {
        if (!$this->next()) {
            if (is_resource($this->filePointer)) {
                fclose($this->filePointer);
            }

            return false;
        }

        return true;
    }
}

/**
 * The client code.
 */
$csv = new CsvIterator(__DIR__ . '/cats.csv');

foreach ($csv as $key => $row) {
    print_r($row);
}


/*
Output:
Array
(
    [0] => Name
    [1] => Age
    [2] => Owner
    [3] => Breed
    [4] => Image
    [5] => Color
    [6] => Texture
    [7] => Fur
    [8] => Size
)
Array
(
    [0] => Steve
    [1] => 3
    [2] => Alexander Shvets
    [3] => Bengal
    [4] => /cats/bengal.jpg
    [5] => Brown
    [6] => Stripes
    [7] => Short
    [8] => Medium
)
Array
(
    [0] => Siri
    [1] => 2
    [2] => Alexander Shvets
    [3] => Domestic short-haired
    [4] => /cats/domestic-sh.jpg
    [5] => Black
    [6] => Solid
    [7] => Medium
    [8] => Medium
)
Array
(
    [0] => Fluffy
    [1] => 5
    [2] => John Smith
    [3] => Maine Coon
    [4] => /cats/Maine-Coon.jpg
    [5] => Gray
    [6] => Stripes
    [7] => Long
    [8] => Large
)
*/
