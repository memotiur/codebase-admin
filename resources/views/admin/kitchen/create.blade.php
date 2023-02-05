<div class="modal" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3 align-items-center"
                  action="{{route('kitchens.store' )}}" method="POST"  enctype="multipart/form-data">

                @csrf
                @method("POST")

                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Kitchen Create</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm pb-3">

                        <div class="col-12">
                            <label class="" for="category_title">kitchen_name</label>
                            <input type="text" class="form-control" id="kitchen_name" name="kitchen_name"
                                   placeholder="kitchen_name">
                        </div><div class="col-12">
                            <label class="" for="category_title">address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="address">
                        </div> <label class="form-label" for="is_active">is_active</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option selected="">Select an option</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="2">Inactive</option>

                                                            </select>

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

