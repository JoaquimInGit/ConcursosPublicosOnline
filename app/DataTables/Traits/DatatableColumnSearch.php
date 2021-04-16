<?php

namespace App\DataTables\Traits;

trait DatatableColumnSearch
{
    /**
    column.data().unique().sort().each( function ( d, j ) {
    select.append( '<option value=\\"'+d+'\\">'+d+'</option>' )
    } );
     */
    public $searchJS = <<<JS
        function() {
            this.api().columns().every(function () {
                var column = this;
                //don't show if have sorting_disabled activated
                if(!$(column.header()).hasClass('sorting_disabled')){
                    if($(column.header()).data('options')){
                        var select = $('<select class="custom-select custom-select-sm form-control form-control-sm"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                            .search( val ? '^' + val + "$": '', true, false )
                            .draw();
                        } );
                        $.each($(column.header()).data('options'),function(key, value){
                            select.append('<option value=' + key + '>' + value + '</option>');
                        });
                    }else{
                        var input = document.createElement("input");
                        $(input).addClass('form-control form-control-sm').appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                    }
                }
            });
        }
JS;

}
