/**
 * Theme: Xadmino
 * Datatable
 * DEMO ONLY MINIFY
 */
var handleDataTableButtons = function () {
    "use strict";
    0 !== $("#datatablesTicketsTicket-buttons").length &&
      $("#datatablesTicketsTicket-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [
          { extend: "copy", className: "btn-success" },
          { extend: "csv" },
          { extend: "excel" },
          { extend: "pdf" },
          { extend: "print" },
        ],
        responsive: !0,
      });
  },
  TableManageButtons = (function () {
    "use strict";
    return {
      init: function () {
        handleDataTableButtons();
      },
    };
  })();
TableManageButtons.init(),
  $(document).ready(function () {
    $("#datatablesTicketsTicket").dataTable(),
      $("#datatablesTicketsTicket-keytable").DataTable({ keys: !0 }),
      $("#datatablesTicketsTicket-responsive").DataTable(),
      $("#datatablesTicketsTicket-scroller").DataTable({
        ajax: "assets/plugins/datatablesTicketsTickets/json/scroller-demo.json",
        deferRender: !0,
        scrollY: 380,
        scrollCollapse: !0,
        scroller: !0,
      });
    $("#datatablesTicket-fixed-header").DataTable({ fixedHeader: !0 });
  });
