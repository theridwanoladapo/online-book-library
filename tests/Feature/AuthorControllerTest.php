<?php

namespace Tests\Feature;

use App\Http\Resources\AuthorResource;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test test_can_create_an_author
     *
     * @return void
     */
    public function test_can_create_an_author()
    {
        $authorData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'biography' => 'A brief John Doe biography',
        ];

        $response = $this->postJson('/api/authors', $authorData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('authors', $authorData);
    }

    /**
     * Test test_can_retrieve_an_author
     *
     * @return void
     */
    public function test_can_retrieve_an_author()
    {
        $author = Author::factory()->create();

        $response = $this->getJson('/api/authors/' . $author->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $author->id,
            'name' => $author->name,
            'biography' => $author->biography,
        ]);
    }

    /**
     * Test test_can_update_an_author
     *
     * @return void
     */
    public function test_can_update_an_author()
    {
        $author = Author::factory()->create();
        $newName = 'Jane Doe';

        $response = $this->putJson('/api/authors/' . $author->id, ['name' => $newName]);

        $response->assertStatus(200);
        $this->assertEquals($newName, $author->fresh()->name);
    }

    /**
     * Test test_can_delete_an_author
     *
     * @return void
     */
    public function test_can_delete_an_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson('/api/authors/' . $author->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    /**
     * Test test_can_search_authors
     *
     * @return void
     */
    public function test_can_search_authors()
    {
        $author = Author::factory()->create(['name' => 'John Doe']);
        Book::factory()->create(['title' => 'Test Book', 'author_id' => $author->id]);

        $response = $this->getJson('/api/authors/search?query=John');

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'John Doe']);
    }
}
