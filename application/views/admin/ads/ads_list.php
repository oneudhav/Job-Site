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
          <h4 class="head3" style="display: inline-block;"> <strong>Manage Ads</strong></h4> 
          <div class="button-inline pull-right">
              <a href="<?= base_url('admin/ads/righttopads_add')?>" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New Ads</a>
          </div>
      </div>
    </section>

    <section class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h4>Manage Ads</h4>
        </div>
        <div class="adv-table">
          <table  id="na_datatable"  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th>Image</th>
                <th>Title</th>
                <th>Url</th>
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
			"ajax": "<?=base_url('admin/ads/datatable_json')?>",
			"order": [[4,'desc']],
			"columnDefs": [
			  { "targets": 0, "name": "id", 'searchable':false, 'orderable':false},
        { "targets": 1, "name": "img", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 2, "name": "title", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 3, "name": "url", 'searchable':true, 'orderable':true},
				{ "targets": 4, "name": "action", 'searchable':false, 'orderable':false,'width':'130px'}
			]
		});
		
	//----------------------------------------------------------------				
</script>
<script>
    $('li#ads').addClass('active');
</script>