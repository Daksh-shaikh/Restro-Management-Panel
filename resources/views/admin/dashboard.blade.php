@extends('admin.layout.header')

@section('main-container')


		<!--start page wrapper -->

		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto">

						<div class="card">
							<div class="card-body">
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
									<!-- <li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon">
												</div>
												<div class="tab-title">Review Table</div>
											</div>
										</a>
									</li> -->
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
														<table id="example" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th>Sr No.</th>
																	<th>Restaurant Name</th>
																	<th>User</th>
																	<th>Cart Value</th>
																	<th>Value</th>
																	<th style="background-color: #ffffff;">Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td></td>
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
									<!-- <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
										<p>	<div class="col-md-12 mx-auto">
											<div class="card">
												<div class="card-body">
													<div class="table-responsive">
														<table id="example2" class="table table-striped table-bordered">
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
										</div></p>									</div> -->
									<!-- <div class="tab-pane fade" id="primarycontact" role="tabpanel">
										<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--end page wrapper -->


@endsection
