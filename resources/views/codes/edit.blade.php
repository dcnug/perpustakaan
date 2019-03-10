@extends('layouts.app')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ url('/home') }}">Dashboard</a></li>
						<li><a href="{{ url('/admin/codes') }}">Kode Buku</a></li>
						<li class="active">Ubah Kode Buku</li>
					</ul>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">Ubah Kode Buku</h2>
							</div>
								<div class="panel-body">
									{!! Form::model($category, ['url' => route('codes.update', $category->id),'method'=>'put', 'class'=>'form-horizontal']) !!}
									@include('codes._form')
									{!! Form::close() !!}
								</div>
						</div>
				</div>
			</div>
		</div>
@endsection