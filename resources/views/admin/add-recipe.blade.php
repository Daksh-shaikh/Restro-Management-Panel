@extends('admin.layout.header')

@section('main-container')


<!-- Add this at the top of your Blade file to get the authenticated user -->
@auth
<?php $authenticatedUser = auth()->user(); ?>
@endauth


		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto">


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


						<div class="card">
							<div class="card-body">

								<h6>Add Recipe</h6>
								<hr>
								<form class="row g-2" action="{{route('recipeStore')}}" method="post" enctype="multipart/form-data">
                                    @csrf
									<div class="col-lg-2">
											<label class="form-label">Select Category</label>
											<select class="single-select" name="category">
                                                <option value="">--Select--</option>
                                                @foreach ($category as $category_name)
                                                <option value="{{$category_name->id}}">{{$category_name->category}}</option>

                                                @endforeach
												{{-- <option value="United States">Chines</option>
												<option value="United Kingdom">South Indian</option> --}}
											</select>
									</div>
									<div class="col-lg-2">
										<label class="form-label">Recipe Name</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="recipe">

									</div>

									<div class="col-lg-1">
										<label class="form-label">Price</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="price">

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
											<th>Category</th>
											<th>Recipe Name</th>
											<th>Price</th>
											<th>Recipe image</th>
											<th>Recipe Description</th>
                                            <th>Status</th>
											<th style="background-color: #ffffff;">Action</th>
										</tr>
									</thead>
									<tbody>


                                    <!-- Modify the loop to show recipes only for the authenticated user -->
                                    @foreach ($authenticatedUser->recipes as $item)

										<tr>
											<td>{{$loop->index+1}}</td>
											{{-- <td>{{$item->category}}</td> --}}
                                            <td>
                                                @if($item->category_name)
                                                {{ $item->category_name->category }}
                                            @else
                                                null
                                            @endif

                                            {{-- {{$item->category_id}} --}}
                                            </td>
                                            <td>{{$item->recipe}}</td>
                                            <td>{{$item->price}}</td>
                                            {{-- <td>{{$recipe->image}}</td> --}}
                                            <td>  <a href="{{asset('recipe/'. $item->image)}}"></a>
                                                <img height="50px" width="50px"  src="{{asset('recipe/'. $item->image)}}" alt="" />
</td>
                                            <td>{{$item->description}}</td>


                                            {{-- active inactive button --}}
                                            <td style="background-color: #ffffff;">
                                                <div class="d-flex align-items-center">

                                                           <?php if ($item->status=='1'){?>

                                                            <a href="{{url('/update_recipe_status', $item->id)}}"
                                                                class="btn btn-success"> Active</a>

                                                                <?php } else {?>
                                                                <a href="{{url('/update_recipe_status', $item->id)}}"
                                                                    class="btn btn-danger">Inactive</a>
                                                                    <?php
                                                            }?>
                                                            </td>

                                        {{--active inactive button end  --}}

											<td style="background-color: #ffffff;">

                                                <a href="{{route('recipeEdit', $item->id)}}">
                                                    <button type="submit" class="btn1 btn-outline-success"><i
														class='bx bx-edit-alt me-0'></i></button></a>

                                                        {{-- <a href="{{route('recipeDestroy', $item->id)}}">
                                                        <button type="button"
													class="btn1 btn-outline-danger"
                                                    onclick="confirmDelete({{ $item->id }})"><i
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

    {{-- to show confirmation alert message while delete --}}
    <script>
        function confirmDelete(recipeId) {
            var result = confirm('Are you sure you want to delete this Recipe?');
            if (!result) {
                event.preventDefault(); // Prevent the default action (deletion) if user clicks "Cancel"
            } else {
                window.location.href = '{{ url("recipeDestroy") }}/' + recipeId;
            }
        }
    </script>
