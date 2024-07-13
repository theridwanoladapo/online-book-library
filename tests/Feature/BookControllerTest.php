<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test test_can_create_a_book
     *
     * @return void
     */
    public function test_can_create_a_book()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];

        $response = $this->postJson('/api/books', $bookData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('books', $bookData);
    }

    /**
     * Test test_can_retrieve_a_book
     *
     * @return void
     */
    public function test_can_retrieve_a_book()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];
        $book = Book::create($bookData);

        $response = $this->getJson('/api/books/' . $book->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $book->id,
            'title' => $book->title,
            'description' => $book->description,
            'author' => [
                'id' => $author->id,
                'name' => $author->name,
                'biography' => $author->biography,
            ],
        ]);
    }

    /**
     * Test test_can_update_a_book
     *
     * @return void
     */
    public function test_can_update_a_book()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];
        $book = Book::create($bookData);

        $newTitle = 'Updated Title';
        $response = $this->putJson('/api/books/' . $book->id, ['title' => $newTitle]);

        $response->assertStatus(200);
        $this->assertEquals($newTitle, $book->fresh()->title);
    }

    /**
     * Test test_can_delete_a_book
     *
     * @return void
     */
    public function test_can_delete_a_book()
    {
        $author = Author::factory()->create();
        $bookData = [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'description' => 'Test Description',
        ];
        $book = Book::create($bookData);

        $response = $this->deleteJson('/api/books/' . $book->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * Test test_can_search_books
     *
     * @return void
     */
    public function test_can_search_books()
    {
        $author = Author::factory()->create(['name' => 'John Doe']);
        Book::factory()->create(['title' => 'Test Book', 'author_id' => $author->id]);

        $response = $this->getJson('/api/books/search?query=Test');

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => 'Test Book']);
    }
}
