@extends('layouts.crud')

@section('crud_card_header')
    <div class="flex-column align-self-center">
        {{__("File Details") }}
    </div>

    <div class="flex-column">
        <a href="{{route("files")}}" class="btn btn-secondary text-white">Back</a>
    </div>
@endsection

@section('crud_card_content')

    <div class="form-group">
        <label><b>Original Name</b></label>
        <span class="form-text">{{$currentFile->original_name}}</span>
    </div>

    <div class="form-group">
        <label><b>Date Uploaded</b></label>
        <span class="form-text">{{$currentFile->created_at}}</span>
    </div>

    <div class="form-group">
{{--        <a href="" class="form-text">Download Here</a>--}}
        <a class="form-text" href=""
           onclick="event.preventDefault(); document.getElementById('download-form').submit();">
            {{ __('Download Here') }}
        </a>

        <form id="download-form" action="{{ route('files.download', $currentFile->code) }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

@endsection
