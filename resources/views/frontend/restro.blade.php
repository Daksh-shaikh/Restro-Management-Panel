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

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


								<h6>Add Restaurant</h6>
								<hr>
								<form class="row g-2" action="{{route('restroStore')}}" method="post" enctype="multipart/form-data">
                                    @csrf



                                     <div class="col-lg-3">

                                        <label class="form-label">Select City</label>
											<select class="single-select" name="city">

                                                <option value="">--Select--</option>
                                                @foreach ($city as $city_name)
                                                <option value="{{$city_name->id}}">{{$city_name->city}}</option>

                                                @endforeach

											</select>
									</div>

                                    {{-- <div class="col-lg-2">

                                        <label class="form-label">Select City</label>


                                                <input type="text" class="form-control" id="city" name="city"
                                                placeholder="" autocomplete="on" required>


									</div> --}}



									<div class="col-lg-2">
										<label class="form-label">Restaurant Name</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="restaurant">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Address</label>
										<input type="text" class="form-control" id="address"
											aria-describedby="emailHelp" placeholder="" name="address" autocomplete="on" required>

									</div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Latitude</label>

                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                    readonly required>

                                    </div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Longitude</label>

                                               <input type="text" class="form-control" id="longitude" name="longitude"
                                               readonly required>
                                    </div>


									<div class="col-lg-2">
										<label class="form-label">Contact Person</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="contact_person">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Mobile No</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="mobilenumber">

									</div>

									<div class="col-lg-2">
                                        <label class="form-label">Email / Username </label>
                                        <input type="text" class="form-control" name="email" value="">
                                    </div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" value="">
                                    </div>

                                    <div class="col-lg-2">
										<label class="form-label">Avg Cooking Time</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="avg_cooking_time">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Upload Banner</label>
										<input type="file" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="banner">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Select Category</label>
										<select class="multiple-select" multiple="multiple" name="category[]" multiple>

                                            @foreach ($category as $category_name)
                                            <option value="{{$category_name->id}}">{{$category_name->category}}</option>

                                            @endforeach



										</select>
								</div>
								<div class="col-lg-1" style="margin-top: 35px;">
										<input class="form-check-input" type="checkbox" value="Veg" name="food[]" id="flexCheckDefault" >
										<label class="form-check-label" for="flexCheckDefault">Veg</label>

								</div>

								<div class="col-lg-1" style="margin-top: 35px;">
									<input class="form-check-input" type="checkbox" value="Non-Veg" name="food[]" id="flexCheckDefault1">
									<label class="form-check-label" for="flexCheckDefault1">Non-Veg</label>

							</div>

							<div class="col-lg-3">
								<label for="inputAddress2" class="form-label">Restaurant Details</label>
								<textarea class="form-control" id="inputAddress2" placeholder="" rows="3" name="details"></textarea>
							</div>
<div></div>
<div></div>
                            <div>
                            <h6>Add Delivery Slots & Timing</h6>
<hr>
<div class="row">
    @foreach ($days as $day)
        <div class="col-lg-2">
            <label class="form-label">{{ $day->days }}</label>
            <input type="hidden" name="days[]" value="{{ $day->id }}">

            {{-- onchange for checkbox --}}
            <div>
                <input type="checkbox" name="is_close_{{ $day->id }}" id="is_close_{{ $day->id }}" style="width: 15px; height: 15px; border: 2px solid #333;" onchange="toggleTimeFields('{{ $day->id }}')">
                <label class="form-check-label" for="is_close_{{ $day->id }}" style="margin-left: 10px">Closed</label>
            </div>
        </div>

        <div class="col-lg-2" id="openCloseFields_{{ $day->id }}">
            <div style="position: relative; margin-top:15px">
                <label for="open_at_{{ $day->id }}" class="form-label" style="position: absolute; top: -10px; left: 5px; background-color: white; padding: 0 5px;">Open at</label>
                <input type="time" name="open_at_{{ $day->id }}" id="open_at_{{ $day->id }}" class="form-control" style="height: 50px;" value="10:00">
            </div>
        </div>

        <div class="col-lg-2" id="closeAtFields_{{ $day->id }}">
            <div style="position: relative; margin-left: 10px; margin-top:15px">
                <label for="close_at_{{ $day->id }}"  class="form-label" style="position: absolute; top: -10px; left: 5px; background-color: white; padding: 0 5px;">Close at</label>
                <input type="time" name="close_at_{{ $day->id }}" id="close_at_{{ $day->id }}" class="form-control" style="height: 50px;" value="22:00">
            </div>
        </div>
        <div></div>
    @endforeach
