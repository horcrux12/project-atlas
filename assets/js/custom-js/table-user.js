let buttonHapus = document.querySelectorAll('.btn-hapus');

buttonHapus.forEach(el => {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        swal({
            title: "Apakah kamu yakin ingin menghapus data ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = el.href    
            }
        });
    })
});