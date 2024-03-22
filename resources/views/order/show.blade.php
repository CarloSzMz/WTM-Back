@extends('layout.main')
@section('content')
    <div class="container bg-secondary-subtle">
        <div class="container pt-4 pb-4">
            <img src="{{ asset('assets/img/logos/logo_black.png') }}" alt="" width="150px" class="float-end">
            <h4>{{ $order->created_at }}</h4>
            <h3>Confirmación de pedido</h3>
            <p>Su pedido ha sido procesado correctamente.<br>
                Gracias por comprar en Wear The Message</p>
            <aside class="float-end">
                <p>Identificador de pedido:</p>
                <p class="align-content-end"><strong>{{ $order->id }}</strong></p>

            </aside>
            <table class="table table-striped table-hover">
                <th>Artículos seleccionados</th>
                <th>Base</th>
                <th>IVA</th>
                <th>Total</th>
                @foreach ($orderArticles as $item)
                    <tr>
                        <td class="d-flex">
                            <p> <img src="{{ asset("assets/img/camisetas/$item->url_img ") }}" alt="imgenArticulo"
                                    width="50px" class="rounded mr-5"></p>
                            <p style="padding-left: 20px"><span class="text-secondary fs-6">{{ $item->article_id }}</span><br>
                                <span class="fs-5">{{ $item->name }}</span><br>
                                <span class="text-secondary fs-6">{{ $item->price }}€ (IVA incluido) x
                                    {{ $item->quantity }}ud.</span>
                            </p>
                        </td>
                        @php
                            $IVA = 0.21;
                            $SinIVA = ($item->price - ($item->price * $IVA))*$item->quantity;
                            $TotalArticulo = $item->price * $item->quantity;
                        @endphp
                        <td class="align-bottom text-secondary">{{ $SinIVA }}€</td>
                        <td class="align-bottom text-secondary">21,00%</td>
                        <td class="align-bottom">{{ $TotalArticulo }}</td>
                    </tr>
                @endforeach


            </table>
        </div>



    </div>
@endsection
