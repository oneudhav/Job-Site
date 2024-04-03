<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Right Top Advertisment</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/ads'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Ads List</a>
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
            <?php echo form_open_multipart(base_url('admin/ads/righttopads_add'), 'class="form-horizontal"');  ?> 
            <div class="form-group">
              <label for="ads image" class="col-sm-2 control-label">Advertisment Image</label>
                    <div class="col-sm-9">
                      <input type="file" name="userfile" class="form-control" placeholder="AdsImg" />
                      <input type="hidden" name="old_logo" value="">
					 </div> 
            </div>
              
              
              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>

                <div class="col-sm-9">
                  <input type="text" name="title" class="form-control" id="title" placeholder="title">
                </div>
              </div>
              
              <div class="form-group">
                <label for="url" class="col-sm-2 control-label">Url</label>

                <div class="col-sm-9">
                  <input type="text" name="url" class="form-control" id="url" placeholder="eg: https://jagirghar.com">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Advertisment" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 