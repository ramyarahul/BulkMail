@extends('app')
@section('content')
<main class="add-form">
	<div class="cotainer">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card">
					<h3 class="card-header text-center">Add Mail</h3>
					<div class="card-body">
						<form method="POST" action="{{ route('store.mail') }}">
							@csrf
							<div class="form-group mb-3">
								<input type="email" placeholder="E-mail" id="email" class="form-control" name="email" required
								autofocus>
								@if ($errors->has('email'))
								<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
							<div class="d-grid mx-auto">
								<input type="submit" value="Submit" class="btn btn-dark">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection