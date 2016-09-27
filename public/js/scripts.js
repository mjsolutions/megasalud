//Cambiar los settings del datepicker de materialize
var date = new Date();
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100, // Creates a dropdown of 15 years to control year
    min: [date.getFullYear() - 100, date.getMonth(), date.getDate()],
    max: [date.getFullYear(), date.getMonth(), date.getDate()],

    // The title label to use for the month nav buttons
    labelMonthNext: 'Mes siguiente',
    labelMonthPrev: 'Mes anterior',

    // The title label to use for the dropdown selectors
    labelMonthSelect: 'Selecciona un mes',
    labelYearSelect: 'Selecciona un año',

    // Months and weekdays
    monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
    weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
    weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],

    // Materialize modified
    weekdaysLetter: [ 'D', 'L', 'M', 'I', 'J', 'V', 'S' ],

    // Today and clear
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cerrar',
});