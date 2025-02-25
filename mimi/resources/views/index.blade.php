<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD - Books</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>All Books</h1>

        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createBookModal">
            Create New Book
        </button>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>
                        <!-- Button to trigger Edit Modal with dynamic data -->
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBookModal"
                            data-id="{{ $book->id }}" 
                            data-title="{{ $book->title }}" 
                            data-author="{{ $book->author }}" 
                            data-year="{{ $book->year }}">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="/destroy/{{ $book->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for Creating a Book -->
    <div class="modal fade" id="createBookModal" tabindex="-1" role="dialog" aria-labelledby="createBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBookModalLabel">Create Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/store" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" name="author" id="author" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="text" name="year" id="year" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing a Book -->
    <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit-title">Title:</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-author">Author:</label>
                            <input type="text" name="author" id="edit-author" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-year">Year:</label>
                            <input type="text" name="year" id="edit-year" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to dynamically fill the modal with book data
        $('#editBookModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var bookId = button.data('id');
            var title = button.data('title');
            var author = button.data('author');
            var year = button.data('year');

            var modal = $(this);
            modal.find('#edit-title').val(title);
            modal.find('#edit-author').val(author);
            modal.find('#edit-year').val(year);
            modal.find('form').attr('action', '/update/' + bookId); // Set form action URL dynamically
        });
    </script>
</body>
</html>
