<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            Merge PDF Files in Laravel
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
    <body>
        <main class="py-5">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        <h2 class="fs-5 py-4 text-center">
                            Merge PDF Files in Laravel
                        </h2>
                        <div class="card border rounded shadow">
                            <div class="card-body">
                                <form method="POST" action="{{ route('merge-pdf') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="files" class="form-label">Files</label>
                                        <input type="file" name="files[]" id="files" class="form-control" multiple>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Merge</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>