
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
              <td>Kode Karyawan</td>
              <td>: <?=@$data['karyawan_kode']?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>: <?=@$data['karyawan_nama']?></td>
            </tr>
            <tr>
              <td>No HP / Telp</td>
              <td>: <?=@$data['karyawan_telp']?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: <?=@$data['karyawan_alamat']?></td>
            </tr>
            <tr>
              <td>Upah</td>
              <td>: <?='Rp. '.number_format(@$data['karyawan_upah'])?></td>
            </tr>
          </table>

          <br/><hr>

          <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Kembali</button></a>

        </div>

        
      </div>
      <!-- /.box -->