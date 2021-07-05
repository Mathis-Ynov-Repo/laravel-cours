@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vos Transactions</h2>
            </div>
            {{-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('organisations.create') }}" title="Create an organisation"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div> --}}
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
            <th>Source id</th>
            <th>Source type</th>
            <th>Title</th>
            <th>Price</th>
            <th>Paid_at</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->source_id }}</td>
                <td>{{ str_replace("\App\Models\\", "", $transaction->source_type) }}</td>
                @if (isset($transaction->source))
                    <td>{{ $transaction->source->title }}</td>
                @else 
                    <td>No title available</td>
                @endif
                <td>{{ $transaction->price }}</td>
                <td>{{ $transaction->slug }}</td>
                <td>{{ $transaction->paid_at }}</td>
                <td>{{ date_format($transaction->created_at, 'd-m-Y') }}</td>
                {{-- <td>
                    <form action="{{ route('organisations.destroy', $organisation->id) }}" method="POST">

                        <a href="{{ route('organisations.show', $organisation->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('organisations.edit', $organisation->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td> --}}
            </tr>
        @endforeach
    </table>

@endsection