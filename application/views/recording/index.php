
    <!-- Main content -->  
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
              <a href="<?= base_url('recording/harian_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
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
              <th>Nomor</th>
              <th>Tanggal</th>
              <th width="60">Action</th>
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
                "url": "<?= base_url('recording/harian_get'); ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "recording_nomor"},
                        { "data": "recording_tanggal",
                        "render": 
                        function( data, type, row, meta ) {
                            return moment(data).format("DD/MM/YYYY");
                          }
                        },
                        { "data": "recording_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('recording/harian_edit/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button></a> "+
                            "<a href='<?php echo base_url('recording/harian_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('recording/delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

</script>