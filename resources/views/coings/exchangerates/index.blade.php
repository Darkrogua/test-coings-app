@extends('layouts.app')

@section('content')
<table>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->buy_price }}</td>
            <td>{{ $item->sell_price }}</td>
        </tr>
    @endforeach
</table>
@endsection
