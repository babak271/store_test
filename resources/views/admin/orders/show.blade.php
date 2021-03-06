@extends('admin.app')
@section('title') Order Detail: {{$order->id}} @endsection
@section('content')
    <div class="container mt-2">
        <div class="mt-3">
            <div class="container row">
            <h2><a href="#">{{$order->getUser->first_name}} {{$order->getUser->last_name}}</a>
                <small>@ {{$order->updated_at->format('Y M d, h:i:s')}}</small>
            </h2>
                <div class="ml-auto">
                    <h3>Status: {{$order->order_status}}</h3>
                </div>
            </div>
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Item Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($order->getOrderItem as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            @php $product = $item->getProduct()->withTrashed()->pluck('name')->first() @endphp
                            <td>{{$product}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{money_format($item->price,2)}}</td>
                            <td>{{money_format($item->total_price,2)}}</td>
                            @empty
                                <p>The are not any products added yet!</p>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="4">Total price</td>
                        <td>{{$order->total_price}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
