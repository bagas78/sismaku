<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">  
</head>
<body>

<?php 
	
	$date = date_create(@$data[0]['pembelian_tanggal']);

?>

<?php if ($status == 1): ?>
	<h3 align="center">Laporan Pembelian Bulan <?= date_format(@$date, 'F') ?> Tahun <?= date_format(@$date, 'Y') ?></h3><br/>
<?php else: ?>	
	<h3 align="center">Laporan Pembelian Tahun <?= date_format(@$date, 'Y') ?></h3><br/>
<?php endif ?>

<table class="table table-bordered table-responssive">
	<thead>
		<tr>
			<th>Barang</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Subtotal</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $v): ?>
			<tr>
				<td><?=@$v['barang_nama']?></td>
				<td><?=@$v['pembelian_barang_qty']?></td>
				<td><?=@$v['pembelian_barang_harga']?></td>
				<td><?=@$v['pembelian_barang_subtotal']?></td>
				<td><?=@$v['pembelian_barang_tanggal']?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

</body>
</html>

<script type="text/javascript">
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }
</script>