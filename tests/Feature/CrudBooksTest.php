<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class CrudBooksTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp() {
        parent::setUp();        
        $this->user = factory(User::class)->create();
    }

    public function testCreate()
    {
        $book_model = factory(Book::class)->make();
        $res = $this->actingAs($this->user)
            ->post('/books', $book_model);
 
        // must save data
        $this->assertDatabaseHas('books', $book_model);

        // must redirect to the books list
        $res->assertRedirect('/books');

        // must give user feedback
        $res->assertSessionHas('status', 'Book Added!');
    }

    public function testDelete()
    {
        $book = factory(Book::class)->create();
        $res = $this->actingAs($this->user)
            ->get("/books/delete/{$book->id}");

        // must redirect to books list
        $res->assertRedirect('/books');

        // must give user feedback
        $res->assertSessionHas('status', 'Book Deleted!');
    }

    public function testRead()
    {
        $book = factory(Book::class)->create();
        $res = $this->actingAs($this->user)
            ->get("/books/{$book->id}");

        // must be ok
        $res->assertStatus(200);

        // must show the book details
        $res->assertSeeText($book->title);
        $res->assertSeeText($book->publication_date);
        $res->assertSeeText($book->description);
        $res->assertSeeText($book->pages);
    }

    public function testUpdate()
    {
        $book = factory(Book::class)->create();
        /** @todo test updating of each individual attribute, not just the title */
        $res = $this->actingAs($this->user)
            ->post("/books/update/{$book->id}", [
                'title' => 'One Hundred Years of Solitude',
            ]);

        // must redirect to the "read" route
        $res->assertRedirect("/books/{$book->id}");

        // must update the details
        $updated_book = DB::table('books')->where('id', $book->id)->get()->first();

        $this->assertEquals('One Hundred Years of Solitude', $updated_book->title);
    }
}
