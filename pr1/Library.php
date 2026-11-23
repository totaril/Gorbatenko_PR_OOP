<?php
declare(strict_types=1);

class Library
{
    private array $books = [];

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function findByAuthor(string $author): array
    {
        return array_values(array_filter(
            $this->books,
            fn (Book $b): bool => mb_strtolower($b->author) === mb_strtolower($author)
        ));
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function printAll(): void
    {
        foreach ($this->books as $i => $book) {
            echo ($i + 1) . '. ' . $book->getInfo()
                . ' (возраст: ' . $book->getAge() . ' г.)' . PHP_EOL;
        }
    }

    public function getOldest(): ?Book
    {
        if ($this->books === []) {
            return null;
        }

        $oldest = $this->books[0];
        foreach ($this->books as $book) {
            if ($book->year < $oldest->year) {
                $oldest = $book;
            }
        }
        return $oldest;
    }
}