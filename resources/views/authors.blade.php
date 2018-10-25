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
                <div class="card-header">Add Author</div>

                <div class="card-body">
                    <form method="post">
                        @csrf
                        <!-- @todo front-end validation (https://developer.mozilla.org/en-US/docs/Learn/HTML/Forms/Form_validation) -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Author Name">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <!-- @todo use "date" input type -->
                            <input name="birthday" type="text" class="form-control" id="birthday" placeholder="YYYY-MM-DD Format">
                        </div>
                        <div class="form-group">
                            <label for="biography">Biography</label>
                            <textarea name="biography"class="form-control" id="biography" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <hr />

            <!-- @todo when $authors is empty, consider removing this card or showing a friendly message -->
            <div class="card">
                <div class="card-header">Author List</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Book Count</th>
                                <th scope="col">Biography</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->birthday }}</td>
                                <td>{{ $author->books->count() }}</td>
                                <td>{{ $author->biography }}</td>
                                <td><a href="/authors/delete/{{ $author->id }}">Delete Author</a></td>
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
