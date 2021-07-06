@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Vos Transactions</h2>
            <h5>TOTAL : {{ array_reduce($transactions->toArray(), function ($acc, $transaction) { return $acc += $transaction['price'];})}}$</h5>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('organisations.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6" style="display: flex; align-items: center;justify-content : space-around; margin-bottom : 2em">
        <select name="type" id="select-type">
            <option value="">All</option>
            <option {{ Request::get('type') === "contribution" ? 'selected' : null }} value="contribution">Contributions</option>
            <option {{ Request::get('type') === "mission" ? 'selected' : null }} value="mission">Missions</option>
        </select>
        <label for="check-pay">Is paid 
        <input {{ Request::get('paid') == true ? 'checked' : null }} type="checkbox" id="check-pay" name="check-pay">
        </label>

        <select name="year" id="select-year">
            @for ($i = 1970 ; $i < 2022; $i++) 
            <option {{ Request::get('year') == $i ? 'selected' : null }} value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <div style="display: flex; flex-direction: column">
        <label style="text-align: center" for="inp-entreprise">Enterprise
        <input type="text" id="inp-entreprise" name="inp-entreprise" value="{{Request::get('input')}}">
        </label>
        {{-- <a id="search-entreprise" style="cursor: pointer"><i class="fas fa-search"></i></a> --}}

        <label style="text-align: center" for="inp-title">Title
        <input type="text" id="inp-title" name="inp-title" value="{{Request::get('title')}}">
        </label>
        </div>
        {{-- <a id="search-title" style="cursor: pointer"><i class="fas fa-search"></i></a> --}}
        <a id="search" style="cursor: pointer"><i class="fas fa-search"></i></a>


    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table table-bordered table-responsive-lg">
    <tr>
        <th>No</th>
        <th>Organisation</th>
        <th>Source type</th>
        <th>Title</th>
        <th>Price</th>
        <th>Paid_at</th>
        <th>Date Created</th>
    </tr>
    @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->source->organisation->name }}</td>
            <td>{{ str_replace("\App\Models\\", "", $transaction->source_type) }}</td>
            @if (isset($transaction->source))
                <td>{{ $transaction->source->title }}</td>
            @else 
                <td>No title available</td>
            @endif
            <td>{{ $transaction->price }}</td>
            <td>{{ $transaction->paid_at }}</td>
            <td>{{ date_format($transaction->created_at, 'd-m-Y') }}</td>
        </tr>
    @endforeach
</table>
    

@endsection
@section('page-js-files')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function() {
        var searchParams = new URLSearchParams(window.location.search);

        $('#check-pay').on('click', (e) => {
            let url = document.location
            e.target.checked == true ? searchParams.set("paid", true) : searchParams.delete("paid")
            const searchParameters = searchParams.toString()
            if (searchParameters != "")
                url = document.location.href.replace(document.location.search , '') + '?' + searchParameters
            else
                url = document.location.href.replace(document.location.search , '')

            document.location = url
        })
        $('#search').on('click', () => {
            let url = document.location
            let title = $('#inp-title').val()
            let input = $('#inp-entreprise').val()
            input != "" ? searchParams.set("input", `${input}`) : searchParams.delete("input")
            title != "" ? searchParams.set("title", `${title}`) : searchParams.delete("title")
            const searchParameters = searchParams.toString()
            if (searchParameters != "")
                url = document.location.href.replace(document.location.search , '') + '?' + searchParameters
            else
                url = document.location.href.replace(document.location.search , '')

            document.location = url
        })

        
        
        $('#select-type').on('change', (e)=> {
            let url = document.location
            e.target.value != "" ? searchParams.set("type", `${e.target.value}`) : searchParams.delete("type")
            const searchParameters = searchParams.toString()
            if (searchParameters != "")
                url = document.location.href.replace(document.location.search , '') + '?' + searchParameters
            else
                url = document.location.href.replace(document.location.search , '')

            document.location = url
        })
        $('#select-year').on('change', (e)=> {
            let url = document.location
            e.target.value != "" ? searchParams.set("year", `${e.target.value}`) : searchParams.delete("year")
            const searchParameters = searchParams.toString()
            if (searchParameters != "")
                url = document.location.href.replace(document.location.search , '') + '?' + searchParameters
            else
                url = document.location.href.replace(document.location.search , '')

            document.location = url
        })
    });
</script>
@endsection