<div class="modal" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3 align-items-center"
                  action="{{route('subscribers.store' )}}" method="POST"  enctype="multipart/form-data">

                @csrf
                @method("POST")

                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Subscriber Create</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm pb-3">

                        <div class="col-12">
                          <label class="" for="name">name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="name" required="1">
                        </div><div class="col-12">
                          <label class="" for="email">email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="email" required="1">
                        </div><div class="col-12">
                          <label class="" for="phone">phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="phone" required="1">
                        </div><div class="col-12">
                          <label class="" for="password">password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password"
                                   placeholder="password" required="1">
                        </div><div class="col-12">
                          <label class="" for="photo">photo<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="photo" name="photo"
                                   placeholder="photo" required="1">
                        </div><div class="col-12">
                          <label class="" for="unique_id">unique_id<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="unique_id" name="unique_id"
                                   placeholder="unique_id" required="1">
                        </div><div class="col-12">
                          <label class="" for="api_version">api_version<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="api_version" name="api_version"
                                   placeholder="api_version" required="1">
                        </div> <label class="form-label" for="is_verified">is_verified<span class="text-danger">*</span> </label>
                            <select class="form-select" id="is_verified" name="is_verified" required="1">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                            </select> <label class="form-label" for="is_active">is_active<span class="text-danger">*</span> </label>
                            <select class="form-select" id="is_active" name="is_active" required="1">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                            </select> <label class="form-label" for="is_google_login">is_google_login<span class="text-danger">*</span> </label>
                            <select class="form-select" id="is_google_login" name="is_google_login" required="1">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                            </select><div class="col-12">
                          <label class="" for="is_deleted">is_deleted<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="is_deleted" name="is_deleted"
                                   placeholder="is_deleted" required="1">
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

