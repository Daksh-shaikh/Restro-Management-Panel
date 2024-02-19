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


								<h6>Add Coupon</h6>
								<hr>
								<form class="row g-2" method="post" action="{{route('couponStore')}}">
                                    @csrf
									<div class="col-lg-2">

											<label class="form-label">Select Restaurant</label>
											<select class="single-select" name="restaurant">
												{{-- <option value="United States">Vandu Restaurant</option>
												<option value="United Kingdom">Rangoli Restaurant</option> --}}
                                                <option value="">--select--</option>
                                        @foreach ($restro as $restro_name)
                                            <option value="{{ $restro_name->id }}">{{ $restro_name->restaurant}}</option>
                                        @endforeach
											</select>
									</div>
									<div class="col-lg-2">
										<label class="form-label">Coupon Code</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="code">

									</div>

									<div class="col-lg-1">
										<label class="form-label">DS Type</label>
										<select class="single-select" name="dstype">
											<option value="Percent">%</option>
											<option value="Rupee">₹</option>
										</select>
								</div>
									<div class="col-lg-2">
										<label class="form-label">Value</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="value">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Start From</label>
										<input type="date" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="start_from">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Up To</label>
										<input type="date" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="upto">

									</div>

									<div class="col-lg-2">
										<label class="form-label">Min. Cart Value</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="min_cost">

									</div>


									<div class="col-lg-2"  style="margin-top: 35px;">
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
											<th>Restaurant</th>
											<th>Coupon Code</th>
											<th>DS Type</th>
											<th>Value</th>
											<th>Start From</th>
											<th>Up to</th>
											<th>Min. Cost Value</th>
                                            <th>Status</th>
											<th style="background-color: #ffffff;">Action</th>
										</tr>
									</thead>
									<tbody>

                                        @foreach ($coupon as $coupon)


										<tr>
											<td>{{$loop->index+1}}</td>
											{{-- <td>{{$coupon->restaurant_name->restaurant}}</td> --}}
                                            <td>
                                            @if($coupon->restaurant_name)
                                            {{ $coupon->restaurant_name->restaurant}}
                                        @else
                                            null
                                        @endif</td>

											<td>{{$coupon->code}}</td>
											<td>{{$coupon->dstype}}</td>
											<td>{{$coupon->value}}</td>
											<td>{{$coupon->start_from}}</td>
											<td>{{$coupon->upto}}</td>
											<td>{{$coupon->min_cost}}</td>

                                              {{-- active inactive button --}}
                                              <td style="background-color: #ffffff;">
                                                <div class="d-flex align-items-center">

                                                           <?php if ($coupon->status=='1'){?>

                                                            <a href="{{url('/update_coupon_status', $coupon->id)}}"
                                                                class="btn btn-success"> Active</a>

                                                                <?php } else {?>
                                                                <a href="{{url('/update_coupon_status', $coupon->id)}}"
                                                                    class="btn btn-danger">Inactive</a>
                                                                    <?php
                                                            }?>
                                                            </td>

                                        {{--active inactive button end  --}}

											<td style="background-color: #ffffff;">

                                                <a href="{{route('couponEdit', $coupon->id)}}">
                                                <button type="button" class="btn1 btn-outline-success"><i
														class='bx bx-edit-alt me-0'></i></button>
                                                    </a>

                                                        {{-- <a href="{{route('couponDestroy', $coupon->id)}}">
                                                        <button type="button"
													class="btn1 btn-outline-danger"
                                                    onclick="confirmDelete({{ $coupon->id }})"><i
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
        function confirmDelete(couponId) {
            var result = confirm('Are you sure you want to delete this Coupon?');
            if (!result) {
                event.preventDefault(); // Prevent the default action (deletion) if user clicks "Cancel"
            } else {
                window.location.href = '{{ url("couponDestroy") }}/' + couponId;
            }
        }
    </script>

{{-- script to show status --}}

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
