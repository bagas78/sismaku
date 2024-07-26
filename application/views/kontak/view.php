
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <table class="table table-borderless">
            <tr>
              <td>Kode <?= (@$jenis == 's')?'Supplier':'Pelanggan' ?></td>
              <td>: <?=@$data['kontak_kode']?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>: <?=@$data['kontak_nama']?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: <?=@$data['kontak_alamat']?></td>
            </tr>
            <tr>
              <td>No. Telepon</td>
              <td>: <?=@$data['kontak_tlp']?></td>
            </tr>
          </table>

          <br/><hr>

          <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Kembali</button></a>

        </div>

        
      </div>
      <!-- /.box -->