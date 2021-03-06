@extends('layouts.app')
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Organisation</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('organisations.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
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

    <form action="{{ route('organisations.update', $organisation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $organisation->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>address:</strong>
                    <textarea class="form-control" style="height:50px" name="address"
                        placeholder="address">{{ $organisation->address }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>slug:</strong>
                    <input disabled type="text" name="slug" class="form-control" placeholder="{{ $organisation->slug }}"
                        value="{{ $organisation->slug }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="{{ $organisation->email }}"
                        value="{{ $organisation->email }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>phone:</strong>
                    <input type="tel" name="phone" class="form-control" placeholder="{{ $organisation->phone }}"
                        value="{{ $organisation->phone }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>type:</strong>
                    <select id="typeselect" name="type">
                        <option <?php echo $organisation->type == "client" ? "selected" : null ?> value="client">client</option>
                        <option <?php echo $organisation->type == "government" ? "selected" : null ?> value="government">government</option>
                        <option <?php echo $organisation->type == "school" ? "selected" : null ?> value="school">school</option>
                    </select>
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3>Missions <a href="{{ route('missions.create', ['organisation_id' => $organisation->id]) }}" class="btn btn-secondary">Add a mission</a>
            </h3>
        </div>
        @if(count($organisation->missions) > 0)
            @foreach ($organisation->missions as $mission)
            <div style="display: flex; align-items: center; width: 100%; justify-content : space-around">{{$mission->title}} ({{count($mission->missionLines)}} {{count($mission->missionLines) > 1 ? 'sub-missions' :'sub-mission' }}) 
                @if ($mission->ended_at == null)
                    <a href="{{ route('mission_lines.create', ['mission_id' => $mission->id, 'organisation_id' => $organisation->id]) }}" class="btn btn-secondary">Add a sub-mission</a> 
                    <form style="margin: 0" action="{{ route('missions.update', ['mission' => $mission, 'organisation_id' => $organisation->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button class="btn btn-success" type="submit">Confirm</i></button>
                </form>
                <form style="margin: 0" action="{{ route('missions.destroy', ['mission' => $mission, 'organisation_id' => $organisation->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger" type="submit">Delete</i></button>
                </form>
                @else 
                    <i style="color: green" class="fas fa-check"></i>
                @endif
                
                @if ($organisation->type == 'school')
                <a class="btn btn-primary" href="{{ URL::to('/mission/'.$mission->id.'/facture-no-devis') }}">Facture sans devis</a>
                @else
                <a class="btn btn-primary" href="{{ URL::to('/mission/'.$mission->id.'/devis') }}">Devis</a>
                <a class="btn btn-primary" href="{{ URL::to('/mission/'.$mission->id.'/facture-accompte') }}">Facture d'accompte</a>
                <a class="btn btn-primary" href="{{ URL::to('/mission/'.$mission->id.'/facture-solde') }}">Facture solde</a>
                <a class="btn btn-primary" href="{{ URL::to('/mission/'.$mission->id.'/facture-no-devis') }}">Facture sans devis</a>

                @endif


            </div> 
                @if(count($mission->missionLines) > 0)
                <ul>
                    @foreach ($mission->missionLines as $line)
                        <li style="display: flex; align-items: center">
                            <span style="padding: 5px">{{$line->title}} ({{$line->price * $line->quantity}}$) </span>
                            @if ($mission->ended_at == null)
                            <form style="margin: 0" action="{{ route('mission_lines.destroy', ['mission_line' => $line, 'organisation_id' => $organisation->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"><i style="color: red" class="fas fa-times"></i></button>
                            </form>
                            @endif
                    @endforeach
                </ul>
                @endif
            @endforeach
        @endif
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3>Contributions <a href="{{ route('contributions.create', ['organisation_id' => $organisation->id]) }}" class="btn btn-secondary">Add a contribution</a>
            </h3>
        </div>
        @if(count($organisation->contributions) > 0)
            @foreach ($organisation->contributions as $contribution)
            <div style="display: flex; align-items: center; width: 35%; justify-content : space-around">{{$contribution->title}} ({{$contribution->price}}$)
                <form style="margin: 0" action="{{ route('contributions.destroy', ['contribution' => $contribution, 'organisation_id' => $organisation->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger" type="submit">Delete</i></button>
                </form>
            </div> 
            @endforeach
        @endif

    </form>
@endsection