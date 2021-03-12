@extends('layouts.crud')

@section('crud_card_header')
    <div class="flex-column align-self-center">
        {{ __('Create new File') }}
    </div>
@endsection

@section('crud_card_content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if( count($errors) > 0 )
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{route("files.store")}}" method="post" class="form-horizontal" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="file"><b>File:</b></label>
            <input type="file" name="file" class="form-control-file" value="{{old("file")}}" />
        </div>

        <div class="form-group">
            <a href="{{route("files")}}" class="btn btn-secondary text-white">Back</a>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </form>

@endsection
