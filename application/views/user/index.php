<section class="content-header">
      <h1>
        <?php echo $title; ?>
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> 

    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

            <div align="left">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-album"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
          <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Tanggal Input</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $key): ?>
                                  
                  <tr>
                    <td><?php echo $key['user_nama'] ?></td>
                    <td><?php echo $key['user_email'] ?></td>
                    <td style="width: 20%;"><?php echo $key['user_tanggal'] ?></td>
                    <td style="width: 50px;">
                      <div>
                      <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-edit<?php echo $key['user_id'] ?>"><i class="fa fa-edit"></i></button>
                      <button onclick="del('<?php echo base_url('user/delete/'.$key['user_id'])?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>

                      </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="modal-edit<?php echo $key['user_id'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Akun</h4>
                        </div>
                        <div class="modal-body">
                          <form role="form" method="post" action="<?php echo base_url() ?>user/update/<?php echo $key['user_id'] ?>" enctype="multipart/form-data">
                            <div class="box-body" style="padding: 10px;">
                              <div class="form-group">
                                <label>Nama</label>
                                <input required="" type="text" name="user_nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $key['user_nama'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Email</label>
                                <input required="" type="text" name="user_email" class="form-control" placeholder="Email" value="<?php echo $key['user_email'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Password</label>
                                <input required="" type="password" name="user_password" class="form-control" placeholder="Password" value="<?php echo $key['user_password'] ?>">
                              </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                               <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                <?php endforeach ?>

                </tfoot>
              </table>

        </div>

        
      </div>
      <!-- /.box -->


  <div class="modal fade" id="modal-album">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Akun</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<?php echo base_url() ?>user/add" enctype="multipart/form-data">
            <div class="box-body" style="padding: 10px;">
              <div class="form-group">
                <label>Nama</label>
                <input required="" type="text" name="user_nama" class="form-control" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input required="" type="text" name="user_email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input autocomplete="off" required="" type="password" name="user_password" class="form-control" placeholder="Password">
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
               <button type="reset" class="btn btn-danger">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

    
      