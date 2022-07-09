let selectStatus = document.querySelector('#select-status');
let inputanJumlah = document.querySelectorAll('.jumlah-barang');
let inputanStatus = document.querySelector('#input-pesan');

selectStatus.addEventListener('change', (e) => {
    if (e.target.value == "Disetujui") {
        disbledInput(false);
        inputanStatus.style.display = "none";
    }else {
        disbledInput(true);
        inputanStatus.style.display = "block";
    }
});

inputanJumlah.forEach((el) => {
    el.addEventListener('input', (e)=>{
        let value = parseInt(e.target.value)
        let dataMax = parseInt(e.target.dataset.max)
        if (value < 0) {
            e.target.value = 0;
        }

        if (value > dataMax){
            e.target.value = dataMax;
        }
    })
})

disbledInput = (value) => {
    inputanJumlah.forEach((el) => {
        el.disabled = value;
    })
}