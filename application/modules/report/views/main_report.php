<h4 class="text-center">
    <b>
        Data Penjualan barang pada tanggal <?= format_indo_without_time($tanggal_report["tanggal_awal"])?> s/d <?= format_indo_without_time($tanggal_report["tanggal_akhir"])?>
    </b>
</h4>
<table style="padding:0; white-space:nowrap; margin:1.5rem 0;" autosize="1">
    <tr>
        <td style="padding-right: 1rem;">Nama Agen </td>
        <td>: PT. Musi Raya Bungsu Mandiri</td>
    </tr>
    <tr>
        <td style="padding-right: 1rem;">Nomor Telepon </td>
        <td>: 0889898989898</td>
    </tr>
    <tr>
        <td style="padding-right: 1rem;">Alamat </td>
        <td>: Jl Pegangsaan No.3 </td>
    </tr>
</table>
<div>
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th class="text-center" style="color: #fff; background-color: #000!important;">No.</th>
                <th class="text-center" style="color: #fff; background-color: #000!important;">Tanggal Pembelian</th> 
                <th class="text-center" style="color: #fff; background-color: #000!important;">Nama Pembeli</th> 
                <th class="text-center" style="color: #fff; background-color: #000!important;">Alamat</th> 
                <th class="text-center" style="color: #fff; background-color: #000!important;">Nama Barang</th> 
                <th class="text-right" style="color: #fff; background-color: #000!important;">Jumlah Pembelian</th> 
                <th class="text-right" style="color: #fff; background-color: #000!important;">Jumlah Pengiriman</th> 
            </tr>
        <thead>
        <tbody>
            <?php for ($i=1; $i <= count($data_pembelian); $i++) { ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= format_indo($data_pembelian[$i - 1]['tanggal_pembelian'])?></td>
                    <td><?= $data_pembelian[$i - 1]['nama']?></td>
                    <td><?= $data_pembelian[$i - 1]['alamat']?></td>
                    <td><?= $data_pembelian[$i - 1]['nama_barang']?></td>
                    <td class="text-right"><?= $data_pembelian[$i - 1]['jumlah_pembelian']?></td>
                    <td class="text-right"><?= $data_pembelian[$i - 1]['jumlah_disetujui']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>