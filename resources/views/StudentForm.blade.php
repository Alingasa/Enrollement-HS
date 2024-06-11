<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>


        </style>
</head>
<body>

    <form id="studentform" class="row g-3 p-4">

        <div class="col-md-4">
          <label for="firstname" class="form-label">Firstname</label>
          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="firstname" required>
        </div>
        <div class="col-md-4">
          <label for="middlename" class="form-label">Middlename</label>
          <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="middlename" required>
        </div>
        <div class="col-md-4">
          <label for="lastname" class="form-label">Lastname</label>
          <input type="text" name="last_name" class="form-control" id="last_name" placeholder="lastname" required>
        </div>
    <div class="col-md-4">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="email" required>
    </div>
    <div class="col-md-4">
        <label for="phone" class="form-label">Phone</label>
        <input type="number" name="phone" class="form-control" id="phone" placeholder="phone no." required>
      </div>
    <div class="col-md-4">
        <label for="gender" class="form-label">Gender</label>
        <select id="inputState" name="gender" class="form-select">
          <option selected>Choose...</option>
          <option>Male</option>
          <option>Female</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="birthdate" class="form-label">Birthdate</label>
        <input type="date" name="birthdate" class="form-control" id="birthdate" placeholder="date of birth" required>
      </div>
      <div class="col-md-4">
        <label for="civilstatus" class="form-label">Civil Status</label>
        <select id="inputState" name="civil_status" class="form-select">
          <option selected>Choose...</option>
          <option>Single</option>
          <option>Marriage</option>
          <option>Widdowed</option>
          <option>Annulled</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="religion" class="form-label">Religion</label>
        <select id="inputState" name="religion" class="form-select">
          <option selected>Choose...</option>
          <option>Roman Catholic</option>
          <option>Muslim</option>
          <option>Widdowed</option>
          <option>Annulled</option>
        </select>
      </div>


      <div class="col-md-4">
        <label for="purok" class="form-label">Purok</label>
        <input type="text" name="purok" class="form-control" id="purok" placeholder="purok" required>
      </div>
      <div class="col-md-4">
        <label for="street" class="form-label">Street</label>
        <input type="text" name="street" class="form-control" id="street" placeholder="street" required>
      </div>
      <div class="col-md-4">
        <label for="barangay" class="form-label">Barangay</label>
        <input type="text" name="barangay" class="form-control" id="barangay" placeholder="barangay" required>
      </div>

      <div class="col-md-4">
        <label for="municipality" class="form-label">Municipality</label>
        <input type="text" name="municipality" class="form-control" id="municipality" placeholder="municipality" required>
      </div>
      <div class="col-md-4">
        <label for="province" class="form-label">Province</label>
        <input type="text" name="province" class="form-control" id="province" placeholder="province" required>
      </div>
      <div class="col-md-4">
        <label for="zipcode" class="form-label">Zipcode</label>
        <input type="number" name="zipcode" class="form-control" id="zipcode" placeholder="zipcode" required>
      </div>

      <div class="col-md-4">
        <label for="guardian_name" class="form-label">Guardian Name</label>
        <input type="text" name="guardian_name" class="form-control" id="guardian_name" placeholder="guardian name" required>
      </div>

      <div class="col-md-4">
        <label for="grade_level" class="form-label">Grade Level</label>
        <select id="grade_level" name="grade_level" class="form-select">
          <option selected>Choose...</option>
          <option>Grade 7</option>
          <option>Grade 8</option>
          <option>Grade 9</option>
          <option>Grade 10</option>
          <option>Grade 11</option>
          <option>Grade 12</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="religion" class="form-label">Strand</label>
        <select id="inputState" name="religion" class="form-select">
          <option selected>Choose...</option>
          <option>ABM</option>
          <option>HUMSS</option>
          <option>STEM</option>
          <option>GAS</option>
        </select>
      </div>

      <div class="col-md-12">
        <label for="profile" class="form-label">Upload profile</label>
        <input type="file" name="profile_image" class="form-control" id="profile" placeholder="profile image" required>
      </div>
    <div class="col-12">
      <a type="submit" class="btn btn-primary" style="margin-right: 20px">Enroll Now</a>
      <a type="submit" class="btn btn-danger" href="/cancelstudentform">Cancel</a>
    </div>

  </form>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
