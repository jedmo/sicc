<div class="col-xxl-8 mb-25">

    <div class="card border-0 px-25">
        <div class="card-header px-0 border-0">
            <h6>Miembros de la celula</h6>
        </div>
        <div class="card-body p-0" style="overflow-y: scroll; height: 320px;">
            <div class="selling-table-wrap selling-table-wrap--source">
                <div class="table-responsive">
                    <table class="table table--default table-borderless">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Conversión</th>
                                <th>Bautizado</th>
                                <th>Fecha de nacimiento</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($last_week_data['members'] as $member)
                                <tr>
                                    <td>
                                        <div class="selling-product-img d-flex align-items-center">
                                            <div class="selling-product-img-wrapper order-bg-opacity-primary align-items-end">
                                                {{ $member['full_name'][0] }}
                                            </div>
                                            <span>{{ $member['full_name'] }}</span>
                                        </div>
                                    </td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>{{ $member['birth_date'] }}</td>
                                    <td>{{ $member['status'] == 1 ? 'Activo' : 'Inactivo' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
