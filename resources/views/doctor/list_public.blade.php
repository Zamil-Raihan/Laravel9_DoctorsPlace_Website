<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors List</title>
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
    <div class="container py-3">
        <div class="d-flex justify-content-between">
            <div> 
                <p style="font-size: 50px; color: rgb(202, 255, 255); font-family: Calibri;">
                   <b>List of all available Doctors</b>
                </p>
            </div>
            <div><br>
                <form action="{{ route('doctors.index_public') }}" method="GET" class="form-inline mb-4">
                <div class="form-group mx-sm-3">
                   <label for="search" class="sr-only">Search</label>
                   <input type="text" class="form-control" id="search" name="search" placeholder="Search by Name or Branch">
                </div>
                   <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
    <center><div class="alert alert-success" style="width:86%">
    {{Session::get('success')}}
    </div></center>
    @endif
    <center>
        <div class="d-flex flex-wrap justify-content-center align-items-center mt-4">
            @foreach($doctors as $doctor)
            @if(empty($search) || stripos($doctor->name, $search) !== false || stripos($doctor->branch, $search) !== false)
            <div class="card m-5" style="width: 20rem; height: 550px;">
                @if($doctor->image && file_exists(public_path('uploads/doctors/' . $doctor->image)))
                <img src="{{ url('uploads/doctors/'.$doctor->image) }}" alt="" class="card-img-top" width="240" height="320">
                @else
                <img src="{{ url('uploads/no-image.png') }}" alt="" class="card-img-top" width="240" height="320">
                @endif
                <div class="card-body">
                    <h5 class="card-title"><b>Dr. {{ $doctor->name }}</b></h5>
                    <p class="card-text"><b>Degree: </b>{{ $doctor->degree }}</p>
                    <p class="card-text"><b>Branch: </b>{{ $doctor->branch }}</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#doctorModal{{ $doctor->id }}">
                        View Details
                    </button>
                </div>
            </div>

            <div class="modal fade" id="doctorModal{{ $doctor->id }}"   >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Dr. {{ $doctor->name }}</b></h5>
                        </div>
                        <div class="modal-body">
                            <p><b>Degree: </b>{{ $doctor->degree }}</p>
                            <p><b>Branch: </b>{{ $doctor->branch }}</p>
                            <p><b>Work Place: </b>{{ $doctor->working_place }}</p>
                            <p><b>Email: </b><a href="malio:{{ $doctor->email }}">{{ $doctor->email }}</a></p>
                            <p><b>For Appointment: </b>Call {{ $doctor->call_for_serial }}</p>
                            or  <a href="{{ route('orders.create', ['doctor_id' => $doctor->id]) }}" class="btn btn-primary btn-sm">Book Appointment</a><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
           
            @else
            <div class="alert alert-warning" role="alert">
                Record Not Found
            </div>
            @endif
            @endforeach
        </div>
    </center>

    <br><br><br>
    @include('footer')
</body>
</html>