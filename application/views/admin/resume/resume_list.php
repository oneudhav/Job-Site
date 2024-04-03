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
          <h4 class="head3" style="display: inline-block;"> <strong>Manage Resumes</strong></h4> 
          
      </div>
    </section>

    <section class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h4>Manage Resumes</h4>
        </div>
        <div class="adv-table">
          <table  id="na_datatable"  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th>Resume</th>
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
			"ajax": "<?=base_url('admin/resume/datatable_json')?>",
			"order": [[1,'desc']],
			"columnDefs": [
			  { "targets": 0, "name": "id", 'searchable':false, 'orderable':false,'width':'10px'},
        { "targets": 1, "name": "uploads", 'searchable':true, 'orderable':true},
				{ "targets": 2, "name": "action", 'searchable':false, 'orderable':false,}
			]
		});
		
	//----------------------------------------------------------------				
</script>
<script>
    $('li#resume').addClass('active');
</script>