<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Author;
use App\Book;

/**
 * @todo Consider splitting up into AuthorsController and BooksController
 * @todo Consider moving db operations into AuthorService and BookService
 */
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

    /**
     * @todo validate input with \App\Http\Requests\AddAuthorRequest
     */
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

    /**
     * @todo consider anotating the type of $author_id
     * @todo check if author exists, before attempting delete
     */
    public function deleteAuthor($author_id)
    {
        /**
         * @todo use \App\Author model for db operations
         */
        DB::table('authors')->where('id', $author_id)->delete();

        /**
         * @todo flash error message when model does not exist
         */
        session()->flash('status', 'Author Deleted!');
        return redirect('authors');
    }

    public function books()
    {
        $books = Book::all();

        return view('books', compact('books'));
    }

    /**
     * @todo validate input with \App\Http\Requests\AddBookRequest
     */
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

    /**
     * @todo consider anotating the type of $book_id
     * @todo chceck if book exists, before attempting delete
     */
    public function deleteBook($book_id)
    {
        /**
         * @todo use \App\Book model for db operations
         */
        DB::table('books')->where('id', $book_id)->delete();

        /**
         * @todo flash error message when model does not exist
         */
        session()->flash('status', 'Book Deleted!');
        return redirect('books');
    }
}
