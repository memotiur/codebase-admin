<div class="modal" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3 align-items-center"
                  action="{{route('farmers.store' )}}" method="POST"  enctype="multipart/form-data">

                @csrf
                @method("POST")

                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Farmer Create</h3>
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
                          <label class="" for="phone_number">phone_number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                   placeholder="phone_number" required="1">
                        </div><div class="col-12">
                          <label class="" for="password">password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password"
                                   placeholder="password" required="1">
                        </div><div class="col-12">
                            <label class="" for="address">address<span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="address" name="address"
                                   placeholder="address" required="1"></textarea>
                        </div> <label class="form-label" for="upazila">upazila<span class="text-danger">*</span> </label>
                            <select class="form-select" id="upazila" name="upazila" required="1">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                            </select> <label class="form-label" for="district">district<span class="text-danger">*</span> </label>
                            <select class="form-select" id="district" name="district" required="1">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                            </select> <label class="form-label" for="is_active">is_active<span class="text-danger">*</span> </label>
                            <select class="form-select" id="is_active" name="is_active" required="1">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

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

