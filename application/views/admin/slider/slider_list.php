<div class="row">
  <div class="col-lg-12">
    <?php if ($this->session->flashdata('success')) :?>
    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <strong>
      <?=$this->session->flashdata('success')?>
      </strong> 
    </div>
    <?php endif;?>

    <section  class="panel">
      <div class="panel-body">
          <h4 class="head3" style="display: inline-block;"> <strong>Manage Slider</strong></h4> 
          <div class="button-inline pull-right">
              <a href="<?= base_url('admin/slider/slider_add')?>" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add Slider</a>
          </div>
      </div>
    </section>

    <section class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h4>Manage Slider</h4>
        </div>
        <div class="adv-table">
          <table  id="na_datatable"  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th>Image</th>
                <th>url</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- page end--> 
<script src="<?php echo base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
//---------------------------------------------------
	var table =	$('#na_datatable').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?=base_url('admin/slider/datatable_json')?>",
			"order": [[3,'desc']],
			"columnDefs": [
			    { "targets": 0, "name": "id", 'searchable':false, 'orderable':false},
         { "targets": 1, "name": "img", 'searchable':true, 'orderable':true,'width':'320px'},
				{ "targets": 2, "name": "url", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 3, "name": "action", 'searchable':false, 'orderable':false,'width':'130px'}
			]
		});
		
	//----------------------------------------------------------------				
</script>
<script>
    $('li#slider').addClass('active');
</script>