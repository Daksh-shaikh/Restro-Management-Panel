@extends('frontend.layout.header')

@section('main-container')


		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-8 mx-auto">


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


								<h6>Add GST</h6>
								<hr>
								<form class="row g-2" method="post" action="{{route('gstStore')}}">
                                    @csrf
									<div class="col-lg-4">
										<label class="form-label">CGST</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="cgst">

									</div>

									<div class="col-lg-4">
										<label class="form-label">SGST</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="sgst">

									</div>
									<div class="col-md-2" style="margin-top:35px;">
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
				<!-- <div class="overlay toggle-icon"></div>
				<hr />
				<div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Sr No</th>
											<th>City</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Amravati</td>
											<td><button type="button" class="btn1 btn-outline-success"><i
														class='bx bx-edit-alt me-0'></i></button> <button type="button"
													class="btn1 btn-outline-danger"><i
														class='bx bx-trash me-0'></i></button>
											</td>
										</tr>
									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>



		<!--end page wrapper -->

        @endsection
