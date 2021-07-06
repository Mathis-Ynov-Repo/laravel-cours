<p>Nom de l'entreprise : {{$mission->organisation->name}}</p>
<p>Email : {{$mission->organisation->email}}</p>   
<p>Date : {{date('d/m/Y')}}</p>
<p>Devis / Accompte</p>

<h2>Mission : {{$mission->title}}</h2>


<table>
<tr>
<th>Title</th>
<th>Debit Percentage</th>
<th>Total TTC</th>
<th>Debit value</th>
</tr>
<tr>
    <td>Accompte {{$mission->deposit}}% : {{ $mission->title }}</td>
    <td>{{$mission->deposit }}%</td>
    <td>{{ $total }}$</td>
    <td>{{ $total * $mission->deposit / 100 }}$</td>
</tr>
</table>
<h2>Total TTC : {{$total * $mission->deposit / 100}}$</h2>
