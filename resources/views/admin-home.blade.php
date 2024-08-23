<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body background="bg.png">
@include('header')
    <br><br><br><br><br><br><br>
    <center><p style="font-size: 70px; color: rgb(202, 255, 255); font-family: Calibri;">
            <b>Welcome to admin dashboard</b>
    </p></center>
    <div class="container py-7" style="width: 60%;">
        <div class="d-flex justify-content-between">
            <div> 
            <a href="/doctors" class= "btn btn-primary">View All Doctor Information</a>
            </div>
            <div>
            <a href="/doctors_create" class= "btn btn-primary">Add New Doctor Information</a>
            </div>
        </div> 
        <br><br>
        <div class="d-flex justify-content-between">
            <div> 
            <a href="/orders" class= "btn btn-primary">View Appointment Requests</a>
            </div>
            <div>

            </div>
        </div>
        
    </div>
</body>
@include('footer')
</html>