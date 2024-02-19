@extends('frontend.layout.header')

@section('main-container')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto">


						<div class="card">
							<div class="card-body">

                                @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


								<h6>Add Menu</h6>
								<hr>
								<form class="row g-2" action="{{route('menuStore')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-lg-3">

                                        <label class="form-label">Select City</label>
											<select class="single-select" name="city" id="selectCity">
												{{-- <option value="Amravati">Amravati</option>
												<option value="Akola">Akola</option>
												<option value="Nagpur">Nagpur</option> --}}

                                                <option value="">--Select--</option>
                                                @foreach ($city as $city_name)
                                                <option value="{{$city_name->id}}">{{$city_name->city}}</option>

                                                @endforeach

											</select>
									</div>
									<div class="col-lg-2">

                                        <label class="form-label">Select Restaurant</label>
											<select class="single-select" name="restaurant" id="selectRestaurant">

                                                <option value="">--Select--</option>
                                                @foreach ($restro as $restro_name)
                                                <option value="{{$restro_name->id}}">{{$restro_name->restaurant}}</option>

                                                @endforeach

											</select>
									</div>
									<div class="col-lg-2">
                                        <label class="form-label">Select Category</label>
                                        <select class="single-select" name="category">
                                            {{-- <option value="Amravati">Amravati</option>
                                            <option value="Akola">Akola</option>
                                            <option value="Nagpur">Nagpur</option> --}}

                                            <option value="">--Select--</option>
                                            @foreach ($category as $category_name)
                                            <option value="{{$category_name->id}}">{{$category_name->category}}</option>

                                            @endforeach

                                        </select>
									</div>

									<div class="col-lg-2">
										<label class="form-label">Recipe Name</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="recipe">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Price</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="price">

									</div>

                                    <div class="col-lg-1" style="margin-top: 35px;">
										<input class="form-check-input" type="checkbox" value="Veg" name="food[]" id="flexCheckDefault" >
										<label class="form-check-label" for="flexCheckDefault">Veg</label>

								</div>

								<div class="col-lg-1" style="margin-top: 35px;">
									<input class="form-check-input" type="checkbox" value="Non-Veg" name="food[]" id="flexCheckDefault1">
									<label class="form-check-label" for="flexCheckDefault1">Non-Veg</label>

							</div>

                                    <div class="col-lg-2">
										<label class="form-label">Recipe image</label>
										<input type="file" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="image">

									</div>

									<div class="col-lg-3">
										<label for="inputAddress2" class="form-label">Recipe Description</label>
										<textarea class="form-control" id="inputAddress2" placeholder=""
                                        rows="3" name="description"></textarea>
									</div>

										<div class=""  align="center">
										<button type="submit" class="btn btn-success"><i
											class="lni lni-circle-plus"></i>Submit</button>
									</div>
								</form>

							</div>

						</div>
					</div>
				</div>



				<!--end page wrapper -->
				<!--start overlay-->
				<div class="overlay toggle-icon"></div>
				<hr />
				<div class="col-md-12 mx-auto">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Sr No</th>
                                            <th>City Name</th>
											<th>Restaurant Name</th>
											<th>Category</th>
											<th>Recipe Name</th>
											<th>Price</th>
                                            <th>Veg/Non-Veg</th>
											<th>Recipe Image</th>
											<th>Recipe Description</th>
                                            <th>Status</th>
											<th style="background-color: #ffffff;">Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($menu as $menu)


										<tr>
											<td>{{$loop->index+1}}</td>
											{{-- <td>{{$restro->city_name->city}}</td> --}}
                                            {{-- <td>
                                                @if($restro->city_name)
                                                    {{ $restro->city_name->city }}
                                                @else
                                                    null
                                                @endif
                                            </td> --}}

                                            <td>
                                                {{-- {{$menu->restaurant_name->restaurant}} --}}
                                                @if($menu->city_name)
                                                {{ $menu->city_name->city}}
                                            @else
                                                null
                                            @endif</td>


											<td>
                                                {{-- {{$menu->restaurant_name->restaurant}} --}}
                                                @if($menu->restaurant_name)
                                                {{ $menu->restaurant_name->restaurant}}
                                            @else
                                                null
                                            @endif</td>

											<td>
                                                {{-- {{$menu->category_id}} --}}
                                                @if($menu->category_name)
                                                {{ $menu->category_name->category}}
                                            @else
                                                null
                                            @endif

                                            </td>
											<td>{{$menu->recipe}}</td>
											<td>{{$menu->price}}</td>
                                            <td>
                                                @if($menu->food)
                                                    @php
                                                        $decodedFood = json_decode($menu->food, true);
                                                    @endphp

                                                    @if(is_array($decodedFood))
                                                        {{ implode(', ', $decodedFood) }}
                                                    @else
                                                        {{ $menu->food }}
                                                    @endif
                                                @endif
                                            </td>
											{{-- <td>{{$menu->image}}</td> --}}

                                            {{-- <td>{{$restro->avg_cooking_time}}</td> --}}
											<td>
                                                <a href="{{asset('recipe/'. $menu->image)}}"></a>
                                                <img height="50px" width="50px"  src="{{asset('recipe/'. $menu->image)}}" alt="" />

                                                {{-- {{$restro->banner}} --}}
                                            </td>
                                            <td>{{$menu->description}}</td>

                                              {{-- active inactive button --}}
                                              <td style="background-color: #ffffff;">
                                                <div class="d-flex align-items-center">

                                                           <?php if ($menu->status=='1'){?>

                                                            <a href="{{url('/update_menu_status', $menu->id)}}"
                                                                class="btn btn-success"> Active</a>

                                                                <?php } else {?>
                                                                <a href="{{url('/update_menu_status', $menu->id)}}"
                                                                    class="btn btn-danger">Inactive</a>
                                                                    <?php
                                                            }?>
                                                            </td>

                                        {{--active inactive button end  --}}




											<td style="background-color: #ffffff;">
                                                <a href="{{route('menuEdit', $menu->id)}}">
                                                    <button type="button" class="btn1 btn-outline-success"><i
														class='bx bx-edit-alt me-0'></i></button>
                                                    </a>


                                                       {{-- <a href="{{route('menuDestroy', $menu->id)}}">
                                                            <button
                                                        type="button" class="btn1 btn-outline-danger" title="button"
                                                        onclick="confirmDelete({{ $menu->id }})"><i
                                                            class='bx bx-trash me-0'></i></button>
                                                            </a> --}}
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
		</div>



		<!--end page wrapper -->
		@endsection


        @section('js')

    {{-- to show confirmation alert message while delete --}}
    <script>
        function confirmDelete(menuId) {
            var result = confirm('Are you sure you want to delete this Menu?');
            if (!result) {
                event.preventDefault(); // Prevent the default action (deletion) if user clicks "Cancel"
            } else {
                window.location.href = '{{ url("menuDestroy") }}/' + menuId;
            }
        }
    </script>


<script>
    const toggleButton = document.getElementById('toggleButton');
toggleButton.addEventListener('click', function() {
    const currentStatus = toggleButton.getAttribute('data-status');
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    toggleButton.setAttribute('data-status', newStatus);
    toggleButton.classList.toggle('toggled', newStatus === 'active');
});
</script>




    <script>
        // Fetch restaurants based on the selected city
        document.getElementById('selectCity').addEventListener('change', function () {
            var selectedCityId = this.value;

            // Make an Ajax request to fetch related restaurants
            fetch('/getRestaurants/' + selectedCityId)
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    document.getElementById('selectRestaurant').innerHTML = '<option value="">--Select--</option>';

                    // Populate options with fetched data
                    data.forEach(restaurant => {
                        var option = document.createElement('option');
                        option.value = restaurant.id;
                        option.text = restaurant.restaurant;
                        document.getElementById('selectRestaurant').appendChild(option);
                    });
                });
        });
    </script>


@stop

