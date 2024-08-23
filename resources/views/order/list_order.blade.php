<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Order</title>
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
            <b>List of all orders to appointment</b>
    </p></center>

    <div class="container py-3">
        <div class="d-flex justify-content-between">
            <div> 
            <form action="{{ route('doctors.index') }}" method="GET" class="form-inline mb-4">
              <div class="form-group mx-sm-3">
              <label for="search" class="sr-only">Search</label>
              <input type="text" class="form-control" id="search" name="search" placeholder="ID or Name or Email">
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
            </div>
            <div> 
            <a href="/doctors" class= "btn btn-primary">View All Doctor Information</a>
            </div>
            <div>
            <a href="/home_admin" class= "btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    @if(Session::has('success'))
    <center><div class="alert alert-success" style="width:60%">
    {{Session::get('success')}}
    </div></center>
    @endif

    <center><div class= "border-2 shadow-lg"  style="width: 90%;">
        <div class="card-body">
            <table class="table table-striped" style="color:white">
                <tr>
                    <th>ID</th>
                    <th>Doc ID</th>
                    <th>Doc Name</th>
                    <th>Submitted Time</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Requested Date</th>
                    <th>Action </th>
                </tr>
                @if($orders->isNotEmpty())
                @foreach($orders as $order)
                <tr valign="middle">
                    <th>{{ $order->id }}</th>
                    <td>{{ $order->d_id }}</td>
                    <td>{{ $order->d_name }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->p_name }}</td>
                    <td>{{ $order->p_age }}</td>
                    <td>{{ $order->p_gender }}</td>
                    <td><a href="mailto:{{ $order->p_email }}">{{ $order->p_email }}</a></td>
                    <td>{{ $order->p_num }}</td>
                    <td>{{ $order->p_date }}</td>
                    <td><a href="#" onclick="deleteOrder({{ $order->id }})" class="btn btn-danger btn-sm">Delete</a>
                        <form id="order-edit-action-{{ $order->id }}" action="{{ route('orders.destroy',$order->id) }}" method="post">
                            @csrf 
                            @method('delete')
                        </form>
                    </td>
                    </td>
                </tr>
                @endforeach
                @else
                <tr><td colspan="11">Record Not Found</td></tr>
                @endif
            </table>
        </div>
    </div></center>

<br><br><br>
</body>
@include('footer')
</html>
<script>
    function deleteOrder(id){
        if(confirm("Are you sure ?")){
            document.getElementById('order-edit-action-'+id).submit();
        }
    }
</script>