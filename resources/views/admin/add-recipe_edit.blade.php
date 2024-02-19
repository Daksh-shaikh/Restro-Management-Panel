@extends('admin.layout.header')

@section('main-container')


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
								<form class="row g-2" action="{{route('recipeUpdate')}}" method="post" enctype="multipart/form-data">
                                    @csrf
									<div class="col-lg-2">
                                        <input type="hidden" name="id" value="{{$recipeEdit->id}}"/>
											<label class="form-label">Select Category</label>
											<select class="single-select" name="category">
                                                <option value="">--Select--</option>
                                                @foreach ($category as $category_name)
                                                <option value="{{$category_name->id}}"
                                                    {{ old('category', $recipeEdit->category_id) == $category_name->id ? 'selected' : '' }}>
                                                    {{$category_name->category}}</option>

                                                @endforeach
												{{-- <option value="United States">Chines</option>
												<option value="United Kingdom">South Indian</option> --}}
											</select>
									</div>
									<div class="col-lg-2">
										<label class="form-label">Recipe Name</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="recipe"
                                            value="{{$recipeEdit->recipe}}">

									</div>

									<div class="col-lg-1">
										<label class="form-label">Price</label>
										<input type="text" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="price"
                                            value="{{$recipeEdit->price}}">

									</div>
									<div class="col-lg-2">
										<label class="form-label">Recipe image</label>
										<input type="file" class="form-control" id="exampleInputEmail1"
											aria-describedby="emailHelp" placeholder="" name="image"
                                            >

									</div>

									<div class="col-lg-3">
										<label for="inputAddress2" class="form-label">Recipe Description</label>
										<textarea class="form-control" id="inputAddress2" placeholder=""
                                        rows="3" name="description" >{{$recipeEdit->description}}</textarea>
									</div>


									<div class="col-lg-2"  style="margin-top: 35px;">
										<button type="submit" class="btn btn-success"><i
											class="fa fa-edit"></i>Update</button>
									</div>
								</form>

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
