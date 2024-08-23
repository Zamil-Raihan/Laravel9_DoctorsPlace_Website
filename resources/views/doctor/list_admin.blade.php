<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors List Admin</title>
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
    <center><p style="font-size: 50px; color: rgb(202, 255, 255); font-family: Calibri;">
            <b>List of all available Doctors for admin</b>
    </p></center>

    <div class="container py-3">
        <div class="d-flex justify-content-between">
            <div> 
            <form action="{{ route('orders.order_index') }}" method="GET" class="form-inline mb-4">
              <div class="form-group mx-sm-3">
              <label for="search" class="sr-only">Search</label>
              <input type="text" class="form-control" id="search" name="search" placeholder="ID or Name or Branch or Email or Degree">
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
            </div>
            <div>
            <a href="/doctors_create" class= "btn btn-primary">Add New Doctor Information</a>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div>
            <a href="/orders" class= "btn btn-primary">View Appointment Requests</a>
            </div>
            <div>
            <a href="/home_admin" class= "btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    @if(Session::has('success'))
    <center><div class="alert alert-success" style="width:86%">
    {{Session::get('success')}}
    </div></center>
    @endif
    <center><div class= "border-2 shadow-lg"  style="width: 93%;">
        <div class="card-body">
            <table class="table table-striped" style="color:white">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Degree</th>
                    <th>Branch</th>
                    <th>Work Place</th>
                    <th>Email</th>
                    <th>For Appointment</th>
                    <th>Action </th>
                </tr>
                @if($doctors->isNotEmpty())
                @foreach($doctors as $doctor)
                <tr valign="middle">
                    <th>{{ $doctor->id }}</th>
                    <td>
                    @if($doctor->image && file_exists(public_path('uploads/doctors/' . $doctor->image)))
                        <img src="{{ url('uploads/doctors/'.$doctor->image) }}" alt="" width="60" height="60" class="rounded-circle">
                        @else
                        <img src="{{ url('uploads/no-image.png') }}" alt="" width="60" height="60" class="rounded-circle">
                       @endif
                    </td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->degree }}</td>
                    <td>{{ $doctor->branch }}</td>
                    <td>{{ $doctor->working_place }}</td>
                    <td><a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a></td> 
                    <td>{{ $doctor->call_for_serial }}</td>
                    <td>
                        <a href="{{ route('doctors.edit',$doctor->id) }}" class="btn btn-primary btn-sm">Edit</a><br>
                        <a href="#" onclick="deleteDoctor({{ $doctor->id }})" class="btn btn-danger btn-sm">Delete</a>
                        <form id="doctor-edit-action-{{ $doctor->id }}" action="{{ route('doctors.destroy',$doctor->id) }}" method="post">
                            @csrf 
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="9">Record Not Found</td></tr>
                @endif
            </table>
        </div>
    </div></center>

<br><br><br>
</body>
@include('footer')
</html>
<script>
    function deleteDoctor(id){
        if(confirm("Are you sure ?")){
            document.getElementById('doctor-edit-action-'+id).submit();
        }
    }
</script>