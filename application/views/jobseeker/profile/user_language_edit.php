<?php $attributes = array('method' => 'post'); ?>
<?php echo form_open('profile/update_language',$attributes);?>

<div class="row">
  <input type="hidden" name="lang_id" value="<?= $lang['id'] ?>">
  <div class="col-md-6">
    <div class="submit-field">
      <label>Language</label>
      <?php 
        $educations = get_languages_list();
        $options = array('' => 'Select Option') + array_column($educations,'lang_name','lang_id');
        echo form_dropdown('language',$options,$lang['language'],'class="form-control" required');
      ?>
    </div>
  </div>

  <div class="col-md-6">
    <div class="submit-field">
      <label>Proficiency with this language</label>
      <?php 
        $options = get_language_levels();
        echo form_dropdown('lang_level',$options,$lang['proficiency'],'class="form-control" required');
      ?>
    </div>
  </div>

  
  <div class="col-md-12">
    <div class="submit-field">
    <button type="submit" class="btn job_detail_btn" >Submit</button>
    <button type="button" class="btn job_detail_btn close_all_collapse">Cancel</button>
    </div>
  </div>

</div>

  <?php echo form_close(); ?>   