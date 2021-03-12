@extends('layouts.crud')

@section("custom_javascript")
    <script src="{{ asset('js/file.js') }}"></script>
@endsection

@section('crud_card_header')
    <div class="flex-column align-self-center">
        {{ __('My Files') }}
    </div>

    <div class="flex-column">
        <a href="{{route("files.add")}}" class="btn btn-info text-white">Upload file</a>
    </div>
@endsection

@section('crud_card_content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Uploaded at</th>
            <th scope="col">Download Count</th>
            <th scope="col">Share URL</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @forelse($userFiles as $file)
                <tr>
                    <td>{{$file->original_name}}</td>
                    <td>{{$file->created_at}}</td>
                    <td>{{$file->download_count}}</td>
                    <td><a href="{{route("files.detail", $file->code)}}">Click here</a></td>
                    <td>
                        <a href="javascript:;" onclick="removeProduct({{$file->id}});">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No data was found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
