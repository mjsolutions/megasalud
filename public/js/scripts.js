//Cambiar los settings del datepicker de materialize

function initDatepicker(data) {

var hoy = data.today;

var date = new Date();

var defaults = {
    selectMonths: true, // Creates a dropdown to control month
    selectYears: data.selectYears, // Creates a dropdown of 15 years to control year
    formatSubmit: 'yyyy-mm-dd',

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
    close: 'Cerrar'
  
};

$('.datepicker').pickadate(defaults);

}