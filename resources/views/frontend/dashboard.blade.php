@extends('frontend.layout.header')

@section('main-container')


		<!--start page wrapper -->

        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}

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

								<ul class="nav nav-tabs nav-primary" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">Order Table</div>
											</div>
										</a>
									</li>


                                    {{-- -----Review Table  --}}
									{{-- <li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">Review Table</div>
											</div>
										</a>
									</li> --}}

                                    {{-- ----End Review Table --}}





									<!-- <li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-microphone font-18 me-1'></i>
												</div>
												<div class="tab-title">Contact</div>
											</div>
										</a>
									</li> -->
								</ul>
								<div class="tab-content py-3">
									<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
										<p>	<div class="col-md-12 mx-auto">
											<div class="card">
												<div class="card-body">
													<div class="table-responsive">
														<table id="example2" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th>Sr No.</th>
																	<th>Restaurant Name</th>
																	<th>User</th>
																	<th>Cart Value</th>
																	<!-- <th>Value</th> -->
																	<th style="background-color: #ffffff;">Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td></td>
																	<td></td>
																	<td></td>


																	<td style="background-color: #ffffff;"><button type="button" class="btn1 btn-outline-success"><i
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
										</div></p>
									</div>
									<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
										<p>	<div class="col-md-12 mx-auto">
											<div class="card">
												<div class="card-body">
													<div class="table-responsive">
														<table id="example" class="table table-striped table-bordered dataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sr No.</th>
                                                                    <th>User Name</th>
                                                                    <th>Email</th>
                                                                    <th>Contact No</th>
                                                                    <th>Messages</th>
                                                                    <th style="background-color: #ffffff;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Your table body content goes here -->


																<tr>
																	<td>1</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>

																	<td style="background-color: #ffffff;"><button
																		type="button" class="btn">
																		<div class="form-check form-switch"> <input
																				class="form-check-input" type="checkbox"
																				id="flexSwitchCheckDefault"> </div>
																	</button><button type="button"
																			class="btn1 btn-outline-danger"><i
																				class='bx bx-trash me-0'></i></button>
																	</td>
																</tr>
															</tbody>

														</table>
													</div>
												</div>
											</div>
										</div></p>									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



@endsection
