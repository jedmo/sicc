<div class="row">
    @role('Líder')
    <div class="d-flex justify-content-between mb-20">
        <h4>CÉLULA {{ $cells->full_code }}</h4>
        <input type="hidden" name="cell_id" value="{{ $cells->id }}" />
    @else
    <div class="col-md-6 mb-25">
        <label for="cell_id" class="color-dark fs-14 fw-500 align-center">Célula<span class="text-danger">*</span></label>
        <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="cell_id" id="cell_id" required>
            <option value="">Seleccione</option>
            @foreach ( $cells as $cell )
            <option value="{{ $cell['id'] }}" {{ $member->cell ? ($member->cell->cell_id == $cell['id'] ? 'selected' : '') : '' }}>
                {{ $cell['full_code'] }}
            </option>
            @endforeach
        </select>
        @if ($errors->has('cell_id'))
        <p class="text-danger">{{ $errors->first('cell_id') }}</p>
        @endif
    @endrole
</div>
<div class="col-md-6 mb-25">
    <label for="first_name" class="color-dark fs-14 fw-500 align-center">Primer nombre <span class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="first_name"
        value="{{ $member->first_name }}" id="first_name" placeholder="primer nombre" required>
    @if($errors->has('first_name'))
    <p class="text-danger">{{ $errors->first('first_name') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="second_name" class="color-dark fs-14 fw-500 align-center">Segundo nombre </label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="second_name"
        value="{{ $member->second_name }}" id="second_name" placeholder="segundo nombre">
    @if($errors->has('second_name'))
    <p class="text-danger">{{ $errors->first('second_name') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="third_name" class="color-dark fs-14 fw-500 align-center">Tercer nombre </label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="third_name"
        value="{{ $member->third_name }}" id="third_name" placeholder="tercer nombre">
    @if($errors->has('third_name'))
    <p class="text-danger">{{ $errors->first('third_name') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="first_surname" class="color-dark fs-14 fw-500 align-center">Primer apellido <span class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="first_surname"
        value="{{ $member->first_surname }}" id="first_surname" placeholder="primer apellido" required>
    @if($errors->has('first_surname'))
    <p class="text-danger">{{ $errors->first('first_surname') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="second_surname" class="color-dark fs-14 fw-500 align-center">Segundo apellido </label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="second_surname"
        value="{{ $member->second_surname }}" id="second_surname" placeholder="segundo apellido">
    @if($errors->has('second_surname'))
    <p class="text-danger">{{ $errors->first('second_surname') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="third_surname" class="color-dark fs-14 fw-500 align-center">Apellido de casada </label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="third_surname"
        value="{{ $member->third_surname }}" id="third_surname" placeholder="apellido de casada">
    @if($errors->has('third_surname'))
    <p class="text-danger">{{ $errors->first('third_surname') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="sex" class="color-dark fs-14 fw-500 align-center">Sexo </label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="sex" id="sex">
        <option value="">Seleccione</option>
        <option value="masculino" {{ $member->sex == 'masculino' ? 'selected' : '' }}>Masculino</option>
        <option value="femenino" {{ $member->sex == 'femenino' ? 'selected' : '' }}>Femenino</option>
    </select>
    @if ($errors->has('sex'))
        <p class="text-danger">{{ $errors->first('sex') }}</p>
    @endif
</div>
<div class="form-group-calender col-md-6 mb-25">
    <div class="with-icon">
        <label for="birth_date" class="color-dark fs-14 fw-500 align-center">Fecha de nacimiento</label>
        <div class="position-relative">
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15 input-date" name="birth_date" id="birth_date"
            value="{{ $member->birth_date ? date('d/m/Y', strtotime($member->birth_date)) : '' }}" placeholder="dd/mm/aaaa">
            <a href="#"><img class="svg" src="{{ asset('assets/img/svg/calendar.svg') }}" alt="calendar"></a>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between mb-20">
    <h4>Domicilio</h4>
</div>
<div class="col-md-6 mb-25">
    <label for="address" class="color-dark fs-14 fw-500 align-center">Residencial / Colonia / Barrio</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="address"
        value="{{ $member->address->address }}" id="address" placeholder="residencial / colonia / barrio">
    @if($errors->has('address'))
    <p class="text-danger">{{ $errors->first('address') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="street" class="color-dark fs-14 fw-500 align-center">Pasaje / Calle / Avenida / Otros</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="street"
        value="{{ $member->address->street }}" id="street" placeholder="pasaje / calle / avenida / otros">
    @if($errors->has('street'))
    <p class="text-danger">{{ $errors->first('street') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="house_num" class="color-dark fs-14 fw-500 align-center">Num. Casa / Apartamento</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="house_num"
        value="{{ $member->address->house_num }}" id="house_num" placeholder="num. casa / apartamento">
    @if($errors->has('house_num'))
    <p class="text-danger">{{ $errors->first('house_num') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="canton" class="color-dark fs-14 fw-500 align-center">Cantón</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="canton"
        value="{{ $member->address->canton }}" id="address" placeholder="cantón">
    @if($errors->has('canton'))
    <p class="text-danger">{{ $errors->first('canton') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="hamlet" class="color-dark fs-14 fw-500 align-center">Caserío</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="hamlet"
        value="{{ $member->address->hamlet }}" id="hamlet" placeholder="caserío">
    @if($errors->has('hamlet'))
    <p class="text-danger">{{ $errors->first('hamlet') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="select-municipality" class="color-dark fs-14 fw-500 align-center">Distrito municipal<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="municipal_district_id" id="select-municipality" required>
        <option value="">Seleccione</option>
        @foreach ($municipalities as $municipality)
            <option value="{{ $municipality['id'] }}" {{ $member->address->municipal_district_id == $municipality['id'] ? 'selected' : '' }}>{{ $municipality['name'] }}</option>
        @endforeach
    </select>
    @if ($errors->has('municipal_district_id'))
    <p class="text-danger">{{ $errors->first('municipal_district_id') }}</p>
    @endif
</div>

<div class="d-flex justify-content-between mb-20">
    <h4>Teléfonos</h4>
</div>
<div class="col-md-6 mb-25">
    <label for="cellphone" class="color-dark fs-14 fw-500 align-center">Célular</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="cellphone"
        value="{{ $member->cellphone }}" id="cellphone" placeholder="célular">
    @if($errors->has('cellphone'))
    <p class="text-danger">{{ $errors->first('cellphone') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="phone" class="color-dark fs-14 fw-500 align-center">Teléfono (casa ó trabajo)</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="phone"
        value="{{ $member->phone }}" id="phone" placeholder="teléfono">
    @if($errors->has('phone'))
    <p class="text-danger">{{ $errors->first('phone') }}</p>
    @endif
</div>

<div class="d-flex justify-content-between mb-20">
    <h4>Identificación</h4>
</div>
<div class="col-md-6 mb-25">
    <label for="dui" class="color-dark fs-14 fw-500 align-center">DUI</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="dui"
        value="{{ $member->dui }}" id="dui" placeholder="dui">
    @if($errors->has('dui'))
    <p class="text-danger">{{ $errors->first('dui') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="nit" class="color-dark fs-14 fw-500 align-center">NIT</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="nit"
        value="{{ $member->nit }}" id="nit" placeholder="nit">
    @if($errors->has('nit'))
    <p class="text-danger">{{ $errors->first('nit') }}</p>
    @endif
</div>

<div class="d-flex justify-content-between mb-20">
    <h4>Otros datos</h4>
</div>
<div class="col-md-6 mb-25">
    <label for="marital_status" class="color-dark fs-14 fw-500 align-center">Estado civil</label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="marital_status" id="marital_status">
        <option value="1" {{ $member->marital_status == 1 ? 'selected' : '' }}>Soltero/a</option>
        <option value="2" {{ $member->marital_status == 2 ? 'selected' : '' }}>Casado/a</option>
        <option value="3" {{ $member->marital_status == 3 ? 'selected' : '' }}>Divorsiado/a</option>
        <option value="4" {{ $member->marital_status == 4 ? 'selected' : '' }}>Acompañado/a</option>
        <option value="5" {{ $member->marital_status == 5 ? 'selected' : '' }}>Viudo/a</option>
    </select>
    @if ($errors->has('marital_status'))
    <p class="text-danger">{{ $errors->first('marital_status') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="marital_status" class="color-dark fs-14 fw-500 align-center">Tipo de sangre</label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="marital_status" id="marital_status">
        <option value="">Seleccione</option>
        <option value="1" {{ $member->blood_type == 1 ? 'selected' : '' }}>ARH+</option>
        <option value="2" {{ $member->blood_type == 2 ? 'selected' : '' }}>ARH-</option>
        <option value="3" {{ $member->blood_type == 3 ? 'selected' : '' }}>BRH+</option>
        <option value="4" {{ $member->blood_type == 4 ? 'selected' : '' }}>BRH-</option>
        <option value="5" {{ $member->blood_type == 5 ? 'selected' : '' }}>ABRH+</option>
        <option value="6" {{ $member->blood_type == 6 ? 'selected' : '' }}>ABRH-</option>
        <option value="7" {{ $member->blood_type == 7 ? 'selected' : '' }}>ORH+</option>
        <option value="8" {{ $member->blood_type == 8 ? 'selected' : '' }}>ORH-</option>
    </select>
    @if ($errors->has('marital_status'))
    <p class="text-danger">{{ $errors->first('marital_status') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="occupation" class="color-dark fs-14 fw-500 align-center">Profesión u Oficio</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="occupation"
        value="{{ $member->occupation }}" id="occupation" placeholder="profesión u oficio">
    @if($errors->has('occupation'))
    <p class="text-danger">{{ $errors->first('occupation') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <label for="email" class="color-dark fs-14 fw-500 align-center">Correo electrónico</label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15" name="email"
        value="{{ $member->email }}" id="email" placeholder="correo electrónico">
    @if($errors->has('email'))
    <p class="text-danger">{{ $errors->first('email') }}</p>
    @endif
</div>
<div class="form-group-calender col-md-6 mb-25">
    <div class="with-icon">
        <label for="conversion_date" class="color-dark fs-14 fw-500 align-center">Fecha de conversión</label>
        <div class="position-relative">
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15 input-date" name="conversion_date" id="conversion_date"
            value="{{ $member->conversion_date ? date('d/m/Y', strtotime($member->conversion_date)) :  '' }}" placeholder="dd/mm/aaaa">
            <a href="#"><img class="svg" src="{{ asset('assets/img/svg/calendar.svg') }}" alt="calendar"></a>
        </div>
    </div>
</div>
<div class="col-md-6 mb-25">
    <label for="gender" class="color-dark fs-14 fw-500 align-center">Estado<span
        class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status" id="status">
        <option value="1" {{ $member->status == 1 ? 'selected' : '' }}>Activo</option>
        <option value="0" {{ $member->status == 0 ? 'selected' : '' }}>Inactivo</option>
    </select>
    @if ($errors->has('status'))
        <p class="text-danger">{{ $errors->first('status') }}</p>
    @endif
</div>
<div class="col-md-6 mb-25">
    <div class="form-element">
        <div class="custom-file">
            <input class="form-control custom-file-input" type="file" id="photo" name="photo">
            <label class="custom-file-label ps-15" for="photo">Foto</label>
        </div>
    </div>
</div>
</div>
