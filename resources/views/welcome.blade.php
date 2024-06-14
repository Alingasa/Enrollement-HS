<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>High School Enrollment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
        }
        .boxform {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 2rem;
            margin-top: 2rem;
            transition: transform 0.3s;
        }
        .boxform:hover {
            transform: translateY(-5px);
        }
        .form-check-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .alert {
            margin-top: 1rem;
        }
        @media (max-width: 576px) {
            .boxform {
                padding: 1.5rem;
                margin-top: 1rem;
            }
            h3 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="boxform p-5">
                    <form id="studenttypeform">
                        @if ($errors->any())
                        <div id="error-alert" class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(Session::has('error'))
                            <div id="error-alert" class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @elseif ($message = Session::get('success'))
                            <div id="success-alert" class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="align-items-center">
                            <h3 class="text-center mb-4">Please Select!</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="studentType" id="studentType1" checked>
                                <label class="form-check-label" for="studentType1">
                                  New Student
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="studentType" id="studentType2">
                                <label class="form-check-label" for="studentType2">
                                  Old Student
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="studentType" id="studentType3">
                                <label class="form-check-label" for="studentType3">
                                  Transferee
                                </label>
                            </div>
                            <input type="submit" name="proceed" id="proceed" class="btn btn-primary w-100 mt-3" value="Proceed">
                        </div>
                    </form>
                    <form id="schoolidform" action="/updatestudent" method="post" hidden>
                        @csrf
                        <div class="mb-3">
                            @if ($errors->any())
                            <div id="error-alert" class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(Session::has('error'))
                                <div id="error-alert" class="alert alert-danger" role="alert">
                                    {{ Session::get('error') }}
                                </div>
                            @elseif ($message = Session::get('success'))
                                <div id="success-alert" class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <label for="school_id" class="form-label">Enter your school ID.</label>
                                <input type="text" class="form-control @error('school_id') is-invalid @enderror" name="school_id" id="school_id" value="{{old('school_id') }}" autofocus>
                            </div>

                            <div class="col-md-12 mb-3">
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

                            <div class="col-md-12 mb-3" id="stranddiv" hidden>
                                <label for="strand_id" class="form-label">Strand</label>
                                <select id="strand" name="strand_id" class="form-select @error('strand_id') is-invalid @enderror" value="{{old('strand_id') }}">
                                    <option selected disabled>--select strand--</option>
                                    @foreach($strand as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" id="enterid" class="btn btn-primary w-100 mt-3" value="Apply for enrollment">
                                <a href="/" class="btn btn-danger w-100 mt-3">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const errorAlert = document.getElementById('error-alert');
                const successAlert = document.getElementById('success-alert');
                if (errorAlert) errorAlert.style.display = 'none';
                if (successAlert) successAlert.style.display = 'none';
            }, 3000);

            document.getElementById('enterid').addEventListener('click', function(event){
                const schoolid = document.getElementById("school_id").value;
                if(schoolid === ''){
                    alert("Please input your school ID.");
                    document.getElementById('school_id').focus();
                    event.preventDefault();
                }
            });

            document.getElementById('grade_level').addEventListener('change',function(){
                const grade_level = document.getElementById('grade_level').value;
                const strandDiv = document.getElementById('stranddiv');
                if(grade_level >= 11){
                    strandDiv.removeAttribute('hidden');
                } else {
                    strandDiv.setAttribute('hidden', 'true');
                }
            });

            document.getElementById('proceed').addEventListener('click',function(event){
                event.preventDefault();
                window.location.href = "/students";
            });

            const studentTypeForm = document.getElementById('studenttypeform');
            const hiddenForm = document.getElementById('schoolidform');
            const studentType2 = document.getElementById('studentType2');

            function toggleForms() {
                if (studentType2.checked) {
                    hiddenForm.removeAttribute('hidden');
                    studentTypeForm.setAttribute('hidden', true);
                } else {
                    hiddenForm.setAttribute('hidden', true);
                    studentTypeForm.removeAttribute('hidden');
                }
            }

            studentTypeForm.addEventListener('change', toggleForms);
            toggleForms();
        });
    </script>
</body>
</html>
