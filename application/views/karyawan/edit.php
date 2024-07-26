<script type="text/javascript">
  $('form').attr('action', '<?=base_url('karyawan/update/'.@$data['karyawan_id'])?>');

  $('.kode').val('<?=@$data['karyawan_kode']?>');
  $('.nama').val('<?=@$data['karyawan_nama']?>');
  $('.alamat').val('<?=@$data['karyawan_alamat']?>');
  $('.telp').val('<?=@$data['karyawan_telp']?>');
  $('.upah').val('<?=@$data['karyawan_upah']?>');
</script>