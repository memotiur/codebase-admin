<div class="modal" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3 align-items-center"
                  action="{{ route('users.store' ) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method("POST")

                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">User Create</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm pb-3">

                        <div class="col-12">
                            <label class="" for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Name">
                        </div>
                        <div class="col-12">
                            <label class="" for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Email">
                        </div>

                        <div class="col-12">
                            <label class="" for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                   placeholder="Password">
                        </div>


                        <div class="col-12">
                            <label class="" for="user_type">Admin Type</label>

                            <select class="form-select" name="user_type" id="user_type">
                                <option value="1">Admin</option>
                                <option value="2">Operator</option>

                            </select>

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

