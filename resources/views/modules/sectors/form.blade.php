<div class="form-group mb-25">
    <label for="code" class="color-dark fs-14 fw-500 align-center">Código de sector <span class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="code"
        value="{{ $sector->code }}" id="code" placeholder="código" required>
    @if($errors->has('code'))
    <p class="text-danger">{{ $errors->first('code') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="user_id" class="color-dark fs-14 fw-500 align-center">Supervisor<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="user_id" id="user_id" required>
        <option value="">Seleccione</option>
        @foreach ( $users as $user )
        <option value="{{ $user['id'] }}" {{ $sector->user_id == $user['id'] ? 'selected' : '' }}>
            {{ $user['name'] }}
        </option>
        @endforeach
    </select>
    @if ($errors->has('user_id'))
    <p class="text-danger">{{ $errors->first('user_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="zone_id" class="color-dark fs-14 fw-500 align-center">Zona<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="zone_id" id="zone_id" required>
        <option value="">Seleccione</option>
        @foreach ( $zones as $zone )
        <option value="{{ $zone['id'] }}" {{ $sector->zone_id == $zone['id'] ? 'selected' : '' }}>
            {{ $zone['full_code'] }}
        </option>
        @endforeach
    </select>
    @if ($errors->has('zone_id'))
    <p class="text-danger">{{ $errors->first('zone_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="status" class="color-dark fs-14 fw-500 align-center">Estado<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status" id="status" required>
        <option value="1" {{ $sector->status==1 ? 'selected' : ''}}>
            Activo
        </option>
        <option value="0" {{ $sector->status==0 ? 'selected' : ''}}>
            Inactivo
        </option>
    </select>
    @if ($errors->has('status'))
    <p class="text-danger">{{ $errors->first('status') }}</p>
    @endif
</div>
