<div class="modal" id="modalEdit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form class="row g-3 align-items-center"
                  action="{{route('kitchen-admins.update', $item )}}" method="POST" enctype="multipart/form-data">

                @csrf
                @method("PUT")

                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">KitchenAdmin Update</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm pb-3">

                        <div class="col-12">
                            <label class="" for="category_title">name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="name" value="{{$item->name}}">
                        </div>
                        <div class="col-12">
                            <label class="" for="category_title">email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="email" value="{{$item->email}}">
                        </div>
                        <div class="col-12">
                            <label class="" for="category_title">phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="phone" value="{{$item->phone}}">
                        </div>
                        <label class="form-label" for="admin_type">admin_type</label>
                        <select class="form-select" id="admin_type" name="admin_type">
                            <option selected="">Select an option</option>
                            <option value="1" @if($item->admin_type==1) selected @endif>Active</option>
                            <option value="0" @if($item->admin_type==0) selected @endif>Inactive</option>

                        </select> <label class="form-label" for="is_active">is_active</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option selected="">Select an option</option>
                            <option value="1" @if($item->is_active==1) selected @endif>Active</option>
                            <option value="0" @if($item->is_active==0) selected @endif>Inactive</option>

                        </select>
                        <div class="col-12">
                            <label class="" for="category_title">password</label>
                            <input type="text" class="form-control" id="password" name="password"
                                   placeholder="password" value="{{$item->password}}">
                        </div>
                        <label class="form-label" for="kitchen_id">Kitchen</label>
                        <select class="form-select" id="kitchen_id" name="kitchen_id">
                            <option selected="">Select an option</option>
                            @foreach($kitchens as $kitchen)
                                <option value="{{$kitchen->id}}">{{$kitchen->kitchen_name}}</option>
                            @endforeach

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

