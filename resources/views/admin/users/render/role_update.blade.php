<form action="{{ url('admin/users/role_manage_operation') }}" class="database_operation_form" data-pop="#update_role_popup">
        <div class="row">
          <?php 
          echo csrf_field();
          $permission = get_permission();
          $set_permission=json_decode(json_encode(json_decode($role->permission)),true);
          ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter Role Name</label>
              <input type="hidden" name="action" value="update" />
              <input type="hidden" name="id" value="{{ $role->id }}" />
              <input type="text" required="required" value="{{ $role->title }}" class="form-control" name="role_name" placeholder="Enter Role Name" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Select Permission</label>
            </div>
          </div>
          @foreach($permission as $per)
          <div class="col-sm-4">
            <div class="icheck-primary">
              <input <?php if(isset($set_permission[$per['key']])) { echo "checked"; } ?> type="checkbox" name="{{ $per['key'] }}" id="{{ $per['key'] }}" class="mr-4" value="1" />
               <label for="{{ $per['key'] }}">{{ $per['title'] }}</label>
            </div>
          </div>
          @endforeach
          <div class="col-sm-12">
            <div class="form-group">
              <button class="btn rounded-0 bg-success text-white form_btn">Update</button>
            </div>
          </div>
        </div>
      </div>
      </form>