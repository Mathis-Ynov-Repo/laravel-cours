@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Mission to Organisation N°{{$organisation_id}}</h2>
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
    <form action="{{ route('missions.store') }}" method="POST" >
        @csrf

        <div class="row" id="formRow">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reference :</strong>
                    <input type="text" name="reference" class="form-control">
                </div>
            </div>
            <input type="hidden" name="organisation_id" value="{{$organisation_id}}">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title :</strong>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Comment  :</strong>
                    <textarea class="form-control" style="height:50px" name="comment"
                        ></textarea>
                </div>
            </div>
            <input type="hidden" name="deposit" value="30" class="form-control"
                        >
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deposit : 30% auto</strong>
                    <input type="number" name="deposit" class="form-control"
                        >
                </div>
            </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12" id="endRow">
                <div class="form-group">
                    <strong>ended_at :</strong>
                    <input type="date" name="ended_at" class="form-control" >
                </div>
            </div>
            <a id="addLine" style="padding: 2em; cursor : pointer">Add mission line</a>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center" id="submitBtn">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
@section('page-js-files')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function() {
        const addLine = $('#addLine');
        let number = 0;
        const row = document.getElementById('formRow');
        const sub = $('#submitBtn');
        
        addLine.click(() => {$(`<div class="col-xs-12 col-sm-12 col-md-12">
                <strong class="mb-3">Mission line</strong>
                <div class="form-group" style="display: flex">
                    <input placeholder="Title" style="margin : 5px; background: rgb(200, 200, 200); color : white" type="text" name="missionLines[${number}][title]" class="form-control" >
                    <input placeholder="Quantity" style="margin : 5px; background: rgb(200, 200, 200); color : white" type="number" name="missionLines[${number}][quantity]" class="form-control" >
                    <input placeholder="Price" style="margin : 5px; background: rgb(200, 200, 200); color : white" type="number" name="missionLines[${number}][price]" class="form-control" >
                    <input placeholder="Unity" style="margin : 5px; background: rgb(200, 200, 200); color : white" type="text" name="missionLines[${number}][unity]" class="form-control" >
                </div>
            </div>`).insertBefore("#addLine");
            number += 1})
    });
</script>
@endsection