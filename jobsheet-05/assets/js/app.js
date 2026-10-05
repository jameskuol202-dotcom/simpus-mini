document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('nav-toggle-btn');
  var nav = document.querySelector('header nav');
  if (btn && nav) {
    btn.addEventListener('click', function () { nav.classList.toggle('open'); });
  }
  var search = document.getElementById('search-input');
  if (search) {
    search.addEventListener('input', function () {
      var q = search.value.toLowerCase();
      document.querySelectorAll('tbody tr').forEach(function (row) {
        row.style.display = row.textContent.toLowerCase().indexOf(q) === -1 ? 'none' : '';
      });
    });
  }
});
