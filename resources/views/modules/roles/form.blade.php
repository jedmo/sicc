<div class="form-group mb-25">
    <label for="name" class="color-dark fs-14 fw-500 align-center">Nombre <span
            class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        name="name" value="{{ $role->name }}" id="name" placeholder="Nombre">
    @if ($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="select-role" class="il-gray fs-14 fw-500 align-center mb-10">Permisos</label>
    <div class="row">
        @foreach ($permissions as $permission)
        <div class="col-md-3">
            <div class="mb-3">
                <div class="checkbox-theme-default custom-checkbox ">
                    <input class="checkbox" type="checkbox" id="check-{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $role_permissions) ? 'checked' : '' }}>
                    <label for="check-{{ $permission->name }}">
                        <span class="checkbox-text">
                            {{ $permission->name }}
                        </span>
                    </label>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
