@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New sub-mission to Mission N°{{$mission_id}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('organisations.edit', $organisation_id) }}" title="Go back"> <i class="fas fa-backward "></i> </a>
                
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('mission_lines.store') }}" method="POST" >
        @csrf

        <div class="row">
            <input type="hidden" name="mission_id" value="{{$mission_id}}">
            <input type="hidden" name="organisation_id" value="{{$organisation_id}}">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title :</strong>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantity :</strong>
                    <input type="number" name="quantity" class="form-control"
                        >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price :</strong>
                    <input type="number" name="price" class="form-control" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Unity :</strong>
                    <input type="text" name="unity" class="form-control" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection