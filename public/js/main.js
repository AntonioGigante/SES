const users = document.getElementById('users');

if (users) {
    users.addEventListener('click', e => {
    if (e.target.className === 'btn btn-lg btn-primary delete-user') {
      if (confirm('Seguro que quieres borrar el usuario?')) {
        const id = e.target.getAttribute('data-id');

        fetch(`/perfil/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}