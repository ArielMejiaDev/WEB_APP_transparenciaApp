var App = (function () {
  'use strict';

  App.dataTables = function( ){

    //We use this to apply style to certain elements
    $.extend( true, $.fn.dataTable.defaults, {
      dom:
        "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
        "<'row be-datatable-body'<'col-sm-12'tr>>" +
        "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    } );

    $("#table1").dataTable();

    //Remove search & paging dropdown
    $("#table2").dataTable({
      pageLength: 6,
      dom:  "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });

    //Enable toolbar button functions
    $("#table3").dataTable({
      buttons: [
        'copy', 'excel', 'pdf', 'print'
      ],
      "lengthMenu": [[6, 10, 25, 50, -1], [6, 10, 25, 50, "All"]],
      dom:  "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>>" +
            "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });

    //Enable toolbar button functions
    $("#table4").dataTable({
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      "filter":true,
      dom:  "<'row be-datatable-header'<'col-sm-6'B><'col-sm-3 text-left'l><'col-sm-3 text-right'f>>" +
            "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });


    $("#table5").dataTable({
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      buttons: [
        // {
        //     extend: 'print',
        //     text: 'Print current page',
        //     autoPrint: true,
        // },
        {
            extend: 'copy',
            text: '<i class="icon mdi mdi-copy"> <i>',
        },
        {
            extend: 'csv',
            text: 'csv <i class="icon mdi mdi-download"><i>',
        },
        {
            extend: 'excel',
            text: 'excel <i class="icon mdi mdi-download"><i>',
        },
        {
            extend: 'pdf',
            text: '<i class="icon mdi mdi-collection-pdf"> <i>',
        },
        {
            extend: 'print',
            text: '<i class="icon mdi mdi-print"> <i>',
            exportOptions: {
                columns: ':visible',
            },
            autoPrint: true
        }
    ],
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      dom:  "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>>" +
            "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });




    $("#table6").dataTable({
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      buttons: [
        // {
        //     extend: 'print',
        //     text: 'Print current page',
        //     autoPrint: true,
        // },
        {
            extend: 'copy',
            text: '<i class="icon mdi mdi-copy"> <i>',
        },
        {
            extend: 'csv',
            text: 'csv <i class="icon mdi mdi-download"><i>',
        },
        {
            extend: 'excel',
            text: 'excel <i class="icon mdi mdi-download"><i>',
        },
        {
            extend: 'pdfHtml5',
            title: 'Instituto de Previsión Militar',
            orientation: 'landscape',
            pageSize: 'LETTER',
            download: 'open',
            customize: function ( doc ) 
            {
                doc.pageMargins = [100, 40, 100,10 ];
                doc.content.splice( 1, 0, {
                    margin: [ 0, -50, 0, 50 ],
                    alignment: 'left',
                    image: 'data:image/png;base64,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'
                } );
            },
            text: '<i class="icon mdi mdi-collection-pdf"> <i>',
        },
        {
            extend: 'print',
            title: 'Instituto de Previsión Militar',
            orientation: 'landscape',
            pageSize: 'LETTER',
            text: '<i class="icon mdi mdi-print"> <i>',
            exportOptions: {
                columns: ':visible',
            }
        }
    ],
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      "filter":true,
      dom:  "<'row be-datatable-header'<'hidden-xs col-sm-6'B><'hidden-xs col-sm-3 text-left'l><'hidden-xs col-sm-3 text-right'f>>" +
      "<'hidden-sm hidden-md hidden-lg hidden-xl row be-datatable-header'<'hidden-sm hidden-md hidden-lg hidden-xl col-xs-12 text-center btn-block'B>>" +
      "<'hidden-sm hidden-md hidden-lg hidden-xl row be-datatable-header'<'hidden-sm hidden-md hidden-lg hidden-xl col-sm-3 text-center 'f>>" +
            "<'row be-datatable-body'<'col-sm-12'tr>>" +
            "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>"
    });



  };

  return App;
})(App || {});
