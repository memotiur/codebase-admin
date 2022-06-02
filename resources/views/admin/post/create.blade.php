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
                      action="{{ route('posts.store' ) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method("POST")

                    <div class="col-md-8">
                        <div class=" mb-2">
                            <label class="form-label" for="example-select-floating">Post Title</label>
                            <input type="text" class="form-control" id="post_title" name="post_title"
                                   placeholder="Title">
                        </div>


                        <div class="mb-2">
                            <label class="form-label" for="example-select-floating">Details</label>
                            <textarea type="text" class="form-control" id="summernote" name="post_details"
                                      placeholder="Details" rows="10"></textarea>

                        </div>

                    </div>

                    <div class="col-md-4">


                        <div class="mb-2">
                            <label class="" for="uploadedImage">Image</label>
                            <input type="file" class="form-control" id="uploadedImage" name="image">
                        </div>

                        <div class="mb-2">
                            <img src="/images/preview.jpg" id="imagePreview" class="w-100 img-thumbnail" style="max-height: 275px;"/>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" for="example-select-floating">Category</label>
                            <select class="form-select" id="example-select-floating" name="category_id"
                                    aria-label="Floating label select example">
                                <option selected="">Select an option</option>
                                @foreach($result as $item)
                                    <option value="{{$item->id}}">{{$item->category_title}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-4">
                            <label class="form-label">Featured Post</label>
                            <div class="space-x-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="pin_post" value="1">
                                    <label class="form-check-label" for="is_featured">Yes</label>
                                </div>

                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Tags</label>
                            <textarea type="text" class="form-control" name="tags"
                                      placeholder="Tags" rows="3"></textarea>
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
                    placeholder: 'Post Details',
                    height: 250,
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


                uploadedImage.onchange = evt => {
                    const [file] = uploadedImage.files
                    if (file) {
                        imagePreview.src = URL.createObjectURL(file)
                    }
                }


            </script>
        @endonce
    @endpush

@endsection
