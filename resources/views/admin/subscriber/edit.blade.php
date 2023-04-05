<div class="modal" id="modalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3 align-items-center"
                  action="{{route('subscribers.update', $item )}}"  method="POST" enctype="multipart/form-data">

                @csrf
                @method("PUT")

                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Subscriber Update</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm pb-3">

                        <div class="col-12">
                            <label class="" for="category_title">name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="name" value="{{$item->name}}" required="1">
                        </div><div class="col-12">
                            <label class="" for="category_title">email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="email" value="{{$item->email}}" required="1">
                        </div><div class="col-12">
                            <label class="" for="category_title">phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="phone" value="{{$item->phone}}" required="1">
                        </div><div class="col-12">
                            <label class="" for="category_title">password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password"
                                   placeholder="password" value="{{$item->password}}" required="1">
                        </div><div class="col-12">
                            <label class="" for="category_title">photo<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="photo" name="photo"
                                   placeholder="photo" value="{{$item->photo}}" required="1">
                        </div><div class="col-12">
                            <label class="" for="category_title">unique_id<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="unique_id" name="unique_id"
                                   placeholder="unique_id" value="{{$item->unique_id}}" required="1">
                        </div><div class="col-12">
                            <label class="" for="category_title">api_version<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="api_version" name="api_version"
                                   placeholder="api_version" value="{{$item->api_version}}" required="1">
                        </div> <label class="form-label" for="is_verified">is_verified<span class="text-danger">*</span></label>
                            <select class="form-select" id="is_verified" name="is_verified" required="1">
                                <option selected="">Select an option</option>
                                                                    <option value="1" @if($item->is_verified==1) selected  @endif>Active</option>
                                                                    <option value="0"  @if($item->is_verified==0) selected  @endif>Inactive</option>

                                                            </select> <label class="form-label" for="is_active">is_active<span class="text-danger">*</span></label>
                            <select class="form-select" id="is_active" name="is_active" required="1">
                                <option selected="">Select an option</option>
                                                                    <option value="1" @if($item->is_active==1) selected  @endif>Active</option>
                                                                    <option value="0"  @if($item->is_active==0) selected  @endif>Inactive</option>

                                                            </select> <label class="form-label" for="is_google_login">is_google_login<span class="text-danger">*</span></label>
                            <select class="form-select" id="is_google_login" name="is_google_login" required="1">
                                <option selected="">Select an option</option>
                                                                    <option value="1" @if($item->is_google_login==1) selected  @endif>Active</option>
                                                                    <option value="0"  @if($item->is_google_login==0) selected  @endif>Inactive</option>

                                                            </select><div class="col-12">
                            <label class="" for="category_title">is_deleted<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="is_deleted" name="is_deleted"
                                   placeholder="is_deleted" value="{{$item->is_deleted}}" required="1">
                        </div>

                        <div class="col-12">
                            <label class="" for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm text-end border-top">
                        <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-alt-primary" data-bs-dismiss="modal">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