</div>


                            </div>

                            <div></div>
                            <div></div>


									<div class=""  align="center" style="margin-top: 20px">
										<button type="submit" class="btn btn-success">
                                            <i
											class="lni lni-circle-plus"></i>
                                            Submit</button>
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
                                            <th>City</th>
											<th>Restaurant Name</th>
                                            <th>Address</th>
											<th>Contact Person</th>
											<th>Mobile</th>
											<th>Email / Username</th>
                                            {{-- <th>Password</th> --}}
                                            <th>Average Cooking Time</th>
											<th>Banner</th>
											<th>Category</th>
											<th>Veg/Non-Veg</th>
                                            <th>Latitude</th>
											<th>Longitude</th>
											{{-- <th>GST</th> --}}
											<th>Restaurant Details</th>
                                            {{-- <th>Delivery Slots & Timing</th> --}}
                                            <th>Login</th>
                                            <th>Status</th>

											<th style="background-color: #ffffff;">Action</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($restro as $restro)


										<tr>
											<td>{{$loop->index+1}}</td>

                                            <td>
                                                @if($restro->city_name)
                                                  {{ $restro->city_name->city}}
                                              @else
                                                  null
                                              @endif
                                              </td>
											<td>{{$restro->restaurant}}</td>
                                            <td style="width: 500px !important">{{$restro->address}}</td>
											<td>{{$restro->contact_person}}</td>
											<td>{{$restro->mobilenumber}}</td>
											<td>{{$restro->email}}</td>
                                            {{-- <td>{{$restro->password}}</td> --}}
                                            <td>{{$restro->avg_cooking_time}}</td>
											<td>
                                                <a href="{{asset('banner/'. $restro->banner)}}"></a>
                                                <img height="50px" width="50px"  src="{{asset('banner/'. $restro->banner)}}" alt="" />


                                            </td>

                                            <td>
                                                @forelse ($restro->category_name as $category)
                                                    {{ $category->category }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @empty
                                                    No categories
                                                @endforelse
                                            </td>

                                                <td>
                                                    @if($restro->food)
                                                        @php
                                                            $decodedFood = json_decode($restro->food, true);
                                                        @endphp

                                                        @if(is_array($decodedFood))
                                                            {{ implode(', ', $decodedFood) }}
                                                        @else
                                                            {{ $restro->food }}
                                                        @endif
                                                    @endif
                                                </td>

                                            </td>

                                            <td>{{$restro->latitude}}</td>
											<td>{{$restro->longitude}}</td>
											<td>{{$restro->details}}</td>
                                            {{-- <td style="background-color: #ffffff;">

                                                <a href="{{ route('view') }}">View</a>
                                            </td> --}}

                                            <td style="background-color: #ffffff;">

                                                <a href="{{ route('login', ['email' => $restro->email]) }}">Login</a>
                                            </td>

                                            {{-- active inactive button --}}
                                                    <td style="background-color: #ffffff;">
                                                        <div class="d-flex align-items-center">

                                                                   <?php if ($restro->status=='1'){?>

                                                                    <a href="{{url('/update_status', $restro->id)}}"
                                                                        class="btn btn-success"> Active</a>

                                                                        <?php } else {?>
                                                                        <a href="{{url('/update_status', $restro->id)}}"
                                                                            class="btn btn-danger">Inactive</a>
                                                                            <?php
                                                                    }?>
                                                                    </td>

                                                {{--active inactive button end  --}}

                                                                    <td>
                                                            <div class="ms-2">
                                                                <a href="{{route('restroEdit', $restro->id)}}">
                                                                    <button type="button" class="btn1 btn-outline-success"><i
                                                                        class='bx bx-edit-alt me-0'></i></button></a>

                                                                                                                               </div>
                                                        </div>
                                                    </div>
                                                    </td>


                                                        {{-- <a href="{{route('restroDestroy', $restro->id)}}">
                                                            <button
                                                        type="button" class="btn1 btn-outline-danger" title="button"
                                                        onclick="confirmDelete({{ $restro->id }})"><i
                                                            class='bx bx-trash me-0'></i></button>
                                                            </a> --}}

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


        @endsection

        @section('js')

<script>
    // Load the Google Maps API with the Places library
    function initAutocomplete() {
        const autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));

        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();

            if (!place.geometry) {
                console.error('Place not found: ', place);
                return;
            }

            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });
    }

    // jQuery document ready function
    $(document).ready(function () {
        // Your jQuery code goes here
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1Cz13aBYAbBYJL0oABZ8KZnd7imiWwA4&libraries=places&callback=initAutocomplete" async defer></script>



    {{-- to show confirmation alert message while delete --}}
    <script>
        function confirmDelete(restaurantId) {
            var result = confirm('Are you sure you want to delete this Restaurant?');
            if (!result) {
                event.preventDefault(); // Prevent the default action (deletion) if user clicks "Cancel"
            } else {
                window.location.href = '{{ url("restroDestroy") }}/' + restaurantId;
            }
        }
    </script>


<!-- jQuery library -->
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

<!-- Your script containing toggleTimeFields function -->
{{-- <script>
    function toggleTimeFields(dayId) {
        console.log("Toggling time fields for day ID: " + dayId);

        var checkbox = $('#is_close_' + dayId);
        var openCloseFields = $('#openCloseFields_' + dayId);
        var closeAtFields = $('#closeAtFields_' + dayId);

        if (checkbox.prop('checked')) {
            console.log("Checkbox is checked");
            openCloseFields.hide();
            closeAtFields.hide();
        } else {
            console.log("Checkbox is not checked");
            openCloseFields.show();
            closeAtFields.show();
        }
    }
</script> --}}

<script>
    function toggleTimeFields(dayId) {
        var checkbox = $('#is_close_' + dayId);
        var openCloseFields = $('#openCloseFields_' + dayId);
        var closeAtFields = $('#closeAtFields_' + dayId);

        if (checkbox.prop('checked')) {
            openCloseFields.hide();
            closeAtFields.hide();
        } else {
            openCloseFields.show();
            closeAtFields.show();
        }
    }
</script>





<!-- Axios library -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



{{-- to show status active or inactive --}}

<script>
    const toggleButton = document.getElementById('toggleButton');
toggleButton.addEventListener('click', function() {
    const currentStatus = toggleButton.getAttribute('data-status');
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    toggleButton.setAttribute('data-status', newStatus);
    toggleButton.classList.toggle('toggled', newStatus === 'active');
});
</script>

@stop
