<div class="row">
  <div class="col-md-8">
    <h4>Personal Information</h4>
    <table class="table">
      <tr>
        <td>Full Name</td>
        <td><?= $user_info['firstname'].' '.$user_info['lastname']  ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?= $user_info['email']  ?></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><?= $user_info['mobile_no']  ?></td>
      </tr>
      <tr>
        <td>Date of Birth</td>
        <td><?= date('d M, Y',strtotime($user_info['dob']))  ?></td>
      </tr>

      <tr>
        <td>Category</td>
        <td><?= $user_info['category']  ?></td>
      </tr>

      <tr>
        <td>User Job Title</td>
        <td><?= $user_info['job_title']  ?></td>
      </tr>

      <tr>
        <td>Experience</td>
        <td><?= $user_info['experience']  ?></td>
      </tr>

      <tr>
        <td>Skills</td>
        <td><?= $user_info['skills']  ?></td>
      </tr>

      <tr>
        <td>Current Salary($)</td>
        <td><?= $user_info['current_salary']  ?></td>
      </tr>

      <tr>
        <td>Expected Salary($)</td>
        <td><?= $user_info['expected_salary']  ?></td>
      </tr>

      <tr>
        <td>Nationality</td>
        <td><?= $user_info['nationality']  ?></td>
      </tr>

      <tr>
        <td>Country</td>
        <td><?= $user_info['country']  ?></td>
      </tr>

      <tr>
        <td>City / Town</td>
        <td><?= $user_info['city']  ?></td>
      </tr>

      <tr>
        <td>Postcode</td>
        <td><?= $user_info['postcode']  ?></td>
      </tr>

      <tr>
        <td>Address</td>
        <td><?= $user_info['address']  ?></td>
      </tr>

      <tr>
        <td>Objective</td>
        <td><?= $user_info['description']  ?></td>
      </tr>
    </table>
  </div>

  <div class="col-md-8">
    <h4>Education</h4>

    <?php foreach($education as $edu): ?>
    <!-- education detail -->
    <div class="employer-job-list">
      <h5><?= get_education_level($edu['degree']).', '.$edu['degree_title'] ?></h5>
      <p><?= $edu['institution'] ?><br> <?= $edu['completion_year'] ?></p>
    </div>
    <?php endforeach; ?>
    <!-- education detail -->
  </div>

  <div class="col-md-8">
    <h4>Experience</h4>
    <?php foreach($experiences as $exp): ?>
    <!-- education detail -->
      <div class="employer-job-list">
        <h5><?= $exp['job_title'] ?></h5>
        <p><?= $exp['company'] ?></p>
        <p><?= get_nth_month($exp['starting_month']) .' '.$exp['starting_year']?> - <?= (!$exp['currently_working_here']) ? get_nth_month($exp['ending_month']) .' '.$exp['ending_year'] : 'Present ' ?> | <?= get_city_name($exp['city']).', '.get_country_name($exp['country']) ?></p>
        <p class="overflow-ellipsis"><?= $exp['description'] ?></p>
      </div>
    <?php endforeach; ?>
    <!-- education detail -->

  </div>

  <div class="col-md-8">
    
    <h4>Languages</h4>
    <?php foreach($languages as $lang): ?>
    <!-- education detail -->
      <div class="employer-job-list">
        <p><?= get_language_name($lang['language']).' ( '.get_lang_proficiency_name($lang['proficiency']).' ) ' ?></p>
      </div>
    <?php endforeach; ?>
    <!-- education detail -->
  </div>

</div>