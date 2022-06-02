@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    @push('header-scripts')
        @once
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        @endonce
    @endpush


    <h2 class="content-heading">New Post</h2>


    <div class="block block-rounded">


        <div class="block-content block-content-full">

            <div class="row">

                <form class="row"
                      action="{{ route('posts.update', $post ) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method("PUT")

                    <div class="col-md-8">
                        <div class=" mb-2">
                            <label class="form-label" for="example-select-floating">Post Title</label>
                            <input type="text" class="form-control" id="post_title" name="post_title"
                                   placeholder="Title" value="{{$post->post_title}}">
                        </div>


                        <div class="mb-2">
                            <label class="form-label" for="example-select-floating">Details</label>
                            <textarea type="text" class="form-control" id="summernote" name="post_details"
                                      placeholder="Details" rows="10">

                                {!! $post->post_details !!}
                            </textarea>

                        </div>

                    </div>

                    <div class="col-md-4">


                        <div class="mb-2">
                            <label class="" for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="example-select-floating">Category</label>
                            <select class="form-select" id="example-select-floating" name="category_id"
                                    aria-label="Floating label select example">
                                <option">Select an option</option>
                                @foreach($result as $item)
                                    <option value="{{$item->id}}"
                                            @if($post->category_id==$item->id) selected @endif>{{$item->category_title}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-2">
                            <button type="submit" class="form-control btn btn-primary" id="image" name="image">Publish
                            </button>
                        </div>


                    </div>


                </form>

            </div>
        </div>


    </div>





    @push('footer-scripts')
        @once
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                    crossorigin="anonymous"></script>

            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

            <script>
                $('#summernote').summernote({
                    placeholder: 'Hello stand alone ui',
                    height: 200,
                    /*tabsize: 2,
                    height: 120,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]*/
                });
            </script>
        @endonce
    @endpush

@endsection
