<p>Nom de l'entreprise : {{$mission->organisation->name}}</p>
<p>Email : {{$mission->organisation->email}}</p>   
<p>Date : {{date('d/m/Y')}}</p>
<h2>Mission : {{$mission->title}}</h2>

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
<p>Paiement à la réception</p>