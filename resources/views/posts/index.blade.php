<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    </head>
    <body>
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <sapn>Posts</sapn>
                            <a href="{{ route('posts.create') }}" target="_self" class="btn btn-info">Create</a>
                            <button id="deleteAllSelected" class="btn btn-danger">Delete All Selected</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <td>
                                        <input type="checkbox" id="checkall">
                                    </td>
                                    <td>#ID</td>
                                    <td>Title</td>
                                    <td>Body</td>
                                    <td>Author</td>
                                    <td>Actions</td>
                                    <td>Downloads</td>
                                </thead>
                                <tbody>
                                    @forelse($posts as $post)
                                    <tr id="sid{{ $post->id }}">
                                        <td>
                                            <input type="checkbox" class="checkboxclass" name="ids" value="{{ $post->id }}">
                                        </td>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                            {{ substr(strip_tags($post->body), 0, 100) }}
                                            {{ strlen(strip_tags($post->body)) > 100 ? '...' : '' }}
                                        </td>
                                        <td>
                                            @unless($trash)
                                                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary" target="_self">
                                                        Edit
                                                    </a>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('posts.forceDelete', $post) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('posts.restore', $post) }}" class="btn btn-primary" target="_self">
                                                        Restore
                                                    </a>
                                                    <button type="submit" class="btn btn-danger">Force Delete</button>
                                                </form>
                                            @endunless
                                        </td>
                                        <td>
                                            <a href="/export_excel" class="btn btn-warning">Excel</a>
                                            <a href="/export_csv" class="btn btn-success">Csv</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">No Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            $(function(e){
                $('#checkall').click(function(){
                    $('.checkboxclass').prop('checked', $(this).prop('checked'));
                });

                $('#deleteAllSelected').click(function(e){
                    e.preventDefault();
                    var allids = [];
                    $("input:checkbox[name=ids]:checked").each(function(){
                        allids.push($(this).val());
                    });

                    $.ajax({
                        url: "{{url('deleteall')}}",
                        type: 'DELETE',
                        data: {
                            ids: allids,
                            _token: $("input[name=_token]").val(),
                        },
                        success: function(response){
                            $.each(allids, function(key, val){
                                $('#sid'+val).remove();
                            });
                        }
                    });
                });
            });
        </script>
        @if(Session::has('success'))
            <script>
                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-bottom-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr.success("{!!Session::get('success')!!}");
            </script>
            
        @endif

        
    </body>
</html>
