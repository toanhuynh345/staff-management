@extends('admin.layouts.app')
@section('title') {{__('text.home')}}
@endsection
@push('css')
    <style>
        #chartdiv {
            width: 100%;
            height: 600px;
        }
    </style>
@endpush
@section('content')
    <div class="row page-header no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <h3 class="page-title">{{__('text.overview')}}</h3>
        </div>
    </div>
@endsection

@push('js')
@endpush
