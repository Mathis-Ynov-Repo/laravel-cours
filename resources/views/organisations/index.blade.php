{{-- {{dd($organisations)}} --}}
@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('organisations.create') }}" title="Create an organisation"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
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
            <th>Name</th>
            <th>address</th>
            <th>slug</th>
            <th>email</th>
            <th>phone</th>
            <th>type</th>
            <th>Missions</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($organisations as $organisation)
            <tr>
                <td>{{ $organisation->id }}</td>

                <td>{{ $organisation->name }}</td>
                <td>{{ $organisation->address }}</td>
                <td>{{ $organisation->slug }}</td>
                <td>{{ $organisation->email }}</td>
                <td>{{ $organisation->phone }}</td>
                <td>{{ $organisation->type }}</td>
                <td>
                @foreach ($organisation->missions as $mission)
                    <li>{{$mission->title}}</li>
                    <ul>
                        @foreach ($mission->missionLines as $missionLine)
                            <li>{{$missionLine->title}}</li>
                        @endforeach
                    </ul>
                @endforeach
                </td>

                <td>{{ date_format($organisation->created_at, 'd-m-Y') }}</td>

                <td>
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
                </td>
            </tr>
        @endforeach
    </table>
    {{-- {!! $organisations->links() !!} --}}

@endsection