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
