@extends('layout.main')
@section('content')
    <div class="container bg-secondary-subtle">
        <div class="container pt-4 pb-4">
            <img src="{{ asset('assets/img/logos/logo_black.png') }}" alt="" width="150px" class="float-end">
            <h4 style="font-size: 15px">{{ $order->created_at }}</h4>
            <h3>Confirmación de pedido</h3>
            <p class=" text-secondary">Su pedido ha sido procesado correctamente.<br>
                Gracias por comprar en Wear The Message</p>
            <aside class="float-end">
                <p>Identificador de pedido:</p>
                <p class="align-content-end" style="float: inline-end"><strong>{{ $order->OrderId }}</strong></p>

            </aside>
            <table class="table table-striped table-hover">
                <th>Artículos seleccionados</th>
                <th>Base</th>
                <th>IVA</th>
                <th>Total</th>
                @php
                    $IVA = 0.21;
                    $totalsinIVA = 0;
                @endphp
                @foreach ($orderArticles as $item)
                    <tr>
                        <td class="d-flex">
                            <p> <img src="{{ asset("assets/img/camisetas/$item->url_img ") }}" alt="imgenArticulo"
                                    width="50px" class="rounded mr-5"></p>
                            <p style="padding-left: 20px"><span
                                    class="text-secondary fs-6">{{ $item->article_id }}</span><br>
                                <span class="fs-5">{{ $item->name }}</span><br>
                                <span class="text-secondary fs-6">{{ $item->price }}€ (IVA incluido) x
                                    {{ $item->quantity }}ud.</span>
                            </p>
                        </td>
                        @php
                            $SinIVA = ($item->price - $item->price * $IVA) * $item->quantity;
                            $TotalArticulo = $item->price * $item->quantity;
                            $totalsinIVA = $SinIVA + $totalsinIVA;
                        @endphp
                        <td class="align-bottom text-secondary">{{ $SinIVA }}€</td>
                        <td class="align-bottom text-secondary">21,00%</td>
                        <td class="align-bottom">{{ $TotalArticulo }}€</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="padding-right: 30px"><strong><span class="float-end">TOTAL</span></strong></td>
                    <td>{{ $totalsinIVA }}€</td>
                    <td></td>
                    <td>{{ $order->total_price }}€</td>
                </tr>
                <tr>
                    <td style="padding-right: 30px"><strong> <span class="float-end">IMPORTE TOTAL </span></strong>
                        </br><span class="float-end text-secondary">(*IVA incl.)</span></td>
                    <td></td>
                    <td></td>
                    <td class="fs-4"><strong>{{ $order->total_price }}€</strong></td>
                </tr>

            </table>
            <button class="btn btn-light"><a class="text-decoration-none"
                    href="{{ route('order.index') }}">Volver</a></button>

        </div>

    </div>
@endsection
