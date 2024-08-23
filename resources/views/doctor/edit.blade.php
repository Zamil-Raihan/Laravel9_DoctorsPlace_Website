<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Info</title>
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
    <center><p style="font-size: 50px; font-family: Calibri;">
            <b>Edit a doctor's Information</b>
    </p></center>
    <center><a href="/doctors" class= "btn btn-primary">Back to Doctor List for Admin</a></center><br>

    <div class="container py-6">
    <form action="{{route('doctors.update',$doctor->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    <div class= "card border-1 shadow-lg">
        <div class="card-body">
        
           <div class= "mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$doctor->name)}}">
            @error('name') <p class="invalid-feedback">{{$message}}</p> @enderror
           </div> 

           <div class="form-row">
           <div class= "col-md-4 mb-3">
            <label for="degree" class="form-label">Degree</label>
            <input type="text" name="degree" id="degree" placeholder="Enter Degree" class="form-control @error('degree') is-invalid @enderror"  value="{{old('degree',$doctor->degree)}}">
            @error('degree') <p class="invalid-feedback">{{$message}}</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
            <label for="branch" class="form-label">Branch</label>
            <input type="text" name="branch" id="branch" placeholder="Enter Branch" class="form-control @error('branch') is-invalid @enderror"  value="{{old('branch',$doctor->branch)}}">
            @error('branch') <p class="invalid-feedback">{{$message}}</p> @enderror
           </div> 

           <div class= "col-md-4 mb-3">
            <label for="working_place" class="form-label">His/Her Work Place</label>
            <input type="text" name="working_place" id="working_place" placeholder="Enter the place he/she is working" class="form-control @error('working_place') is-invalid @enderror"  value="{{old('working_place',$doctor->working_place)}}">
            @error('working_place') <p class="invalid-feedback">{{$message}}</p> @enderror
           </div> 
           </div>
           
           <div class="form-row">
           <div class= "col">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$doctor->email)}}">
            @error('email') <p class="invalid-feedback">{{$message}}</p> @enderror
           </div> 

           <div class= "col">
            <label for="call_for_serial" class="form-label">Contact number for appointment</label>
            <input type="text" name="call_for_serial" id="call_for_serial" placeholder="Enter contact number to make an appointment" class="form-control @error('call_for_serial') is-invalid @enderror"  value="{{old('call_for_serial',$doctor->call_for_serial)}}">
            @error('call_for_serial') <p class="invalid-feedback">{{$message}}</p> @enderror
           </div> 
           </div>

           <div class= "mb-3">
            <label for="image" class="form-label">Add Photo (Required format: jpeg, jpg, png, bmp)</label><br>
            <input type="file" name="image" class="@error('image') is-invalid @enderror">
            @error('image') <p class="invalid-feedback">{{$message}}</p> @enderror <br><br>
            @if($doctor->image && file_exists(public_path('uploads/doctors/' . $doctor->image)))
                <img src="{{ url('uploads/doctors/'.$doctor->image) }}" alt="" width="100" height="100">
            @endif
           </div> 
           <button class="btn btn-primary mt-2">Update Doctor's Information</button>
        </div>
    </div>
    </form></div>


<br><br><br>
@include('footer')
</body>
</html>