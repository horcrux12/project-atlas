let formElement = document.querySelector('#tambahDataForm');

formElement.addEventListener('submit', (e) => {
    e.preventDefault();
    swal({
        title: "Apakah anda yakin data yang dimasukkan sudah sesuai ?",
        icon: "warning",
        buttons: true,
    })
    .then((isYes) => {
        if(isYes) {
            formElement.submit();
        }
    })
});