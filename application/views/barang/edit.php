<script type="text/javascript">
  $('form').attr('action', '<?=base_url('barang/update/'.@$data['barang_id'].'/'.@$kategori)?>');

  $('.kode').val('<?=@$data['barang_kode']?>');
  $('.nama').val('<?=@$data['barang_nama']?>');
  $('.kategori').val('<?=@$data['barang_kategori']?>');
  $('.satuan').val('<?=@$data['barang_satuan']?>').change();
</script>