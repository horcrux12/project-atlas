let buttonHapus = document.querySelector('#btn-hapus');

buttonHapus.addEventListener('click', (e) => {
    e.preventDefault();
    swal({
        title: "Apakah kamu yakin ingin menghapus data pembelian ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href = e.target.href    
        }
    });
})