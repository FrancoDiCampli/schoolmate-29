<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body>
        {{-- <form action="{{ url('video') }}" method="post" enctype="multipart/form-data">
            <p><input type="text" name="title" placeholder="Enter Video Title" /></p>
            <p><textarea name="description" cols="30" rows="10" placeholder="Video description"></textarea></p>
            <p><input type="file" name="video" /></p>
            <button type="submit" class="btn btn-default">Submit</button>
            {{ csrf_field() }}
        </form> --}}
    </body>
</html>
