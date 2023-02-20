$(document).ready(function(){
  $('#filtroTabla').change(function(e) {
    e.preventDefault();
    var sistema = getUrl();
    // alert(sistema);
    location.href = sistema + '?filtros=' + $(this).val();
  })
});
function getUrl() {
  var loc = window.location;
  var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('') + 1);
  return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}
