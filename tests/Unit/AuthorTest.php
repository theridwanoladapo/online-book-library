<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test test_author_can_be_created
     *
     * @return void
     */
    public function test_author_can_be_created()
    {
        $authorData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'biography' => 'A brief John Doe biography',
        ];

        $author = Author::create($authorData);

        $this->assertDatabaseHas('authors', $authorData);
    }

    /**
     * Test test_author_can_be_retrieved
     *
     * @return void
     */
    public function test_author_can_be_retrieved()
    {
        $author = Author::factory()->create();

        $retrievedAuthor = Author::find($author->id);

        $this->assertNotNull($retrievedAuthor);
        $this->assertEquals($author->name, $retrievedAuthor->name);
    }

    /**
     * Test test_author_can_be_updated
     *
     * @return void
     */
    public function test_author_can_be_updated()
    {
        $author = Author::factory()->create();
        $newName = 'Jane Doe';

        $author->update(['name' => $newName]);

        $this->assertEquals($newName, $author->fresh()->name);
    }

    /**
     * Test test_author_can_be_deleted
     *
     * @return void
     */
    public function test_author_can_be_deleted()
    {
        $author = Author::factory()->create();
        $author_id = $author->id;

        $author->delete();

        $this->assertDatabaseMissing('authors', ['id' => $author_id]);
    }
}
