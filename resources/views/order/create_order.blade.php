<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for Appointment</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('bg.png'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed; 
        }
    </style>
</head>
<body>
@include('header')
<br><br>
    <center><p style="font-size: 40px; color: black; font-family: Calibri;">
            <b>Request For an Appointment</b>
    </p></center>
    <center><a href="/doctors_list" class= "btn btn-primary">Back to Doctors Page</a></center><br>

    <div class="container py-10">
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
    <div class= "card border-1 shadow-lg">
        <div class="card-body">

        

        <div class="form-row">
                <div class="col">
                    <label for="d_id" class="form-label">For Doctor's ID</label>
                    <input type="text" name="d_id" id="d_id" class="form-control" value="{{ $doctor->id }}" readonly="readonly" >
                </div>
                <div class="col">
                    <label for="d_name" class="form-label">For Doctor's Name</label>
                    <input type="text" name="d_name" id="d_name" class="form-control" value="{{ $doctor->name }}" readonly="readonly" >
                </div>
            </div><br>



          <div class="form-row">
           <div class= "col-md-4 mb-3">
            <label for="p_name" class="form-label">Patient's Name</label>
            <input type="text" name="p_name" id="p_name" placeholder="Enter Patient's Name" class="form-control @error('p_name') is-invalid @enderror" value="{{old('p_name')}}">
            @error('p_name') <p class="invalid-feedback">Name is required</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
            <label for="p_age" class="form-label">His/Her Age</label>
            <input type="text" name="p_age" id="p_age" placeholder="Age" class="form-control @error('p_age') is-invalid @enderror"  value="{{old('p_age')}}">
            @error('p_age') <p class="invalid-feedback">Age is required.</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
           <label for="exampleFormControlSelect1">Enter Gender</label>
            <input type="text" name="p_gender" id="p_gender" placeholder="Gender" class="form-control @error('p_gender') is-invalid @enderror"  value="{{old('p_gender')}}">
            @error('p_gender') <p class="invalid-feedback">Grnder is required.</p> @enderror
           </div> 
          </div>

          <div class="form-row">
           <div class= "col-md-4 mb-3">
            <label for="p_email" class="form-label">Email</label>
            <input type="text" name="p_email" id="p_email" placeholder="Enter Email" class="form-control @error('p_email') is-invalid @enderror"  value="{{old('p_email')}}">
            @error('p_email') <p class="invalid-feedback">Email is required</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
            <label for="p_num" class="form-label">Number</label>
            <input type="text" name="p_num" id="p_num" placeholder="Number" class="form-control @error('p_num') is-invalid @enderror" value="{{old('p_num')}}">
            @error('p_num') <p class="invalid-feedback">Number is required</p> @enderror
           </div>
           
           <div class= "col-md-4 mb-3">
            <label for="p_date" class="form-label">Date of Appointment</label>
            <input type="text" name="p_date" id="p_date" placeholder="Wanted Date: dd/mm/yy" class="form-control @error('p_num') is-invalid @enderror"  value="{{old('p_num')}}">
            @error('p_num') <p class="invalid-feedback">Date is required</p> @enderror
           </div> 
          </div>

           <button class="btn btn-primary mt-2">Request Appointment</button>
        </div>
    </div>
    </form></div>
<br><br><br>
</body>
@include('footer')
</html>
<script>
    $(document).ready(function () {
        $("form").submit(function (event) {
            // Iterate over each input field
            $("input").each(function () {
                // Check if the field is empty
                if ($(this).val().trim() === "") {
                    // Display an alert and prevent form submission
                    alert("Error: All Fields should be Filled up");
                    event.preventDefault();
                    return false;
                }
            });
        });
    });
</script>
