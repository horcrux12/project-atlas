let target = document.querySelectorAll(".btnaction");
target.forEach((button) => {
    button.addEventListener("click", (e) => {
        id = button.getAttribute("data-id");
        swal({
            title: "Apakah Anda yakin ingin mengaktifkan User?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willActivate) => {
            if (willActivate) {
              swal("Sukses mengaktifkan User!", {
                icon: "success",
              }).then(() => {
                let data = {
                    id : parseInt(id),
                    status : "Aktif"
                };

                let options = {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(data)
                };

                fetch(`${baseUrl}data-pelanggan/aktifasi-user`, options)
                .then(res => res.json())
                .then(d => location.reload())
                .catch(err => console.log('Request Failed', err));
              });   
            } else {
              swal("Membatalkan aksi!");
            }
          });
    })
})