<script type="text/javascript">

<?php if(@$view == 1):?>
	$('.form-group, table').css('pointer-events', 'none');
	$('.back').removeAttr('hidden');
	$('.add').remove();
	$('.remove').remove(); 
	$('.save').remove();
<?php endif?>

//form
$('.nomor').val('<?=@$data[0]['penjualan_nomor']?>');
$('.kontak').val('<?=@$data[0]['penjualan_kontak']?>').change();
$('.gudang').val('<?=@$data[0]['penjualan_gudang']?>').change();
$('.status').val('<?=@$data[0]['penjualan_status']?>').change();
$('.jatuh_tempo').val('<?=@$data[0]['penjualan_jatuh_tempo']?>');
$('.keterangan').val('<?=@$data[0]['penjualan_keterangan']?>');

$('#ppn').val('<?=@$data[0]['penjualan_ppn']?>');

//clone table
<?php $count = count(@$data) - 1; ?>
<?php for ($i = 0; $i < $count; $i++): ?>

	clone();

<?php endfor ?>

//insert table
<?php foreach(@$data as $key => $val): ?>

	$('.barang:eq(<?=$key?>)').val('<?=$val['penjualan_barang_barang']?>').change();
	$('.harga:eq(<?=$key?>)').val('<?=$val['penjualan_barang_harga']?>');
	$('.qty:eq(<?=$key?>)').val('<?=$val['penjualan_barang_qty']?>');
	$('.diskon:eq(<?=$key?>)').val('<?=$val['penjualan_barang_diskon']?>');

	//barang loop
	function barang_<?=$key?>(){
		
		$('.stok:eq(<?=$key?>)').val('<?=$val['penjualan_barang_stok']?>');

		setTimeout(function() {
		    barang_<?=$key?>();
		}, 100);
	}

	barang_<?=$key?>();

<?php endforeach ?>

</script>