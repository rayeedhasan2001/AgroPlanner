<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        table {
            border: 2px solid skyblue;
            text-align: center;
        }
        th {
            background-color: skyblue;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        td {
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="table_center">
                    <table>
                        <tr>
                            <th>Customer name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Change Status</th>
                        </tr>

                        @foreach($data as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->rec_address}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->product->title}}</td>
                            <td>{{$data->product->price}}</td>
                            <td>
                                <img width="150" src="products/{{$data->product->image}}">
                            </td>
                            <td>{{$data->status}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url('on_the_way', $data->id) }}">On the way</a>

                                <!-- Updated this to use $data->id instead of $order->id -->
                                <a class="btn btn-success" href="{{ url('Delivered', $data->id) }}" onclick="return confirm('Are you sure you want to mark this order as delivered and remove it from the list?')">Delivered</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>  
        </div>
    </div>

    <!-- JavaScript files-->
    <script src="admincss/vendor/jquery/jquery.min.js"></script>
    <script src="admincss/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admincss/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="admincss/vendor/chart.js/Chart.min.js"></script>
    <script src="admincss/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admincss/js/charts-home.js"></script>
    <script src="admincss/js/front.js"></script>
  </body>
</html>