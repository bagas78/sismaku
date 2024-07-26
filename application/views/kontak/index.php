
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('kontak/add/') ?><?=(@$jenis == 's')?'supplier':'pelanggan' ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode <?= (@$jenis == 's')?'Supplier':'Pelanggan' ?></th>
              <th>Nama</th>
              <th>No Telephone</th>
              <th width="70">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#example').DataTable({ 

            "responsive"  : true,
            "scrollX"     : true,
            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            
            "ajax": {
                "url": "<?= base_url('kontak/get_data/'.@$jenis); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "kontak_kode"},
                        { "data": "kontak_nama"},
                        { "data": "kontak_tlp"},
                        { "data": "kontak_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('kontak/view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a href='<?php echo base_url('kontak/edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('kontak/delete/')?>"+data+"/<?= @$jenis ?>') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>