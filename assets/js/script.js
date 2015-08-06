/*
* Datepicker    
*/
  $(function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'mm-dd-yy', constrainInput: false });
  });

$(document).ready(function() {
    $('#example').DataTable( {
        responsive: true,
        "autoWidth": false,
        "order": [
            [2, "asc" ],
            [1, "asc" ]
        ],
    } );
} );