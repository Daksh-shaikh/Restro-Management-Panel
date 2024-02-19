
@extends('frontend.layout.header')

@section('main-container')

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto">


						<div class="card">
							<div class="card-body">

								<h6>Add Delivery Boy</h6>
								<hr>
								<form class="row g-2" action="{{route('update_delivery_boy')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$deliveryEdit->id}}"/>

                                    <div class="col-lg-2">
										<label class="form-label">First Name</label>
										<input type="text" class="form-control" id="first_name" name="first_name"
											aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->first_name}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Last Name</label>
										<input type="text" class="form-control" id="last_name" name="last_name"
											aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->last_name}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Primary Mobile Number</label>
										<input type="text" class="form-control" id="name" name="primary_contact"
											aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->primary_contact}}">

									</div>

                                    <div class="col-lg-3">
										<label class="form-label">Secondary Mobile Number</label>
										<input type="text" class="form-control" id="name" name="secondary_contact"
											aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->secondary_contact}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Email</label>
										<input type="email" class="form-control" id="email"
											aria-describedby="emailHelp" name="email" placeholder="" value="{{$deliveryEdit->email}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Password</label>
										<input type="password" class="form-control" id="password"
											aria-describedby="emailHelp" name="password" placeholder=""  >

									</div>


									<div class="col-lg-3">
											<label class="form-label">Select City</label>
                                            <select class="single-select" name="city">

                                                <option value="">--Select--</option>
                                                @foreach ($city as $city_name)
                                                <option value="{{$city_name->id}}" @if($city_name->id ==$deliveryEdit->city_id) selected @endif >{{$city_name->city}}</option>

                                                @endforeach

											</select>
									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Address</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" name="address" placeholder="" value="{{$deliveryEdit->address}}">

									</div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Latitude</label>

                                    {{-- <input type="text" class="form-control" id="latitude" name="latitude"
                                    readonly required> --}}
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                    aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->latitude}}">

                                    </div>

                                    <div class="col-lg-2">
                                        <label class="form-label">Longitude</label>

                                               {{-- <input type="text" class="form-control" id="longitude" name="longitude"
                                               readonly required> --}}
                                               <input type="text" class="form-control" id="longitude" name="longitude"
                                               aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->longitude}}">
                                    </div>

                                    <div class="col-lg-3">
										<label class="form-label">Bank Account Number</label>
										<input type="text" class="form-control" id="account_number" name="account_number"
											aria-describedby="emailHelp" placeholder="" value="{{$deliveryEdit->account_number}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Aadhar Card Number</label>
										<input type="text" class="form-control" id="aadhar_number"
											aria-describedby="emailHelp" placeholder="" name="aadhar_number" value="{{$deliveryEdit->aadhar_number}}">

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Driving License Number</label>
										<input type="text" class="form-control" id="driving_license_number"
											aria-describedby="emailHelp" placeholder="" name="driving_license_number"
                                            value="{{$deliveryEdit->driving_license_number}}" required>

									</div>

                                    <div class="col-lg-2">
										<label class="form-label">Upload Documents</label>
										<input type="file" class="form-control" id="documents"
											aria-describedby="emailHelp" placeholder="" name="documents" >

									</div>



									<div class=""  align="center">
										<button type="submit" class="btn btn-success"><i
											class="fa fa-edit"></i>Update</button>

									</div>
								</form>

							</div>

						</div>
					</div>
				</div>



				<!--end page wrapper -->








@stop

