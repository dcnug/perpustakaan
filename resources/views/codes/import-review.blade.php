@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/admin/books') }}">Buku</a></li>
          <li><a href="{{ url('/admin/books/create') }}">Tambah Buku</a></li>
          <li class="active">Review Buku</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Review Buku</h2>
          </div>

          <div class="panel-body">
            <p> <a class="btn btn-success" href="{{ url('/admin/books')}}">Selesai</a> </p>
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th>Buku</th>
                  <th>Kode Buku</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($codes as $code)
                  <tr>
                    <td>{{ $code->book->title }}</td>
                    <td>{{ $code->code_book }}</td>
                    <td>
                      {!! Form::open(['url' => route('codes.destroy', $code->id), 
                      'id'           => 'form-'.$code->id, 'method'=>'delete',
                      'data-confirm' => 'Yakin menghapus ' . $code->title . '?',
                      'class'        => 'form-inline js-review-delete']) !!}
                      {!! Form::submit('Hapus', ['class'=>'btn btn-xs btn-danger']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <p> <a class="btn btn-success" href="{{ url('/admin/codes')}}">Selesai</a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
