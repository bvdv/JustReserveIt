$( function() {
  var dateFormat = "mm/dd/yy",
  from = $( "#check-in" )
  .datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    changeYear: true,
    numberOfMonths: 1
  })
  .on( "change", function() {
    to.datepicker( "option", "minDate", getDate( this ) );
  }),
  to = $( "#check-out" ).datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    changeYear: true,
    numberOfMonths: 1
  })
  .on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
  });
  
  function getDate( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }
    
    return date;
  }
} );