<div class="form-group mb-25">
    <label for="name" class="color-dark fs-14 fw-500 align-center">Nombre <span
            class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        name="name" value="{{ $user->name }}" id="name" placeholder="Nombre">
    @if ($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="user" class="color-dark fs-14 fw-500 align-center">Usuario <span
            class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        name="user" value="{{ $user->user }}" id="user" placeholder="Usuario">
    @if ($errors->has('user'))
        <p class="text-danger">{{ $errors->first('user') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="password" class="color-dark fs-14 fw-500 align-center">Nueva Contraseña <span
            class="text-danger">*</span></label>
    <input type="password" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        name="password" id="password" value=""
        placeholder="Contraseña">
    @if ($errors->has('password'))
        <p class="text-danger">{{ $errors->first('password') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="select-role" class="il-gray fs-14 fw-500 align-center mb-10">Rol</label>
    <select name="role" id="select-role" class="form-control ">
        <option value="">Seleccione rol</option>
        @foreach ($roles as $role)
            <option value="{{ $role }}" {{ $role == key($user_role) ? 'selected' : '' }}>{{ $role }}</option>
        @endforeach
    </select>
</div>
<div class="form-group mb-25">
    <label for="email" class="color-dark fs-14 fw-500 align-center">Correo <span
            class="text-danger">*</span></label>
    <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        name="email" id="email" value="{{ $user->email }}"
        placeholder="Correo">
    @if ($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="phone" class="color-dark fs-14 fw-500 align-center">Teléfono <span
            class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        name="phone" value="{{ $user->phone }}" id="phone" placeholder="7000-0000">
    @if ($errors->has('phone'))
        <p class="text-danger">{{ $errors->first('phone') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="sex" class="color-dark fs-14 fw-500 align-center">Sexo <span
            class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="sex"
        id="sex">
        <option value="">Seleccione</option>
        <option value="masculino" {{ $user->sex == 'masculino' ? 'selected' : '' }}>Masculino</option>
        <option value="femenino" {{ $user->sex == 'femenino' ? 'selected' : '' }}>Femenino</option>
    </select>
    @if ($errors->has('sex'))
        <p class="text-danger">{{ $errors->first('sex') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="gender" class="color-dark fs-14 fw-500 align-center">Estado<span
        class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status" id="status">
        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactivo</option>
    </select>
    @if ($errors->has('status'))
        <p class="text-danger">{{ $errors->first('status') }}</p>
    @endif
</div>
