const campeonatos = document.getElementById('campeonatos');

if (campeonatos) {
    campeonatos.addEventListener('click', e => {
    if (e.target.className === 'btn btn-lg btn-danger delete-campeonato') {
      if (confirm('Seguro que quieres borrar el campeonato?')) {
        const id = e.target.getAttribute('data-id');

        fetch(`/campeonato/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}