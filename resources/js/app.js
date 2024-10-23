import './bootstrap';
import './form';
import './charts';
$("#select-district").select2({placeholder:"Seleccione un distrito...",dropdownCssClass:"option2",allowClear:!0});
$("#select-zone").select2({placeholder:"Seleccione una zona...",dropdownCssClass:"option2",allowClear:!0});
$("#select-sector").select2({placeholder:"Seleccione un sector...",dropdownCssClass:"option2",allowClear:!0});
$("#select-cell").select2({placeholder:"Seleccione una célula...",dropdownCssClass:"option2",allowClear:!0});
$("#select-role").select2({placeholder:"Seleccione un rol...",dropdownCssClass:"option2",allowClear:!0});
$("#select-municipality").select2({placeholder:"Seleccione un distrito municipal...",dropdownCssClass:"option2",allowClear:!0});

$(document).ready(function(){
    $('#adult_sibling_attendance, #adult_friends_attendance').on('input', function() {
        updateTotalAdult();
    });

    function updateTotalAdult() {
        const siblingAValue = parseInt($('#adult_sibling_attendance').val()) || 0;
        const friendsAValue = parseInt($('#adult_friends_attendance').val()) || 0;
        $('#total_adult_attendance').val(siblingAValue + friendsAValue);
    }

    $('#youth_sibling_attendance, #youth_friends_attendance').on('input', function() {
        updateTotalYouth();
    });

    function updateTotalYouth() {
        const siblingYValue = parseInt($('#youth_sibling_attendance').val()) || 0;
        const friendsYValue = parseInt($('#youth_friends_attendance').val()) || 0;
        $('#total_youth_attendance').val(siblingYValue + friendsYValue);
    }

    $('#children_sibling_attendance, #children_friends_attendance').on('input', function() {
        updateTotalChildren();
    });

    function updateTotalChildren() {
        const siblingCValue = parseInt($('#children_sibling_attendance').val()) || 0;
        const friendsCValue = parseInt($('#children_friends_attendance').val()) || 0;
        $('#total_children_attendance').val(siblingCValue + friendsCValue);
    }

    $('#adult_sibling_attendance, #adult_friends_attendance, #youth_sibling_attendance, #youth_friends_attendance, #children_sibling_attendance, #children_friends_attendance').on('input', function() {
        updateTotal();
    });

    function updateTotal() {
        const siblingAValue = parseInt($('#adult_sibling_attendance').val()) || 0;
        const friendsAValue = parseInt($('#adult_friends_attendance').val()) || 0;
        const siblingYValue = parseInt($('#youth_sibling_attendance').val()) || 0;
        const friendsYValue = parseInt($('#youth_friends_attendance').val()) || 0;
        const siblingCValue = parseInt($('#children_sibling_attendance').val()) || 0;
        const friendsCValue = parseInt($('#children_friends_attendance').val()) || 0;
        $('#total_attendance').val(siblingAValue + friendsAValue + siblingYValue + friendsYValue + siblingCValue + friendsCValue);
    }

    $('#sibling_attendance_1d, #friends_attendance_1d').on('input', function() {
        updateTotalD1();
    });

    function updateTotalD1() {
        const siblingAttD1 = parseInt($('#sibling_attendance_1d').val()) || 0;
        const friendsAttD1 = parseInt($('#friends_attendance_1d').val()) || 0;
        $('#total_attendance_1d').val(siblingAttD1 + friendsAttD1);
    }

    $('#sibling_attendance_2d, #friends_attendance_2d').on('input', function() {
        updateTotalD2();
    });

    function updateTotalD2() {
        const siblingAttD2 = parseInt($('#sibling_attendance_2d').val()) || 0;
        const friendsAttD2 = parseInt($('#friends_attendance_2d').val()) || 0;
        $('#total_attendance_2d').val(siblingAttD2 + friendsAttD2);
    }

    $('#sibling_attendance_sd, #friends_attendance_sd').on('input', function() {
        updateTotalSD();
    });

    function updateTotalSD() {
        const siblingAttSd = parseInt($('#sibling_attendance_sd').val()) || 0;
        const friendsAttSd = parseInt($('#friends_attendance_sd').val()) || 0;
        $('#total_attendance_sd').val(siblingAttSd + friendsAttSd);
    }

    $('#sibling_attendance_1d, #friends_attendance_1d, #sibling_attendance_2d, #friends_attendance_2d, #sibling_attendance_sd, #friends_attendance_sd').on('input', function() {
        updateTotalAtt();
    });

    function updateTotalAtt() {
        const siblingAttD1 = parseInt($('#sibling_attendance_1d').val()) || 0;
        const friendsAttD1 = parseInt($('#friends_attendance_1d').val()) || 0;
        const siblingAttD2 = parseInt($('#sibling_attendance_2d').val()) || 0;
        const friendsAttD2 = parseInt($('#friends_attendance_2d').val()) || 0;
        const siblingAttSd = parseInt($('#sibling_attendance_sd').val()) || 0;
        const friendsAttSd = parseInt($('#friends_attendance_sd').val()) || 0;
        $('#total_attendance_week').val(siblingAttD1 + friendsAttD1 + siblingAttD2 + friendsAttD2 + siblingAttSd + friendsAttSd);
    }

    $('#select-cell').on('change', function() {
        axios.get("/cell_members/list" + $(this).val(), { withCredentials: true })
        .then((response) => {
            var rd = response.data;

            $('#cell-member-attendance-table tbody').empty();
            $.each(rd.data, function(key, value) {
                var html = '<tr>'+
                    '<td class="pe-0"><div class="d-flex"><div class="userDatatable__imgWrapper d-flex align-items-center m-0"><div class="checkbox-group-wrapper">'+
                    '<div class="checkbox-group d-flex"><div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">'+
                    '<input class="checkbox" type="checkbox" id="check-grp-' + value.id + '" name="attendance[]" value="' + value.id + '">'+
                    '<label for="check-grp-' + value.id + '" class="ps-0"></label></div></div></div></div></div></td>' +
                    '<td><div class="userDatatable-content d-inline-block"><span>' + value.member_name + '</span></div></td>' +
                    '<td><div class="userDatatable-content d-inline-block"><span>' + value.member_age + '</span></div></td>' +
                '</tr>';

                $('#cell-member-attendance-table tbody').append(html);
            });
        })
        .catch((error) => {
            console.log(error);
        });
    });

    $('.input-date').datepicker({
        language: 'es',
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "c-90:c+00"
    });

    $('.week-picker').datepicker({
        format: 'dd/mm/yy',
        firstDay: 1, // 1 = Monday, 0 = Sunday
        language: 'es', // Cambia a tu idioma preferido
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        onUpdateDatepicker : function(inst) {
            $(".ui-datepicker-calendar tr").on("mousemove", function() {
                $(this).find("td a").addClass("ui-state-hover");
                $(this).find(".ui-datepicker-week-col").addClass("ui-state-hover");
            });
            $(".ui-datepicker-calendar tr").on("mouseleave", function() {
                $(this).find("td a").removeClass("ui-state-hover");
                $(this).find(".ui-datepicker-week-col").removeClass("ui-state-hover");
            });
        },
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate');
            var firstDayOfWeek = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 1);
            var lastDayOfWeek = new Date(firstDayOfWeek.getFullYear(), firstDayOfWeek.getMonth(), firstDayOfWeek.getDate() + 6);

            var weekStart = padZero(firstDayOfWeek.getDate()) + '/' + padZero(firstDayOfWeek.getMonth() + 1) + '/' + firstDayOfWeek.getFullYear();
            var weekEnd = padZero(lastDayOfWeek.getDate()) + '/' + padZero(lastDayOfWeek.getMonth() + 1) + '/' + lastDayOfWeek.getFullYear();

            var weekRange = weekStart + ' - ' + weekEnd;
            $('.week-picker').val(weekRange);
        }
    });

    function padZero(num) {
        return (num < 10 ? '0' : '') + num;
    }

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
      };
    $.datepicker.setDefaults($.datepicker.regional['es']);

});
