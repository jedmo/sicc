
<div class="form-group mb-25">
    <label>Título</label>
    <input type="text" name="name" value="{{ $event->name }}" class="form-control form-control-md" required>
</div>
<div class="form-group mb-25">
    <label>Tipo</label>
    <div class="radio-horizontal-list d-flex flex-wrap">
        <div class="radio-theme-default custom-radio ">
            <input class="radio" type="radio" name="type" value="zona" id="radio-3" {{ $role == 'Pastor de Zona' ? 'checked' : '' }}>
            <label for="radio-3">
                <span class="radio-text">Zona</span>
            </label>
        </div>
        <div class="radio-theme-default custom-radio ">
            <input class="radio" type="radio" name="type" value="distrito" id="radio-2" {{ $role == 'Pastor de Zona' ? 'disabled' : '' }}>
            <label for="radio-2">
                <span class="radio-text">Distrito</span>
            </label>
        </div>
        <div class="radio-theme-default custom-radio ">
            <input class="radio" type="radio" name="type" value="general" id="radio-1" {{ $role == 'Pastor de Zona' ? 'disabled' : '' }}>
            <label for="radio-1">
                <span class="radio-text">General</span>
            </label>
        </div>
    </div>
</div>
<div class="form-group mb-25">
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="zone_id" id="zone_id" required>
        @if ($role == 'Pastor de Zona')
            @foreach ($zones as $zone)
                @if ($zone['user_id'] == $user_id)
                    <option value="{{ $zone['id'] }}">Zona - {{ $zone['full_code'] }}</option>
                @endif
            @endforeach
        @else
            @foreach ($districts as $district)
                <option value="{{ $district['id'] }}">Distrito - {{ $district['full_code'] }} - Todas las zonas</option>
            @endforeach
            @foreach ($zones as $zone)
                <option value="{{ $zone['id'] }}">Zona - {{ $zone['full_code'] }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="form-group mb-25">
    <label>Estado</label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="status" id="status" required>
        <option value="1" {{ $event->status == 1 ? 'selected' : ''}}>
            Activo
        </option>
        <option value="0" {{ $event->status == 0? 'selected' : ''}}>
            Inactivo
        </option>
    </select>
</div>
<div class="form-group mb-25">
    <div class="e-form-row__left">
        <label>Fecha y hora inicio</label>
    </div>
    <div class="e-form-row__right d-flex">
        <div class="input-container icon-left position-relative col-6 me-2">
            <input type="text" class="form-control form-control-md input-date" name="start_date"
            value="{{ $event->start_date ? date('d/m/Y', strtotime($event->start_date)) : date('d/m/Y') }}" required>
        </div>
        <div class="input-container icon-left position-relative col-6">
            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="start_time" id="start_time">
                <option value="07:00 AM" {{ $event->start_time == '07:00:00' ? 'selected' : ''}}>07:00 AM</option>
                <option value="07:30 AM" {{ $event->start_time == '07:30:00' ? 'selected' : ''}}>07:30 AM</option>
                <option value="08:00 AM" {{ $event->start_time == '08:00:00' ? 'selected' : ''}}>08:00 AM</option>
                <option value="08:30 AM" {{ $event->start_time == '08:30:00' ? 'selected' : ''}}>08:30 AM</option>
                <option value="09:00 AM" {{ $event->start_time == '09:00:00' ? 'selected' : ''}}>09:00 AM</option>
                <option value="09:30 AM" {{ $event->start_time == '09:30:00' ? 'selected' : ''}}>09:30 AM</option>
                <option value="10:00 AM" {{ $event->start_time == '10:00:00' ? 'selected' : ''}}>10:00 AM</option>
                <option value="10:30 AM" {{ $event->start_time == '10:30:00' ? 'selected' : ''}}>10:30 AM</option>
                <option value="11:00 AM" {{ $event->start_time == '11:00:00' ? 'selected' : ''}}>11:00 AM</option>
                <option value="11:30 AM" {{ $event->start_time == '11:30:00' ? 'selected' : ''}}>11:30 AM</option>
                <option value="12:00 PM" {{ $event->start_time == '12:00:00' ? 'selected' : ''}}>12:00 PM</option>
                <option value="12:30 PM" {{ $event->start_time == '12:30:00' ? 'selected' : ''}}>12:30 PM</option>
                <option value="01:00 PM" {{ $event->start_time == '13:00:00' ? 'selected' : ''}}>01:00 PM</option>
                <option value="01:30 PM" {{ $event->start_time == '13:30:00' ? 'selected' : ''}}>01:30 PM</option>
                <option value="02:00 PM" {{ $event->start_time == '14:00:00' ? 'selected' : ''}}>02:00 PM</option>
                <option value="02:30 PM" {{ $event->start_time == '14:30:00' ? 'selected' : ''}}>02:30 PM</option>
                <option value="03:00 PM" {{ $event->start_time == '15:00:00' ? 'selected' : ''}}>03:00 PM</option>
                <option value="03:30 PM" {{ $event->start_time == '15:30:00' ? 'selected' : ''}}>03:30 PM</option>
                <option value="04:00 PM" {{ $event->start_time == '16:00:00' ? 'selected' : ''}}>04:00 PM</option>
                <option value="04:30 PM" {{ $event->start_time == '16:30:00' ? 'selected' : ''}}>04:30 PM</option>
                <option value="05:00 PM" {{ $event->start_time == '17:00:00' ? 'selected' : ''}}>05:00 PM</option>
                <option value="05:30 PM" {{ $event->start_time == '17:30:00' ? 'selected' : ''}}>05:30 PM</option>
                <option value="06:00 PM" {{ $event->start_time == '18:00:00' ? 'selected' : ''}}>06:00 PM</option>
                <option value="06:30 PM" {{ $event->start_time == '18:30:00' ? 'selected' : ''}}>06:30 PM</option>
                <option value="07:00 PM" {{ $event->start_time == '19:00:00' ? 'selected' : ''}}>07:00 PM</option>
                <option value="07:30 PM" {{ $event->start_time == '19:30:00' ? 'selected' : ''}}>07:30 PM</option>
                <option value="08:00 PM" {{ $event->start_time == '20:00:00' ? 'selected' : ''}}>08:00 PM</option>
                <option value="08:30 PM" {{ $event->start_time == '20:30:00' ? 'selected' : ''}}>08:30 PM</option>
                <option value="09:00 PM" {{ $event->start_time == '21:00:00' ? 'selected' : ''}}>09:00 PM</option>
                <option value="09:30 PM" {{ $event->start_time == '21:30:00' ? 'selected' : ''}}>09:30 PM</option>
                <option value="10:00 PM" {{ $event->start_time == '22:00:00' ? 'selected' : ''}}>10:00 PM</option>
                <option value="10:30 PM" {{ $event->start_time == '22:30:00' ? 'selected' : ''}}>10:30 PM</option>
                <option value="11:00 PM" {{ $event->start_time == '23:00:00' ? 'selected' : ''}}>11:00 PM</option>
                <option value="11:30 PM" {{ $event->start_time == '23:30:00' ? 'selected' : ''}}>11:30 PM</option>
                <option value="12:00 AM" {{ $event->start_time == '24:00:00' ? 'selected' : ''}}>12:00 AM</option>
                <option value="12:30 AM" {{ $event->start_time == '24:30:00' ? 'selected' : ''}}>12:30 AM</option>
                <option value="01:00 AM" {{ $event->start_time == '01:00:00' ? 'selected' : ''}}>01:00 AM</option>
                <option value="01:30 AM" {{ $event->start_time == '01:30:00' ? 'selected' : ''}}>01:30 AM</option>
                <option value="02:00 AM" {{ $event->start_time == '02:00:00' ? 'selected' : ''}}>02:00 AM</option>
                <option value="02:30 AM" {{ $event->start_time == '02:30:00' ? 'selected' : ''}}>02:30 AM</option>
                <option value="03:00 AM" {{ $event->start_time == '03:00:00' ? 'selected' : ''}}>03:00 AM</option>
                <option value="03:30 AM" {{ $event->start_time == '03:30:00' ? 'selected' : ''}}>03:30 AM</option>
                <option value="04:00 AM" {{ $event->start_time == '04:00:00' ? 'selected' : ''}}>04:00 AM</option>
                <option value="04:30 AM" {{ $event->start_time == '04:30:00' ? 'selected' : ''}}>04:30 AM</option>
                <option value="05:00 AM" {{ $event->start_time == '05:00:00' ? 'selected' : ''}}>05:00 AM</option>
                <option value="05:30 AM" {{ $event->start_time == '05:30:00' ? 'selected' : ''}}>05:30 AM</option>
                <option value="06:00 AM" {{ $event->start_time == '06:00:00' ? 'selected' : ''}}>06:00 AM</option>
                <option value="06:30 AM" {{ $event->start_time == '06:30:00' ? 'selected' : ''}}>06:30 AM</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group mb-25">
    <div class="e-form-row__left">
        <label>Fecha y hora fin</label>
    </div>
    <div class="e-form-row__right d-flex">
        <div class="input-container icon-left position-relative col-6 me-2">
            <input type="text" class="form-control form-control-md input-date" name="end_date"
            value="{{ $event->end_date ? date('d/m/Y', strtotime($event->end_date)) : date('d/m/Y') }}" required>
        </div>
        <div class="input-container icon-left position-relative col-6">
            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="end_time" id="end_time">
                <option value="07:00 AM" {{ $event->end_time == '07:00:00' ? 'selected' : ''}}>07:00 AM</option>
                <option value="07:30 AM" {{ $event->end_time == '07:30:00' ? 'selected' : ''}}>07:30 AM</option>
                <option value="08:00 AM" {{ $event->end_time == '08:00:00' ? 'selected' : ''}}>08:00 AM</option>
                <option value="08:30 AM" {{ $event->end_time == '08:30:00' ? 'selected' : ''}}>08:30 AM</option>
                <option value="09:00 AM" {{ $event->end_time == '09:00:00' ? 'selected' : ''}}>09:00 AM</option>
                <option value="09:30 AM" {{ $event->end_time == '09:30:00' ? 'selected' : ''}}>09:30 AM</option>
                <option value="10:00 AM" {{ $event->end_time == '10:00:00' ? 'selected' : ''}}>10:00 AM</option>
                <option value="10:30 AM" {{ $event->end_time == '10:30:00' ? 'selected' : ''}}>10:30 AM</option>
                <option value="11:00 AM" {{ $event->end_time == '11:00:00' ? 'selected' : ''}}>11:00 AM</option>
                <option value="11:30 AM" {{ $event->end_time == '11:30:00' ? 'selected' : ''}}>11:30 AM</option>
                <option value="12:00 PM" {{ $event->end_time == '12:00:00' ? 'selected' : ''}}>12:00 PM</option>
                <option value="12:30 PM" {{ $event->end_time == '12:30:00' ? 'selected' : ''}}>12:30 PM</option>
                <option value="01:00 PM" {{ $event->end_time == '13:00:00' ? 'selected' : ''}}>01:00 PM</option>
                <option value="01:30 PM" {{ $event->end_time == '13:30:00' ? 'selected' : ''}}>01:30 PM</option>
                <option value="02:00 PM" {{ $event->end_time == '14:00:00' ? 'selected' : ''}}>02:00 PM</option>
                <option value="02:30 PM" {{ $event->end_time == '14:30:00' ? 'selected' : ''}}>02:30 PM</option>
                <option value="03:00 PM" {{ $event->end_time == '15:00:00' ? 'selected' : ''}}>03:00 PM</option>
                <option value="03:30 PM" {{ $event->end_time == '15:30:00' ? 'selected' : ''}}>03:30 PM</option>
                <option value="04:00 PM" {{ $event->end_time == '16:00:00' ? 'selected' : ''}}>04:00 PM</option>
                <option value="04:30 PM" {{ $event->end_time == '16:30:00' ? 'selected' : ''}}>04:30 PM</option>
                <option value="05:00 PM" {{ $event->end_time == '17:00:00' ? 'selected' : ''}}>05:00 PM</option>
                <option value="05:30 PM" {{ $event->end_time == '17:30:00' ? 'selected' : ''}}>05:30 PM</option>
                <option value="06:00 PM" {{ $event->end_time == '18:00:00' ? 'selected' : ''}}>06:00 PM</option>
                <option value="06:30 PM" {{ $event->end_time == '18:30:00' ? 'selected' : ''}}>06:30 PM</option>
                <option value="07:00 PM" {{ $event->end_time == '19:00:00' ? 'selected' : ''}}>07:00 PM</option>
                <option value="07:30 PM" {{ $event->end_time == '19:30:00' ? 'selected' : ''}}>07:30 PM</option>
                <option value="08:00 PM" {{ $event->end_time == '20:00:00' ? 'selected' : ''}}>08:00 PM</option>
                <option value="08:30 PM" {{ $event->end_time == '20:30:00' ? 'selected' : ''}}>08:30 PM</option>
                <option value="09:00 PM" {{ $event->end_time == '21:00:00' ? 'selected' : ''}}>09:00 PM</option>
                <option value="09:30 PM" {{ $event->end_time == '21:30:00' ? 'selected' : ''}}>09:30 PM</option>
                <option value="10:00 PM" {{ $event->end_time == '22:00:00' ? 'selected' : ''}}>10:00 PM</option>
                <option value="10:30 PM" {{ $event->end_time == '22:30:00' ? 'selected' : ''}}>10:30 PM</option>
                <option value="11:00 PM" {{ $event->end_time == '23:00:00' ? 'selected' : ''}}>11:00 PM</option>
                <option value="11:30 PM" {{ $event->end_time == '23:30:00' ? 'selected' : ''}}>11:30 PM</option>
                <option value="12:00 AM" {{ $event->end_time == '24:00:00' ? 'selected' : ''}}>12:00 AM</option>
                <option value="12:30 AM" {{ $event->end_time == '24:30:00' ? 'selected' : ''}}>12:30 AM</option>
                <option value="01:00 AM" {{ $event->end_time == '01:00:00' ? 'selected' : ''}}>01:00 AM</option>
                <option value="01:30 AM" {{ $event->end_time == '01:30:00' ? 'selected' : ''}}>01:30 AM</option>
                <option value="02:00 AM" {{ $event->end_time == '02:00:00' ? 'selected' : ''}}>02:00 AM</option>
                <option value="02:30 AM" {{ $event->end_time == '02:30:00' ? 'selected' : ''}}>02:30 AM</option>
                <option value="03:00 AM" {{ $event->end_time == '03:00:00' ? 'selected' : ''}}>03:00 AM</option>
                <option value="03:30 AM" {{ $event->end_time == '03:30:00' ? 'selected' : ''}}>03:30 AM</option>
                <option value="04:00 AM" {{ $event->end_time == '04:00:00' ? 'selected' : ''}}>04:00 AM</option>
                <option value="04:30 AM" {{ $event->end_time == '04:30:00' ? 'selected' : ''}}>04:30 AM</option>
                <option value="05:00 AM" {{ $event->end_time == '05:00:00' ? 'selected' : ''}}>05:00 AM</option>
                <option value="05:30 AM" {{ $event->end_time == '05:30:00' ? 'selected' : ''}}>05:30 AM</option>
                <option value="06:00 AM" {{ $event->end_time == '06:00:00' ? 'selected' : ''}}>06:00 AM</option>
                <option value="06:30 AM" {{ $event->end_time == '06:30:00' ? 'selected' : ''}}>06:30 AM</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group mb-25">
    <label>Lugar</label>
    <input type="text" name="place" class="form-control form-control-md" value="{{ $event->place }}">
</div>
<div class="form-group mb-25">
    <label>Imagen</label>
    <input class="form-control custom-file-input" type="file" name="image">
</div>
<div class="form-group mb-25">
    <label>Descripción</label>
    <textarea name="description" class="form-control form-control-md">{{ $event->description }}</textarea>
</div>
