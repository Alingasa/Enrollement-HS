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
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
</div>
@endif
    <form id="studentform" action="{{ route('students.store') }}" class="row g-3 p-4" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-4">
          <label for="first_name" class="form-label">Firstname</label>
          <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{old('first_name') }}"  placeholder="firstname" autofocus>
        </div>
        <div class="col-md-4">
          <label for="middle_name" class="form-label">Middlename</label>
          <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" placeholder="middlename" value="{{old('middle_name') }}">
        </div>
        <div class="col-md-4">
          <label for="last_name" class="form-label">Lastname</label>
          <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="lastname" value="{{old('last_name') }}">
        </div>
    <div class="col-md-4">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" value="{{old('email') }}">
    </div>
    <div class="col-md-4">
        <label for="contact_number" class="form-label">Phone</label>
        <input type="number" name="contact_number" class="form-control @error('contact_name') is-invalid @enderror" id="contact_number" placeholder="phone no." value="{{old('contact_number') }}">
      </div>
    <div class="col-md-4">
        <label for="gender" class="form-label">Gender</label>
        <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" value="{{old('gender') }}">
          <option selected disabled>Choose...</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="birthdate" class="form-label ">Birthdate</label>
        <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" placeholder="date of birth" value="{{old('birthdate') }}">
      </div>
      <div class="col-md-4">
        <label for="civilstatus" class="form-label">Civil Status</label>
        <select id="civil_status" name="civil_status" class="form-select @error('civil_status') is-invalid @enderror" value="{{old('civil_status') }}">
          <option selected disabled>Choose...</option>
          <option value="1">Single</option>
          <option value="2">Married</option>
          <option value="3">living-together</option>
          <option value="4">Separated</option>
          <option value="5">Devorced</option>
          <option value="6">Widowed</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="religion" class="form-label">Religion</label>
        <select id="religion" name="religion" class="form-select @error('religion') is-invalid @enderror" value="{{old('religion') }}">
          <option selected disabled>Choose...</option>
          <option>Roman Catholic</option>
          <option>Muslim</option>
          <option>Widdowed</option>
          <option>Annulled</option>
        </select>
      </div>


      <div class="col-md-4">
        <label for="purok" class="form-label">Purok</label>
        <input type="text" name="purok" class="form-control @error('purok') is-invalid @enderror" id="purok" placeholder="purok" value="{{old('purok') }}">
      </div>
      <div class="col-md-4">
        <label for="sitio_street" class="form-label">Street</label>
        <input type="text" name="sitio_street" class="form-control @error('sitio_street') is-invalid @enderror" id="street" placeholder="street" value="{{old('sitio_street') }}">
      </div>
      <div class="col-md-4">
        <label for="barangay" class="form-label">Barangay</label>
        <input type="text" name="barangay" class="form-control @error('barangay') is-invalid @enderror" id="barangay" placeholder="barangay" value="{{old('barangay') }}">
      </div>

      <div class="col-md-4">
        <label for="municipality" class="form-label">Municipality</label>
        <input type="text" name="municipality" class="form-control @error('municipality') is-invalid @enderror" id="municipality" placeholder="municipality" value="{{old('municipality') }}">
      </div>
      <div class="col-md-4">
        <label for="province" class="form-label">Province</label>
        <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" id="province" placeholder="province" value="{{old('province') }}">
      </div>
      <div class="col-md-4">
        <label for="zip_code" class="form-label">Zipcode</label>
        <input type="number" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" id="zipcode" placeholder="zipcode" value="{{old('zip_code') }}">
      </div>

      <div class="col-md-4">
        <label for="guardian_name" class="form-label">Guardian Name</label>
        <input type="text" name="guardian_name" class="form-control @error('guardian_name') is-invalid @enderror" id="guardian_name" placeholder="guardian name" value="{{old('guardian_name') }}">
      </div>

      <div class="col-md-4">
        <label for="grade_level" class="form-label">Grade Level</label>
        <select id="grade_level" name="grade_level" class="form-select @error('grade_level') is-invalid @enderror" value="{{old('grade_level') }}">
          <option selected disabled>Choose...</option>
          <option value="7">Grade 7</option>
          <option value="8">Grade 8</option>
          <option value="9">Grade 9</option>
          <option value="10">Grade 10</option>
          <option value="11">Grade 11</option>
          <option value="12">Grade 12</option>
        </select>
      </div>

      <div class="col-md-4" id="stranddiv" hidden>
        <label for="strand_id" class="form-label">Strand</label>
        <select id="strand" name="strand_id" class="form-select @error('strand_id') is-invalid @enderror" value="{{old('strand_id') }}">
            <option selected disabled>--select strand--</option>
            @foreach($strand as $list)
                <option value="{{$list->id}}">{{$list->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="col-md-12">
        <label for="profile_image" class="form-label">Upload profile</label>
        <input type="file" name="profile_image" class="form-control" id="profile_image" placeholder="profile image" value="{{old('profile_image') }}">
      </div>
    <div class="col-12">
      {{-- <input type="submit" class="btn btn-primary" style="margin-right: 20px" value="Enroll Now"> --}}
      <button type="submit" class="btn btn-primary">Apply for enrollment</button>
      <a type="submit" class="btn btn-danger" href="/">Cancel</a>
    </div>

  </form>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
        document.getElementById('grade_level').addEventListener('change',function(){
                const grade_level = document.getElementById('grade_level').value;

                if(grade_level >=11){
                    document.getElementById('stranddiv').removeAttribute('hidden');
                }else{
                    document.getElementById('stranddiv').setAttribute('hidden', 'true');
                }
            })
    </script>

    </body>
</html>
