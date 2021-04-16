// Class definition

var DateInputs = function () {

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    var dataPicker = function() {
        $('.kt_datepicker').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: arrows,
            language: 'pt',
            format: 'yyyy-mm-dd',
        });
    };

    var dataTimePicker = function() {
        $('.kt_datetimepicker').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            language: 'pt',
            todayBtn: true,
            clearBtn: true,
            format: 'yyyy-mm-dd hh:ii'
        });
    };

    var timePicker = function() {
        $('.kt_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '',
            showSeconds: true,
            showMeridian: false,
            snapToStep: true
        });
    };

    var dateRangePicker = function(){
        $('.kt_daterangepicker').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        });
    };


    return {
        // public functions
        init: function() {
            dataPicker();
            dataTimePicker();
            timePicker();
            dateRangePicker();
        }
    };
}();

jQuery(document).ready(function() {
    DateInputs.init();
});