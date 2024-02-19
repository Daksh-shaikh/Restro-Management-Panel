@extends('admin.layout.header')

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


								<h6>Your Restaurant Profile</h6>
								<hr>
								{{-- <form class="row g-2" action="profile.update" method="post" enctype="multipart/form-data"> --}}

                                    <form class="row g-2" action="{{ route('profile.update', ['id' => $restro->id]) }}" method="post" enctype="multipart/form-data">

                                        @csrf
									<div class="col-lg-2">

                                        <label class="form-label">Select City</label>

                                                {{-- <input type="text" class="form-control" id="city"
                                                aria-describedby="emailHelp" placeholder=""
                                                value="{{$restro-> city}}" > --}}

                                                {{-- <label class="form-label">Select City</label> --}}
                                                <input type="text" class="form-control" id="city" aria-describedby="emailHelp" placeholder="" value="{{ $restro->city }}" name="city">

									</div>
									<div class="col-lg-2">
										<label class="form-label">Restaurant Name</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="restaurant"
                                            value="{{$restro-> restaurant}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Address</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="address"
                                            value="{{$restro-> address}}">

									</div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Latitude</label>

                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                    readonly required
                                    value="{{$restro-> latitude}}">

                                    </div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Longitude</label>

                                               <input type="text" class="form-control" id="longitude" name="longitude"
                                               readonly required
                                               value="{{$restro-> longitude}}">
                                    </div>


									<div class="col-lg-2">
										<label class="form-label">Contact Person</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="contact_person"
                                            value="{{$restro-> contact_person}}">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Mobile No</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="mobilenumber"
                                            value="{{$restro-> mobilenumber}}">

									</div>

									<div class="col-lg-2">
                                        <label class="form-label">Email / Username </label>
                                        <input type="text" class="form-control" name="email"
                                        value="{{$restro-> email}}">
                                    </div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                        value="{{$restro-> password}}">
                                    </div>

                                    <div class="col-lg-2">
										<label class="form-label">Avg Cooking Time</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="avg_cooking_time"
                                            value="{{$restro-> avg_cooking_time}}">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Upload Banner</label>
										<input type="file" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="banner"
                                            value="{{$restro-> banner}}">

									</div>
{{--
								<div class="col-lg-1" style="margin-top: 35px;">
										<input class="form-check-input" type="checkbox" value="Veg" name="food[]" id="flexCheckDefault" >
										<label class="form-check-label" for="flexCheckDefault">Veg</label>

								</div>

								<div class="col-lg-1" style="margin-top: 35px;">
									<input class="form-check-input" type="checkbox" value="Non-Veg" name="food[]" id="flexCheckDefault1">
									<label class="form-check-label" for="flexCheckDefault1">Non-Veg</label>

							</div> --}}


                            <div class="col-lg-1" style="margin-top: 35px;">
                                <input class="form-check-input" type="checkbox" value="Veg" name="food[]" id="flexCheckDefault" {{ in_array('Veg', explode(',', $restro->food)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">Veg</label>
                            </div>

                            <div class="col-lg-1" style="margin-top: 35px;">
                                <input class="form-check-input" type="checkbox" value="Non-Veg" name="food[]" id="flexCheckDefault1" {{ in_array('Non-Veg', explode(',', $restro->food)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault1">Non-Veg</label>
                            </div>



							<div class="col-lg-3">
								<label for="inputAddress2" class="form-label">Restaurant Details</label>
								<textarea class="form-control" id="inputAddress2" placeholder="" rows="3" name="details">{{$restro-> details}}</textarea>
							</div>
<div></div>
<div></div>
                            <div>

                            <h6>Delivery Slots & Timing</h6>
<hr>
<div class="row">
    @foreach ($days as $day)
        <div class="col-lg-2">
            <label class="form-label">{{ $day->days }}</label>
            <input type="hidden" name="days[]" value="{{ $day->id }}">

            <div>
                <input type="checkbox" name="is_close_{{ $day->id }}" id="is_close_{{ $day->id }}"
                style="width: 15px; height: 15px; border: 2px solid #333;"
                onchange="toggleTimeFields('{{ $day->id }}')"  {{ in_array($day->id, ($timeSlots)) ? 'checked' : '' }}>
                <label class="form-check-label" for="flexCheckDefault1" style="margin-left: 10px">Closed</label>
            </div>
        </div>

        <div class="col-lg-2">
            <div style="position: relative; margin-top:15px">
                <label for="open_at_{{ $day->id }}" style="position: absolute; top: -10px; left: 5px; background-color: white; padding: 0 5px;">Open at</label>
                <input type="time" name="open_at_{{ $day->id }}" id="open_at_{{ $day->id }}" class="form-control" style="height: 50px;" value="{{ $timeSlots[$day->id]['open_at'] ?? '10:00' }}">
            </div>
        </div>

        <div class="col-lg-2">
            <div style="position: relative; margin-left: 10px; margin-top:15px">
                <label for="close_at_{{ $day->id }}" style="position: absolute; top: -10px; left: 5px; background-color: white; padding: 0 5px;">Close at</label>
                <input type="time" name="close_at_{{ $day->id }}" id="close_at_{{ $day->id }}" class="form-control" style="height: 50px;" value="{{ $timeSlots[$day->id]['close_at'] ?? '12:00' }}">
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
                                            Update</button>
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

			</div>
		</div>



<script>
    // Load the Google Maps API with the Places library
    function initAutocomplete() {
        const autocomplete = new google.maps.places.Autocomplete(document.getElementById('city'));

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


@endsection


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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Your script containing toggleTimeFields function -->
<script>
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
</script>




