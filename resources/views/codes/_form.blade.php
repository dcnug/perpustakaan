<div class="form-group{{ $errors->has('code_book') ? ' has-error' : '' }}">
  {!! Form::label('code_book', 'Kode Buku', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
        {!! Form::text('code_book', null, ['class'=>'form-control']) !!}
        {!! $errors->first('code_book', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {!! $errors->has('book_id') ? 'has-error' : '' !!}">
  {!! Form::label('book_id', 'Buku', ['class'=>'col-md-2 control-label']) !!}
  <div class="col-md-4">
   {!! Form::select('book_id', [''=>'']+App\Book::pluck('title','id')->all(), null, [
  'class'=>'js-selectize',
  'placeholder' => 'Pilih Buku']) !!}
    {!! $errors->first('book_id', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
    </div>
</div>