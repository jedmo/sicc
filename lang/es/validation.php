<?php

declare(strict_types=1);

return [
    'accepted'             => 'El :attribute debe ser aceptado.',
    'accepted_if'          => 'El :attribute debe ser aceptado cuando :other es :value.',
    'active_url'           => 'El :attribute no es una URL válida.',
    'after'                => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El :attribute solo puede contener letras.',
    'alpha_dash'           => 'El :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El :attribute solo puede contener letras y números.',
    'array'                => 'El :attribute debe ser un array.',
    'before'               => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'array'   => 'El :attribute debe tener entre :min y :max elementos.',
        'file'    => 'El :attribute debe tener entre :min y :max kilobytes.',
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'string'  => 'El :attribute debe tener entre :min y :max caracteres.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'current_password'     => 'La contraseña es incorrecta.',
    'date'                 => 'El :attribute no es una fecha válida.',
    'date_equals'          => 'El :attribute debe ser una fecha igual a :date.',
    'date_format'          => 'El :attribute no coincide con el formato :format.',
    'declined'             => 'El :attribute debe ser rechazado.',
    'declined_if'          => 'El :attribute debe ser rechazado cuando :other es :value.',
    'different'            => 'El :attribute y :other deben ser diferentes.',
    'digits'               => 'El :attribute debe tener :digits dígitos.',
    'digits_between'       => 'El :attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'El :attribute tiene dimensiones de imagen no válidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with'            => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'enum'                 => 'El valor seleccionado de :attribute es inválido.',
    'exists'               => 'El valor seleccionado de :attribute es inválido.',
    'file'                 => 'El :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute debe tener un valor.',
    'gt'                   => [
        'array'   => 'El :attribute debe tener más de :value elementos.',
        'file'    => 'El :attribute debe tener más de :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'string'  => 'El :attribute debe tener más de :value caracteres.',
    ],
    'gte'                  => [
        'array'   => 'El :attribute debe tener :value elementos o más.',
        'file'    => 'El :attribute debe tener :value kilobytes o más.',
        'numeric' => 'El :attribute debe ser mayor o igual que :value.',
        'string'  => 'El :attribute debe tener :value caracteres o más.',
    ],
    'image'                => 'El :attribute debe ser una imagen.',
    'in'                   => 'El valor seleccionado de :attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El :attribute debe ser un número entero.',
    'ip'                   => 'El :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'El :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El :attribute debe ser una cadena JSON válida.',
    'lt'                   => [
        'array'   => 'El :attribute debe tener menos de :value elementos.',
        'file'    => 'El :attribute debe tenermenos de :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor que :value.',
        'string'  => 'El :attribute debe tener menos de :value caracteres.',
    ],
    'lte'                  => [
        'array'   => 'El :attribute no debe tener más de :value elementos.',
        'file'    => 'El :attribute debe tener :value kilobytes o menos.',
        'numeric' => 'El :attribute debe ser menor o igual que :value.',
        'string'  => 'El :attribute debe tener :value caracteres o menos.',
    ],
    'mac_address'          => 'El :attribute debe ser una dirección MAC válida.',
    'max'                  => [
        'array'   => 'El :attribute no debe tener más de :max elementos.',
        'file'    => 'El :attribute no debe ser mayor que :max kilobytes.',
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'string'  => 'El :attribute no debe tener más de :max caracteres.',
    ],
    'mimes'                => 'El :attribute debe ser un archivo del tipo: :values.',
    'mimetypes'            => 'El :attribute debe ser un archivo del tipo: :values.',
    'min'                  => [
        'array'   => 'El :attribute debe tener al menos :min elementos.',
        'file'    => 'El :attribute debe tener al menos :min kilobytes.',
        'numeric' => 'El :attribute debe ser al menos :min.',
        'string'  => 'El :attribute debe tener al menos :min caracteres.',
    ],
    'multiple_of'          => 'El :attribute debe ser un múltiplo de :value.',
    'not_in'               => 'El valor seleccionado de :attribute es inválido.',
    'not_regex'            => 'El formato de :attribute es inválido.',
    'numeric'              => 'El :attribute debe ser un número.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'El campo :attribute debe estar presente.',
    'prohibited'           => 'El campo :attribute está prohibido.',
    'prohibited_if'        => 'El campo :attribute está prohibido cuando :other es :value.',
    'prohibited_unless'    => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits'            => 'El campo :attribute prohíbe la presencia de :other.',
    'regex'                => 'El formato de :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_array_keys'  => 'El campo :attribute debe contener entradas para: :values.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values está presente.',
    'same'                 => 'El :attribute y :other deben coincidir.',
    'size'                 => [
        'array'   => 'El :attribute debe contener :size elementos.',
        'file'    => 'El :attribute debe ser :size kilobytes.',
        'numeric' => 'El :attribute debe ser :size.',
        'string'  => 'El :attribute debe ser :size caracteres.',
    ],
    'starts_with'          => 'El :attribute debe comenzar con uno de los siguientes: :values.',
    'string'               => 'El :attribute debe ser unacadena.',
    'timezone'             => 'El :attribute debe ser una zona horaria válida.',
    'unique'               => 'El :attribute ya ha sido tomado.',
    'uploaded'             => 'El :attribute falló al cargar.',
    'url'                  => 'El :attribute debe ser una URL válida.',
    'uuid'                 => 'El :attribute debe ser un UUID válido.',
    'attributes'           => [
        'address'                  => 'dirección',
        'affiliate_url'            => 'URL de afiliado',
        'age'                      => 'edad',
        'amount'                   => 'cantidad',
        'announcement'             => 'anuncio',
        'area'                     => 'área',
        'audience_prize'           => 'premio del público',
        'available'                => 'disponible',
        'birthday'                 => 'cumpleaños',
        'body'                     => 'contenido',
        'city'                     => 'ciudad',
        'compilation'              => 'compilación',
        'concept'                  => 'concepto',
        'conditions'               => 'condiciones',
        'content'                  => 'contenido',
        'country'                  => 'país',
        'cover'                    => 'portada',
        'created_at'               => 'creado el',
        'creator'                  => 'creador',
        'currency'                 => 'moneda',
        'current_password'         => 'contraseña actual',
        'customer'                 => 'cliente',
        'date'                     => 'fecha',
        'date_of_birth'            => 'fecha de nacimiento',
        'dates'                    => 'fechas',
        'day'                      => 'día',
        'deleted_at'               => 'eliminado el',
        'description'              => 'descripción',
        'display_type'             => 'tipo de visualización',
        'district'                 => 'distrito',
        'duration'                 => 'duración',
        'email'                    => 'correo electrónico',
        'excerpt'                  => 'extracto',
        'filter'                   => 'filtro',
        'finished_at'              => 'terminado el',
        'first_name'               => 'nombre',
        'gender'                   => 'género',
        'grand_prize'              => 'gran Premio',
        'group'                    => 'grupo',
        'hour'                     => 'hora',
        'image'                    => 'imagen',
        'image_desktop'            => 'imagen de escritorio',
        'image_main'               => 'imagen principal',
        'image_mobile'             => 'imagen móvil',
        'images'                   => 'imágenes',
        'is_audience_winner'       => 'es ganador de audiencia',
        'is_hidden'                => 'está oculto',
        'is_subscribed'            => 'está suscrito',
        'is_visible'               => 'es visible',
        'is_winner'                => 'es ganador',
        'items'                    => 'elementos',
        'key'                      => 'clave',
        'last_name'                => 'apellidos',
        'lesson'                   => 'lección',
        'line_address_1'           => 'línea de dirección 1',
        'line_address_2'           => 'línea de dirección 2',
        'login'                    => 'acceso',
        'message'                  => 'mensaje',
        'middle_name'              => 'segundo nombre',
        'minute'                   => 'minuto',
        'mobile'                   => 'móvil',
        'month'                    => 'mes',
        'name'                     => 'nombre',
        'national_code'            => 'código nacional',
        'number'                   => 'número',
        'password'                 => 'contraseña',
        'password_confirmation'    => 'confirmación de la contraseña',
        'phone'                    => 'teléfono',
        'photo'                    => 'foto',
        'portfolio'                => 'portafolio',
        'postal_code'              => 'código postal',
        'preview'                  => 'vista preliminar',
        'price'                    => 'precio',
        'product_id'               => 'ID del producto',
        'product_uid'              => 'UID del producto',
        'product_uuid'             => 'UUID del producto',
        'promo_code'               => 'código promocional',
        'province'                 => 'provincia',
        'quantity'                 => 'cantidad',
        'reason'                   => 'razón',
        'recaptcha_response_field' => 'respuesta del recaptcha',
        'referee'                  => 'árbitro',
        'referees'                 => 'árbitros',
        'reject_reason'            => 'motivo de rechazo',
        'remember'                 => 'recordar',
        'restored_at'              => 'restaurado el',
        'result_text_under_image'  => 'texto bajo la imagen',
        'role'                     => 'rol',
        'rule'                     => 'regla',
        'rules'                    => 'reglas',
        'second'                   => 'segundo',
        'sex'                      => 'sexo',
        'shipment'                 => 'envío',
        'short_text'               => 'texto corto',
        'size'                     => 'tamaño',
        'skills'                   => 'habilidades',
        'slug'                     => 'slug',
        'specialization'           => 'especialización',
        'started_at'               => 'comenzado el',
        'state'                    => 'estado',
        'status'                   => 'estado',
        'street'                   => 'calle',
        'student'                  => 'estudiante',
        'subject'                  => 'asunto',
        'tag'                      => 'etiqueta',
        'tags'                     => 'etiquetas',
        'teacher'                  => 'profesor',
        'terms'                    => 'términos',
        'test_description'         => 'descripción de prueba',
        'test_locale'              => 'idioma de prueba',
        'test_name'                => 'nombre de prueba',
        'text'                     => 'texto',
        'time'                     => 'hora',
        'title'                    => 'título',
        'type'                     => 'tipo',
        'updated_at'               => 'actualizado el',
        'user'                     => 'usuario',
        'username'                 => 'usuario',
        'value'                    => 'valor',
        'year'                     => 'año',
    ],
];
