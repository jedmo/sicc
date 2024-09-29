<div class="form-group mb-25">
    <label for="full_name" class="color-dark fs-14 fw-500 align-center">Nombre completo <span class="text-danger">*</span></label>
    <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
        value="{{ $member->full_name }}" id="full_name" placeholder="nombre completo" readonly>
    <input type="hidden" name="member_id" value="{{ $member->id }}">
</div>
<div class="form-group mb-25">
    <label for="step" class="color-dark fs-14 fw-500 align-center">Proceso<span class="text-danger">*</span></label>
    <select class="form-control ih-medium ip-gray radius-xs b-light px-15" name="step" id="step" required>
        <option value="">Seleccione...</option>
        @foreach ($steps as $step)
            <option value="{{ $step->value }}" {{ $tracking->step == $step->value ? 'selected' : '' }}>{{ $step->value }}</option>
        @endforeach
    </select>
    @if ($errors->has('step'))
    <p class="text-danger">{{ $errors->first('step') }}</p>
    @endif
</div>
<div class="form-group-calender mb-25">
    <div class="with-icon">
        <label for="step_date" class="color-dark fs-14 fw-500 align-center">Fecha</label>
        <div class="position-relative">
            <input type="text" class="form-control ih-medium ip-light radius-xs b-light px-15 input-date" name="step_date" id="step_date"
            value="{{ $tracking->step_date ? date('d/m/Y', strtotime($tracking->step_date)) : date('d/m/Y') }}" />
            <a href="#"><img class="svg" src="{{ asset('assets/img/svg/calendar.svg') }}" alt="calendar"></a>
        </div>
    </div>
</div>
<div class="form-group mb-25">
    <label for="location" class="color-dark fs-14 fw-500 align-center">Lugar</label>
    <input type="text" name="location" id="location" cols="3" class="form-control" value="{{ $tracking->location }}" />
    @if($errors->has('location'))
    <p class="text-danger">{{ $errors->first('location') }}</p>
    @endif
</div>
<div class="form-group mb-25">
    <label for="comment" class="color-dark fs-14 fw-500 align-center">Comentario</label>
    <textarea name="comment" id="comment" cols="3" class="form-control">{{ $tracking->comment }}</textarea>
    @if($errors->has('comment'))
    <p class="text-danger">{{ $errors->first('comment') }}</p>
    @endif
</div>
