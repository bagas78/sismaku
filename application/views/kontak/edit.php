<script type="text/javascript">
  $('form').attr('action', '<?=base_url('kontak/update/'.@$data['kontak_id'].'/'.@$data['kontak_jenis'])?>');

  $('.kode').val('<?=@$data['kontak_kode']?>');
  $('.nama').val('<?=@$data['kontak_nama']?>');
  $('.alamat').val('<?=@$data['kontak_alamat']?>');
  $('.tlp').val('<?=@$data['kontak_tlp']?>');
</script>