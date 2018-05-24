@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Add Book</div>

                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder="Book Title">
                        </div>
                        <div class="form-group">
                            <label for="author_id">Author</label>
                            <select name="author_id" class="form-control" id="author_id">
                                @foreach (\App\Author::all() as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="publication_date">Publication Date</label>
                            <input name="publication_date" type="text" class="form-control" id="publication_date" placeholder="YYYY-MM-DD Format">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description"class="form-control" id="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pages">Page Count</label>
                            <input name="pages" type="text" class="form-control" id="pages" placeholder="Enter a number only">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <hr />

            <div class="card">
                <div class="card-header">Book List</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publication Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Page Count</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->name }}</td>
                                <td>{{ $book->publication_date }}</td>
                                <td>{{ $book->description }}</td>
                                <td>{{ $book->pages }}</td>
                                <td><a href="/books/delete/{{ $book->id }}">Delete Book</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('.table').DataTable();
});
</script>

@endsection
