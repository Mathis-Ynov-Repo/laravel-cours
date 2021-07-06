<p>Nom de l'entreprise : {{$mission->organisation->name}}</p>
<p>Email : {{$mission->organisation->email}}</p>   
<p>Date : {{date('d/m/Y')}}</p>
<p>Devis / Solde</p>

<h2>Mission : {{$mission->title}}</h2>



<table>
<tr>
<th>Title</th>
<th>Quantity</th>
<th>Total TTC</th>
<th>Solde value</th>
</tr>
<tr>
    <td>Solde {{(100 - $mission->deposit)}}% : {{ $mission->title }}</td>
    <td>{{$mission->deposit }}%</td>
    <td>{{ $total }}$</td>
    <td>{{ $total * (100 - $mission->deposit) / 100 }}</td>
</tr>
</table>
<h2>Total TTC : {{$total * (100 - $mission->deposit) / 100}}$</h2>
