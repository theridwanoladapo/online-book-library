<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test test_book_can_be_created
     *
     * @return void
     */
    public function test_book_can_be_created()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];

        $book = Book::create($bookData);

        $this->assertDatabaseHas('books', $bookData);
    }

    /**
     * Test test_book_can_be_retrieved
     *
     * @return void
     */
    public function test_book_can_be_retrieved()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];
        $book = Book::create($bookData);

        $retrievedBook = Book::find($book->id);

        $this->assertNotNull($retrievedBook);
        $this->assertEquals($book->title, $retrievedBook->title);
    }

    /**
     * Test test_book_can_be_updated
     *
     * @return void
     */
    public function test_book_can_be_updated()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];
        $book = Book::create($bookData);

        $newTitle = 'Updated Title';

        $book->update(['title' => $newTitle]);

        $this->assertEquals($newTitle, $book->fresh()->title);
    }

    /**
     * Test test_book_can_be_deleted
     *
     * @return void
     */
    public function test_book_can_be_deleted()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];
        $book = Book::create($bookData);
        $book_id = $book->id;

        $book->delete();

        $this->assertDatabaseMissing('books', ['id' => $book_id]);
    }
}
