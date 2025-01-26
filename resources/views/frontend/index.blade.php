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
            <form action="{{route('store.test')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Department</label>
                    <select id="depId2" name="depId" class="form-control select2bs4" style="width: 100%;">
                                            <option value="" disabled {{ request('booth_no') ? '' : 'selected' }}>Select Booth No</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">
                                                {{ $department->dep_name }}
                                            </option>
                                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Short</label>
                    <input type="text" name="short" class="form-control" id="exampleInputPassword1" placeholder="Short">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </div>

</div>
<div id="editModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="">
        <div>
            <form action="{{route('update.test')}}" method="post">
                @csrf
                <input type="hidden" name="id" id="editId">
                
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" id="edit_name" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Short</label>
                    <input type="text" id="short_name" name="short" class="form-control" id="exampleInputPassword1" placeholder="Short">
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
                        <!-- <h4 class="card-title text-center mb-4">Filter</h4> -->
                        <form >
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Department Name</label>
                                        <select id="depId" class="form-control select2bs4" style="width: 100%;">
                                            <option value="" disabled {{ request('booth_no') ? '' : 'selected' }}>Select Booth No</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">
                                                {{ $department->dep_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mt-2 d-flex align-items-center">
                                        <button id="showResult" type="button" class="btn btn-primary me-2 mt-4">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                    <th scope="col">short</th>
                                    <th scope="col">sampletype</th>
                                    <th scope="col">precaution</th>
                                    <th scope="col">price</th>
                                    <th scope="col">doc_name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="showTestTable">
                                @foreach ($datas as $key => $data)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->short}}</td>
                                    <td>{{$data->sampletype}}</td>
                                    <td>{{$data->precaution}}</td>
                                    <td>{{$data->price}}</td>
                                    <td>{{$data->doc_name}}</td>
                                    <td>
                                        <div>
                                            <button><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                            <button id="edit" data-id="{{$data->id}}"><i class="fa fa-edit text-success" aria-hidden="true"></i></button>
                                        </div>
                                    </td>
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
<script>
    $('#showResult').click(function() {
    var depId = $('#depId').val();
    console.log(depId);
    if (depId) {
        $.ajax({
            type: "POST",
            url: "{{ route('filter') }}",
            data: {
                _token: '{{ csrf_token() }}',
                depId: depId,
            },
            beforeSend: function() {
                // Optional: Add a spinner or disable button
                $('#showResult').attr('disabled', true).text('Loading...');
            },
            success: function(response) {
                if (response.success) {
                    // Clear the table body first
                    $('#showTestTable').empty();
                    // Append new rows to the table
                    let winnersData = response.data; // Adjust according to your actual JSON structure
                    if (winnersData && winnersData.length > 0) {
                        winnersData.forEach((winner, index) => {
                            
                            let row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${winner.name || '-'}</td>
                                    <td>${winner.short || '-'}</td>
                                    <td>${winner.sampletype || '-'}</td>
                                    <td>${winner.precaution || '-'}</td>
                                    <td>${winner.price || '-'}</td>
                                    <td>${winner.doc_name || '-'}</td>
                                </tr>
                            `;
                            $('#showTestTable').append(row);
                        });
                    } else {
                        let noDataRow = `
                            <tr>
                                <td colspan="9" class="text-center">No Winners Found</td>
                            </tr>
                        `;
                        $('#showTestTable').append(noDataRow);
                    }
                
                } else {
                    
                }
            },
            error: function(xhr, status, error) {
                    

            },
            complete: function() {
                // Reset the button state
                $('#showResult').attr('disabled', false).text('Show Result');
            }
        });
    } else {
            
    }
});

  
</script>
<!-- to add more test -->
<script>
$('#addNew').click(function() {
var modal = document.getElementById("myModal");

    console.log('hhh');
      modal.style.display = "block";
});
</script>
<script>
$('#edit').click(function() {
    var id = $(this).attr("data-id") ;
   
   $.ajax({
            type: "POST",
            url: "{{ route('edit-test') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            
            success: function(response) {
                
                $('#edit_name').val(response.data.name) ;
                $('#short_name').val(response.data.short) ;
                $('#editId').val(response.data.id) ;
                var modal = document.getElementById("editModal");

                modal.style.display = "block";
            },
            error: function(xhr, status, error) {
                    

            },
            
        });
});
</script>
</html>