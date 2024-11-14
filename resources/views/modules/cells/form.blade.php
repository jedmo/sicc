<div class="form-group mb-25">
    <label for="code" class="color-dark fs-14 fw-500 align-center">Código <span class="text-danger">*</span></label>
    <input type="hidden" name="sector_id" id="sector_id" value="{{ $cell->sector_id }}">
    <input type="hidden" name="sector_code" id="sector_code" value="{{ $cell->sector->full_code }}">
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="code"
        value="{{ $cell->code }}" id="code" placeholder="código" {{ $show ? 'disabled' : '' }} required>
    @if($errors->has('code'))
    <p class="text-danger">{{ $errors->first('code') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="leader_id" class="color-dark fs-14 fw-500 align-center">Líder</label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="leader_id" id="leader_id" {{ $show ? 'disabled' : '' }}>
        <option value="">Seleccione</option>
        @foreach ( $members as $member )
        <option value="{{ $member['id'] }}" {{ $cell->leader_id == $member['id'] ? 'selected' : '' }}>
            {{ $member['full_name'] }}
        </option>
        @endforeach
    </select>
    @if ($errors->has('leader_id'))
    <p class="text-danger">{{ $errors->first('leader_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="temp_leader" class="color-dark fs-14 fw-500 align-center">Líder temporal</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="temp_leader"
        value="{{ $cell->temp_leader }}" id="temp_leader" placeholder="Nombre del líder temporal" {{ $show ? 'disabled' : '' }}>
    @if($errors->has('temp_leader'))
    <p class="text-danger">{{ $errors->first('temp_leader') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="type" class="color-dark fs-14 fw-500 align-center">Tipo<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="type" id="type" {{ $show ? 'disabled' : '' }} required>
        <option value="">Seleccione</option>
        <option value="Adultos" {{ $cell->type == 'Adultos' ? 'selected' : '' }}>Adultos</option>
        <option value="Jóvenes" {{ $cell->type == 'Jóvenes' ? 'selected' : '' }}>Jóvenes</option>
        <option value="Niños" {{ $cell->type == 'Niños' ? 'selected' : '' }}>Niños</option>
    </select>
    @if ($errors->has('type'))
    <p class="text-danger">{{ $errors->first('type') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="host_id" class="color-dark fs-14 fw-500 align-center">Anfitrion/a</label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="host_id" id="host_id" {{ $show ? 'disabled' : '' }}>
        <option value="">Seleccione</option>
        @foreach ( $members as $member )
        <option value="{{ $member['id'] }}" {{ $cell->host_id == $member['id'] ? 'selected' : '' }}>
            {{ $member['full_name'] }}
        </option>
        @endforeach
    </select>
    @if($errors->has('host_id'))
    <p class="text-danger">{{ $errors->first('host_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="assistant_id" class="color-dark fs-14 fw-500 align-center">Asistente</label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="assistant_id" id="assistant_id" {{ $show ? 'disabled' : '' }}>
        <option value="">Seleccione</option>
        @foreach ( $members as $member )
        <option value="{{ $member['id'] }}" {{ $cell->assistant_id == $member['id'] ? 'selected' : '' }}>
            {{ $member['full_name'] }}
        </option>
        @endforeach
    </select>
    @if($errors->has('assistant_id'))
    <p class="text-danger">{{ $errors->first('assistant_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="address" class="color-dark fs-14 fw-500 align-center">Residencial / Colonia / Barrio</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="address"
        value="{{ $cell->address->address }}" id="address" placeholder="residencial / colonia / barrio" {{ $show ? 'disabled' : '' }}>
    @if($errors->has('address'))
    <p class="text-danger">{{ $errors->first('address') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="street" class="color-dark fs-14 fw-500 align-center">Pasaje / Calle / Avenida / Otros</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="street"
        value="{{ $cell->address->street }}" id="street" placeholder="pasaje / calle / avenida / otros" {{ $show ? 'disabled' : '' }}>
    @if($errors->has('street'))
    <p class="text-danger">{{ $errors->first('street') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="house_num" class="color-dark fs-14 fw-500 align-center">Num. Casa / Apartamento</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="house_num"
        value="{{ $cell->address->house_num }}" id="house_num" placeholder="num. casa / apartamento" {{ $show ? 'disabled' : '' }}>
    @if($errors->has('house_num'))
    <p class="text-danger">{{ $errors->first('house_num') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="canton" class="color-dark fs-14 fw-500 align-center">Cantón</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="canton"
        value="{{ $cell->address->canton }}" id="address" placeholder="cantón" {{ $show ? 'disabled' : '' }}>
    @if($errors->has('canton'))
    <p class="text-danger">{{ $errors->first('canton') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="hamlet" class="color-dark fs-14 fw-500 align-center">Caserío</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="hamlet"
        value="{{ $cell->address->hamlet }}" id="hamlet" placeholder="caserío" {{ $show ? 'disabled' : '' }}>
    @if($errors->has('hamlet'))
    <p class="text-danger">{{ $errors->first('hamlet') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="select-municipality" class="color-dark fs-14 fw-500 align-center">Distrito municipal<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="municipal_district_id" id="select-municipality" {{ $show ? 'disabled' : '' }} required>
        <option value="">Seleccione</option>
        @foreach ($municipalities as $municipality)
            <option value="{{ $municipality['id'] }}" {{ $cell->address->municipal_district_id == $municipality['id'] ? 'selected' : '' }}>{{ $municipality['name'] }}</option>
        @endforeach
    </select>
    @if ($errors->has('municipal_district_id'))
    <p class="text-danger">{{ $errors->first('municipal_district_id') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="status" class="color-dark fs-14 fw-500 align-center">Estado<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status" id="status"  {{ $show ? 'disabled' : '' }} required>
        <option value="1" {{ $cell->status==1 ? 'selected' : ''}}>
            Activo
        </option>
        <option value="0" {{ $cell->status==0 ? 'selected' : ''}}>
            Inactivo
        </option>
    </select>
    @if ($errors->has('status'))
    <p class="text-danger">{{ $errors->first('status') }}</p>
    @endif
</div>
