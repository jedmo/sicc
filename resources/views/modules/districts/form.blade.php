<div class="form-group mb-25">
    <label for="code" class="color-dark fs-14 fw-500 align-center">Código de distrito<span class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="code"
        value="{{ $district->code }}" id="code" placeholder="código" required>
    @if($errors->has('code'))
    <p class="text-danger">{{ $errors->first('code') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="user_id" class="color-dark fs-14 fw-500 align-center">Pastor<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="user_id" id="user_id" required>
        <option value="">Seleccione</option>
        @foreach ( $users as $user )
        <option value="{{ $user['id'] }}" {{ $district->user_id == $user['id'] ? 'selected' : '' }}>
            {{ $user['name'] }}
        </option>
        @endforeach
    </select>
    @if ($errors->has('user_id'))
    <p class="text-danger">{{ $errors->first('user_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="status" class="color-dark fs-14 fw-500 align-center">Estado<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status" id="status" required>
        <option value="1" {{ $district->status==1 ? 'selected' : ''}}>
            Activo
        </option>
        <option value="0" {{ $district->status==0 ? 'selected' : ''}}>
            Inactivo
        </option>
    </select>
    @if ($errors->has('status'))
    <p class="text-danger">{{ $errors->first('status') }}</p>
    @endif
</div>
