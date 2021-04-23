var d = new Date();
var year = d.getFullYear();
var c = new Date(year - 15, 12, 31);

$('.datepicker').datepicker({
    "format": "yyyy-mm-dd",
    "endDate": c
});