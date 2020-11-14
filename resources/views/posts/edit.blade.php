<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://cdn.tiny.cloud/1/2yfff28v9ihc4onxsqisenio8a6xvdxu5ts68men4iey85ix/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-6">
                    <form method="post" action="{{ route('posts.update', $post) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" name="title" value="{{ isset($post->title) ? $post->title : old('title') }}" placeholder="Title" class="form-control">

                            @error('title')
                                <span style="color: red">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <input type="text" name="user_id" value="{{ isset($post->user_id) ? $post->user_id : old('user_id') }}" placeholder="User" class="form-control">
                            @error('user_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3">{{ isset($post->body) ? $post->body : old('body') }}</textarea>

                            @error('body')
                                <span style="color: red">{{ $message }}</span>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            tinymce.init({
              selector: 'textarea',
              plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
              toolbar_mode: 'floating',
            });
        </script>
    </body>
</html>
