<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSRF Token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--Bootstrap-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!--Data table-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<br><br>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="card">
				<h5 class="card-header">
					<button type="button" class="btn btn-success" id="open_add_product_modal">Add Item</button>
				</h5>
				<div class="card-body">
					<table class="table table-bordered table-hover" id="myTable" style="table-layout: fixed;">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Description</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Image</th>
								<th>Date created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($items as $item)
							<tr>
								<td>{{ $item->id }}</td>
								<td>{{ $item->nameofitem }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->quantity }}</td>
								<td>{{ $item->price }}</td>
								<td>{{ $item->image }}</td>
								<td>{{ $item->created_at }}</td>
								<td><a href="#" class="btn btn-primary edtbtn">Edit</a>
									<a href="#" class="btn btn-primary" onclick="window.location='{{ url("/admin_page/$item->id") }}'">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>
</body>
</html>

<!--------------------------------ADD ITEM MODAL-------------------------------->
  <div class="modal fade" id="add_item_modal" role="dialog">
    <div class="modal-dialog">
      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5>Add new Item</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<form enctype="multipart/form-data" id="insert_data">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="text" class="form-control" name="nameofitem" id="nameofitem" placeholder="Name of Item.."/>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity.."/>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="price" id="price" placeholder="Price.."/>
							</div>
							<div class="form-group custom-file mt-3 mb-3"> 
								<input type="file" name="image" id="image"/>
							</div>
							<div class="form-group">
								<textarea class="form-control" name="description" id="description" placeholder="Description.."></textarea>
							</div>
							<button type="submit" id="add_item" class="btn btn-primary" style="float:right">Add Item</button>
						</form><br><br>
					</div>
				</div>
			</div>
        </div>
      </div>  
    </div>
  </div>
<!--------------------------------EDIT ITEM MODAL-------------------------------->
  <div class="modal fade" id="edit_item_modal" role="dialog">
    <div class="modal-dialog">
      <!--Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5>Edit Item</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<form role="form" enctype="multipart/form-data" id="form_insert_item">
							@csrf
							<div class="form-group" hidden>
								<label>ID:</label>
								<input type="text" class="form-control" name="edt_id" id="edt_id"/>
							</div>
							<div class="form-group">
								<label>Name of Item:</label>
								<input type="text" class="form-control" name="edt_nameofitem" id="edt_nameofitem"/>
							</div>
							<div class="form-group">
								<label>Description:</label>
								<textarea class="form-control" name="edt_description" id="edt_description"></textarea>
							</div>
							<div class="form-group">
								<label>Quantity:</label>
								<input type="text" class="form-control" name="edt_quantity" id="edt_quantity"/>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="text" class="form-control" name="edt_price" id="edt_price"/>
							</div>
								<div class="form-group custom-file mt-3 mb-3"> 
								<input type="file" name="image" id="image"/>
							</div>
							<button type="submit" id="edt_item" class="btn btn-primary" style="float:right">Update</button>
						</form><br><br>
					</div>
				</div>
			</div>
        </div>
      </div>  
    </div>
  </div>
<!------------------------------------------------------------------------------->



<script>
$(document).ready(function(){
	//OPEN INSERT ITEM MODAL..
	$('#open_add_product_modal').on('click', function(){
		$('#add_item_modal').modal('show'); 
	});

   	//INSERT ITEM..
	$('#insert_data').submit(function(){
		CKEDITOR.instances['description'].updateElement();
		let formData = new FormData(this);

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           type:'POST',
           url:'/admin_page/add_item',
           data: formData,
           cache: false,
           contentType: false,
           processData: false,
           success:function(data){
           }
        });
	});

	//RETRIEVING DATA FROM TABLE..
	$('.edtbtn').on('click', function(){
		$('#edit_item_modal').modal('show');

		let tr = $(this).closest('tr');

		let data = tr.children("td").map(function(){
			return $(this).text();
		}).get();

		$('#edt_id').val(data[0]);
		$('#edt_nameofitem').val(data[1]);
		$('#edt_description').val(data[2]);
		$('#edt_quantity').val(data[3]);
		$('#edt_price').val(data[4]);
	});

	//UPDATE ITEM..
	$("#edt_item").click(function(){

		let id = $("#edt_id").val();
		let nameofitem = $("#edt_nameofitem").val();
	    let description = $("#edt_description").val();
	    let quantity = $("#edt_quantity").val();
	    let price = $("#edt_price").val();

	    $.ajaxSetup({
	    		headers: {
	        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		}
		});

		$.ajax({
	           type:'POST',
	           url:'/admin_page/update_item',
	           data:{
	           		id,
	           		nameofitem,
	           		description, 
	           		quantity,
	           		price
	           	},
	           success:function(data){
	             // location.reload(true);
	           }
	    });
	});

	//DATA TABLE..
	$(document).ready(function(){
        $('#myTable').DataTable();  
    });

});
</script>
<!--CKEDITOR-->
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>CKEDITOR.replace('description');</script>


