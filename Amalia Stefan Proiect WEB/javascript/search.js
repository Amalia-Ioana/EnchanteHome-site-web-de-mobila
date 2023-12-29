document.querySelector('form').addEventListener('submit', function(event) {
  event.preventDefault(); // Previne comportamentul implicit de trimitere a formularului

  var searchTerm = document.getElementById('searchInput').value.trim();
  if (searchTerm !== '') {
    var paragraphs = document.querySelectorAll('.card-text');
    var regex = new RegExp('(' + searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');

    paragraphs.forEach(function(paragraph) {
      var content = paragraph.textContent;
      var modifiedContent = content.replace(regex, '<span class="highlight">$1</span>');
      paragraph.innerHTML = modifiedContent;
    });
  }
});