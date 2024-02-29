{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SHOW</title>
</head>

<body>


    @foreach ($event->comments as $comment)
        <h1>{{ $comment->title }}</h1>
        <h1>{{ $comment->body }}</h1>
    @endforeach
</body>

</html> --}}



{{-- DETAIL EVENT --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>File show blade</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="{{ route('events.index') }}">CRUDComments</a>
            <div class="justify-end">
                <div class="col">
                    <a href="/events/{{ $event->id }}/comments/create" method="GET">
                        @csrf
                        <!-- Isi formulir komentar di sini -->
                        <button type="submit" class="btn btn-sm btn-success">Add Comment</button>
                    </a>

                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            @foreach ($event->comments as $comment)
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                {{ $comment->title }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $comment->body }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm">
                                    <a href="{{ route('events.editComment', $comment->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                </div>
                                <div class="col-sm">
                                    <form action="{{ route('events.destroyComment', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('   ')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
