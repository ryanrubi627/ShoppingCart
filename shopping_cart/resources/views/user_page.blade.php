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
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a class="navbar-brand" onclick="window.location='{{ url("/cart_page") }}'">My Cart</a>
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

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div class="carousel slide" id="carousel-300325">
				<ol class="carousel-indicators">
					<li data-slide-to="0" data-target="#carousel-300325" class="active"></li>
					<li data-slide-to="1" data-target="#carousel-300325"></li>
					<li data-slide-to="2" data-target="#carousel-300325"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" alt="Carousel Bootstrap First" src="shadowfiend.jpg" />
						<div class="carousel-caption">
							<h4>First Thumbnail label</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" alt="Carousel Bootstrap Second" src="mirana.jpg" />
						<div class="carousel-caption">
							<h4>Second Thumbnail label</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" alt="Carousel Bootstrap Third" src="invoker.jpg" />
						<div class="carousel-caption">
							<h4>Third Thumbnail label</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
				</div> <a class="carousel-control-prev" href="#carousel-300325" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-300325" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>
<br><br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div class="row">
				@foreach($items as $item)
				<div class="col-md-4">
					<div class="card">
						<img class="card-img-top" alt="Bootstrap Thumbnail First" src="/images/{{ $item->image }}" id="{{ $item->id }}">
						<div class="card-block" style="margin:20px">
							<center>
								<h5 hidden>{{ $item->id }}</h5>
								<h5 class="card-title">{{ $item->nameofitem }}</h5>
								<p>{{ $item->quantity }}&nbsp pcs available</p>
								<h5 style="color:rgb(242,103,49);">{{ $item->price }} PHP</h5>
								<button type="button" class="btn btn-primary buy_item" id="{{ $item->id }}" hidden>Buy Now</button>
								<button type="button" class="btn btn-primary cart_item" id="{{ $item->id }}">Add to Cart</button>
							</center>
						</div>
					</div>
				</div>
				@endforeach
		<div class="col-md-2">
		</div>
	</div>
</div>
<br><br>
</body>
</html>


<!--------------------------------BUY ITEM MODAL-------------------------------->
<div class="modal fade" id="buy_item_modal" name="buy_item_modal" role="dialog">
	<div class="modal-dialog">
	  <!--Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 id="h1"></h5>
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	    </div>
	    <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					<div class="card">
						<img class="card-img-top img_item" alt="Bootstrap Thumbnail First">
						<div class="card-block" style="margin:20px">
							<center><input type="text" name="item_id" id="item_id" hidden>
							<i id="i1"></i><br><br></center>
							<hr>
							<input type="number" class="form-control prc" id="item_quantity" maxlength="2" hidden/>
							Quantity:<input type="number" class="form-control prc" id="quantity" maxlength="2"/>
							Price:<input type="number" class="form-control prc" id="item_price" disabled/>
							Total:<input type="number" class="form-control prc" id="item_result" disabled/><br>
							<button type="button" style="float:right;"class="btn btn-primary" id="buy_item">Buy Now</button>
						</div>
					</div>
					</div>
				</div>
			</div>
	    </div>
	  </div>  
	</div>
</div>
<!--------------------------------CART ITEM MODAL-------------------------------->
<div class="modal fade" id="cart_item_modal" name="cart_item_modal" role="dialog">
	<div class="modal-dialog">
	  <!--Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	    </div>
	    <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<form form enctype="multipart/form-data" id="insert_cart_data">
								{{ csrf_field() }}
								<img class="card-img-top img_cart_item" alt="Bootstrap Thumbnail First">
								<div class="card-block" style="margin:20px">
									<center>
										<h5 id="h2" name="h2"></h5>
										<input type="text" name="item_cart_id" id="item_cart_id" hidden/>
										<i id="i2" name="i2"></i><br><br>
										<p id="item_cart_quantity" name="item_cart_quantity" hidden></p>
										<p id="item_cart_quantity2" name="item_cart_quantity2" ></p>
										<h5 style="color:rgb(242,103,49);" id="item_cart_price" name="item_cart_price" hidden></h5>
										<h5 style="color:rgb(242,103,49);" id="item_cart_price2" name="item_cart_price2"></h5>
										<button type="button" class="btn btn-primary" id="cart_item" name="cart_item">Add to Cart</button>
									</center>
								</div>
							</form>
						</div>
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

	//FETCH DATA TO MODAL..
	$('.buy_item').on('click', function(){
		let id = this.id;

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           type:'get',
           url:'/user_page/item_id',
           data:{
                id:id
            },
           success:function(data){
           		$('#h1').text(data.nameofitem);
           		$('#item_id').val(data.id);
           		$('#i1').text(data.description);
           		$('#item_quantity').val(data.quantity);
           		$('#item_price').val(data.price);
           		$(".img_item").attr('src', '/images/'+data.image); 
           		$('#buy_item_modal').modal('show');
           }

        });
	});


	//COMPUTATION OF QUANTITY & PRICE..
	function calc(){
		let quantity = $('#quantity').val();
		let item_price = $('#item_price').val();

		let result = quantity * item_price;
		let item_result = $('#item_result').val(result);
	}
	$(".prc").keyup(function() {
        calc();
    });

    $('#buy_item').on('click', function(){
    	let id = $('#item_id').val();
		let item_quantity = $('#item_quantity').val();
		let quantity = $('#quantity').val();

		let result_quantity = item_quantity - quantity;

		if(item_quantity == quantity || item_quantity >=quantity){
			alert('Successfully purchase this item');
		}else {
			alert('Out of stock');
			return false;
		}

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           type:'post',
           url:'/user_page/quantity_update',
           data:{
           		id:id,
           		result_quantity:result_quantity
           },
           success:function(){
           		$('#buy_item_modal').modal('hide');
	        	location.reload(true);
	        }
		});
	});


    //FETCH DATA TO MODAL CART..
	$('.cart_item').on('click', function(){
		let id = this.id;

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           type:'get',
           url:'/user_page/item_cart_id',
           data:{
                id:id
            },
           success:function(data){
           		$('#h2').text(data.nameofitem);
           		$('#item_cart_id').val(data.id);
           		$('#i2').text(data.description);
           		$('#item_cart_quantity').text(data.quantity);
           		$('#item_cart_quantity2').text(data.quantity+' pcs available');
           		$('#item_cart_price').text(data.price);
           		$('#item_cart_price2').text(data.price+' PHP');
           		$(".img_cart_item").attr('src', '/images/'+data.image); 
           		$('#cart_item_modal').modal('show');
           }

        });
	});


	//INSERT ITEM TO CART..
	$('#cart_item').on('click', function(){

		let id = $('#item_cart_id').val();
		let name = $('#h2').text();
   		let description = $('#i2').text();
   		let quantity = $('#item_cart_quantity').text();
   		let price = $('#item_cart_price').text();

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           type:'POST',
           url:'/cart_page/add_cart_item',
	       data: {
	       		id,
	       		name,
	       		description,
	       		quantity,
	       		price
	       },
           success:function(data){
           	alert('Add to Cart Successfully');
           	$('#cart_item_modal').modal('hide');
           }
        });
	});

});
</script>