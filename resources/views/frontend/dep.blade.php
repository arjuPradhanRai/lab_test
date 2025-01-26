<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

</head>

<body>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="">
        <div>
            <form action="{{route('store.dep')}}" method="post">
                @csrf
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </div>

</div>

    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title text-left mb-4" >
                        <button type="button" id="addNew" class="btn btn-primary" >
                            +Add
                        </button>
                        
                        </h4>
                        <table class="table" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody id="showTestTable">
                                @foreach ($departments as $key => $data)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$data->dep_name}}</td>
                                    <td><button id="delete" data-id="{{$data->id}}"><i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </button></td>
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
<!-- to show filter result of test  -->
<!-- to add more test -->
<script>
$('#addNew').click(function() {
var modal = document.getElementById("myModal");

      modal.style.display = "block";
});
</script>
<script>
$('#delete').click(function() {
    var id = $(this).attr("data-id") ;
   console.log(id); 
   $.ajax({
            type: "POST",
            url: "{{ route('delete-dep') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                    

            },
            
        });
});
</script>
</html>