<p>Name : {{$mission->organisation->name}}</p>
<p>Email : {{$mission->organisation->email}}</p>
<p>Adress : {{$mission->organisation->address}}</p>   
<p>Phone : {{$mission->organisation->phone}}</p> 

<p>Devis</p>
<p>Date : {{date('d/m/Y')}}</p>
<h1>Mission : {{$mission->title}}</h1>


<table>
<tr>
<th>No</th>
<th>Title</th>
<th>Quantity</th>
<th>Price</th>
<th>Unity</th>
</tr>
@if (count($mission->missionLines) > 0)
    @foreach ($mission->missionLines as $key => $item)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}$</td>
            <td>{{ $item->unity }}</td>
        </tr>
    @endforeach
@endif
</table>
<h2>Total TTC : {{$total}}$</h2>
<span>Modalité de paiement</span>
<p>{{$mission->deposit}}% d'accompte à la signature</p>
