<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

use App\Author;
use App\User;

class CrudAuthorsTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $author;

    public function setUp() {
        parent::setUp();        
        $this->user = factory(User::class)->create();
        $this->author = factory(Author::class)->create();
    }

    public function testCreate()
    {
        $res = $this->actingAs($this->user)
            ->post('/authors', [
                'name' => 'Octavio Paz Lozano',
                'birthday' => '1914-03-31',
                'biography' => 'Octavio Paz was introduced to literature early in his life through the influence of his grandfather\'s library, filled with classic Mexican and European literature. (source: Wikipedia)',
            ]);
            
        $row = DB::table('authors')->where('name', 'Octavio Paz Lozano')->get();

        // must save data
        $this->assertCount(1, $row);

        // must redirect to the authors list
        $res->assertRedirect('/authors');

        // must give user feedback
        $res->assertSessionHas('status', 'Author Added!');
    }

    public function testDelete()
    {
        $res = $this->actingAs($this->user)
            ->get("/authors/delete/{$this->author->id}");

        // must redirect to authors list
        $res->assertRedirect('/authors');

        // must give user feedback
        $res->assertSessionHas('status', 'Author Deleted!');
    }

    public function testRead()
    {
        $res = $this->actingAs($this->user)
            ->get("/authors/{$this->author->id}");

        // must be ok
        $res->assertStatus(200);

        // must show the author details
        $res->assertSeeText($author->name);
        $res->assertSeeText($author->birthday);
        $res->assertSeeText($author->biography);
    }

    public function testUpdate()
    {
        $author = factory(Author::class)->create();
        $res = $this->actingAs($this->user)
            ->post("/authors/update/{$this->author->id}", [
                'name' => 'Octavio Paz Lozano',
            ]);

        // must redirect to the "read" route
        $res->assertRedirect("/authors/{$this->author->id}");

        // must update the details
        $updated_author = DB::table('authors')->where('id', $this->author->id)->get()->first();

        $this->assertEquals('Octavio Paz Lozano', $updated_author->name);
    }
}
