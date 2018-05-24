<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Author;
use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function authors()
    {
        $authors = Author::all();

        return view('authors', compact('authors'));
    }
    public function addAuthor()
    {
        $author = new Author;
        $author->name = $_POST['name'];
        $author->birthday = $_POST['birthday'];
        $author->biography = $_POST['biography'];
        $author->save();

        session()->flash('status', 'Author Added!');
        return redirect('authors');
    }
    public function deleteAuthor($author_id)
    {
        DB::table('authors')->where('id', $author_id)->delete();

        session()->flash('status', 'Author Deleted!');
        return redirect('authors');
    }

    public function books()
    {
        $books = Book::all();

        return view('books', compact('books'));
    }
    public function addBook()
    {
        $book = new Book;
        $book->title = $_POST['title'];
        $book->author_id = $_POST['author_id'];
        $book->publication_date = $_POST['publication_date'];
        $book->description = $_POST['description'];
        $book->pages = $_POST['pages'];
        $book->save();

        session()->flash('status', 'Book Added!');
        return redirect('books');
    }
    public function deleteBook($book_id)
    {
        DB::table('books')->where('id', $book_id)->delete();

        session()->flash('status', 'Book Deleted!');
        return redirect('books');
    }
}
