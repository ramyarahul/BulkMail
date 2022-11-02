@extends('app')
@section('content')
<div class="container mt-2">
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Compose</h2>
			</div>
		</div>
	</div>   
	<div class="container">
		<div class="row">
			<div class="col-md-7 offset-3 mt-4">
				<div class="card-body">
					<form method="post" action="{{route('content.send')}}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<input type="text" placeholder="Subject" id="subject" class="form-control" name="subject" autofocus>
						</div>
						<br/>
						<div class="form-group">
							<textarea class="ckeditor form-control" id="wysiwyg-editor" name="wysiwyg-editor"></textarea>
						</div>
						<br/>
						<div class="d-grid mx-auto">
							<input type="submit" value="Submit" class="btn btn-dark">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>       
<script type="text/javascript">
    CKEDITOR.replace('wysiwyg-editor', {
        filebrowserUploadUrl: "{{route('image.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection