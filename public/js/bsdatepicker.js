$('#datepicker').datepicker({
  format: "yyyy/mm/dd",
  maxViewMode: 3,
  todayBtn: true,
  clearBtn: true,
  language: "ja",
  beforeShowDay: function(date) {
    if (date.getMonth() == (new Date()).getMonth())
      switch (date.getDate()) {
        case 4:
          return {
            tooltip: 'Example tooltip',
            classes: 'active'
          };
        case 8:
          return false;
        case 12:
          return "green";
      }
  },
  beforeShowMonth: function(date) {
    if (date.getMonth() == 8) {
      return false;
    }
  },
  beforeShowYear: function(date) {
    if (date.getFullYear() == 2007) {
      return false;
    }
  }
});

$('#dog-bd-datepicker').datepicker({
  format: "yyyy/mm/dd",
  language: "ja"
});
