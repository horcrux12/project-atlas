let selectBarang = document.querySelector('#select-barang');
let jumlahBarang = document.querySelector('#jumlah-barang');
let formElement = document.querySelector('#tambahDataForm');
let isiTable = document.querySelector('#isiTable');
let btnSubmit = document.querySelector('#btn-submit');

let maxPembelian = 0;
let detailBarang = {
    'id' : 0,
    'nama_barang' : '',
    'stok': 0,
    'jumlah_pembelian': ''
}
let dataBarang = [];


selectBarang.addEventListener('change', (e)=> {
    const [option] = e.target.selectedOptions

    if(option.value == ''){
        jumlahBarang.disabled = true;
    }else{
        detailBarang = JSON.parse(option.value)
        detailBarang.id = parseInt(detailBarang.id)
        detailBarang.stok = parseInt(detailBarang.stok)
        jumlahBarang.disabled = false;
    }
});

formElement.addEventListener('submit', (e) => {
    const [option] = selectBarang.selectedOptions;
    detailBarang.jumlah_pembelian = parseInt(jumlahBarang.value)

    if(detailBarang.jumlah_pembelian < 1){
        alert("isi Jumlah Pembelian harus lebih dari 0")
    }else{
        if(dataBarang.some(el => {
            return el.id == detailBarang.id
        })){
            alert('data ini telah ada');
        }else{
            dataBarang.push(detailBarang);
            e.target.reset();
        }
        drawTable();
    }
    e.preventDefault();
});

btnSubmit.addEventListener('click', (e) => {
    if(dataBarang.length < 1){
        alert("Harap memasukkan barang yang ingin dibeli");
    }else {
        let options = {
            method : 'POST',
            headers : {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body : JSON.stringify(dataBarang)
        }

        fetch(`${baseUrl}data-pembelian/input-pembelian`, options)
        .then(res => res.json())
        .then(d => {
            swal("Berhasil melakukan pembelian", {
                icon: "success",
            }).then(()=>{
                window.location.href = `${baseUrl}data-pembelian`;
            })
        })
        .catch(err => swal("gagal Melakaukan Pembelian barang"));
    }
});

const drawTable = () => {
    dataTable = ''
    if(dataBarang.length > 0){
        dataBarang.forEach((el, idx) => {
            dataTable += `
            <tr>
                <td>${el.nama_barang}</td>
                <td>${el.jumlah_pembelian}</td>
                <td>
                    <button type="button" onClick='hapusBarang(${idx})' class="btn btn-danger">Remove</button>
                </td>
            </tr>
            `
        })
    }else {
        dataTable = `<tr>
            <td colspan="3" style="text-align: center">Tidak ada Data</td>
        </tr>`
    }

    isiTable.innerHTML = dataTable
}

const hapusBarang = (idx) => {
    dataBarang.splice(idx, 1);
    drawTable();
}