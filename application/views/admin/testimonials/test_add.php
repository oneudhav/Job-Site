<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add Testimonials</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/testimonials'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Testimonials List</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <?php echo form_open_multipart(base_url('admin/testimonials/test_add'), 'class="form-horizontal"');  ?> 
            <div class="form-group">
              <label for="admin logo" class="col-sm-2 control-label">Testimonial Image(150 *150)</label>
                    <div class="col-sm-9">
                   
                      <input type="file" name="userfile" class="form-control" placeholder="TestImg" />
                      <input type="hidden" name="old_logo" value="">
									  </div> 
              </div>
              
              
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Full Name</label>

                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control" id="name" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Position</label>

                <div class="col-sm-9">
                  <input type="text" name="position" class="form-control" id="firstname" placeholder="Position">
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Description</label>

                <div class="col-sm-9">
                  <input type="text" name="desc" class="form-control" id="firstname" placeholder="Description..">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Testimonial" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 