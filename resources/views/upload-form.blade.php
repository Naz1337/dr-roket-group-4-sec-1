<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Form</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <form action="{{ route('drafts.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="draft_file" class="form-label">Draft File </label>
                <input type="file" class="form-control" id="draft_file" name="draft_file">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
