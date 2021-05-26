<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        </head>
    <body>

    <table style="width: 100%">
        <tr>
            <td style="width: 70%; padding-left: 40px"><img src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/logo.png" width="250px" height="100px"></td>
            <td style="padding-top: 30px"><strong style="font-size: 20px">Serviauto S.L</strong><br>
                CIF: 2516689<br>
                C\ Avd. Andalucia<br>
                CP: 25478 Sevilla<br>
                Sevilla España<br></td>
        </tr>
    </table>

    <h1>{{ __('Sale Details') }} - #{{ $detalles_venta[0]->id_venta }}</h1>

        <table  style="width:98%" border="1">

            <tr style="font-size: 20px;text-align: center; background-color: #30CECA;border: 0px">
                <td style="width: 50%;color: white; font-size: 25px"><strong>@lang('Commercial')</strong></td>
                <td style="width: 50%;color: white; font-size: 25px"><strong>@lang('Customer')</strong></td>
            </tr>

            <tr>
                <td style="width: 50%">
                    <p style="padding-left: 10px">
                        <strong style="font-size: 20px">{{ $detalles_venta[0]->vendedor_name }}<br><br>
                        @lang('Sale'): #{{ $detalles_venta[0]->id_venta }} <br>
                        @lang('Sale Date'): {{Carbon\Carbon::parse($detalles_venta[0]->fecha_venta)->format('d-m-Y') }} <br>
                        Email: {{ $detalles_venta[0]->vendedor_email }}</strong>
                    </p>
                </td>
                <td style="width: 50%">
                     <p  style="padding-left: 10px">
                             <strong style="font-size: 20px">
                                 {{ $detalles_venta[0]->cliente_nombre }}&nbsp;{{ $detalles_venta[0]->cliente_apellidos }}<br><br>
                                 {{ $detalles_venta[0]->cliente_direccion }} <br>
                                 {{ $detalles_venta[0]->cliente_cod_postal }}  - {{ $detalles_venta[0]->cliente_localidad }} <br>
                                 {{ $detalles_venta[0]->cliente_provincia }} ( {{ $detalles_venta[0]->cliente_pais }} )<br>
                                 {{ $detalles_venta[0]->cliente_telefono }}</strong>
                    </p>
                </td>
            </tr>

            <tr>
                <table border="1" style="width: 95%; text-align: center; padding-top: 50px; border: 0px" >
                    <tr class="text-center" style="background-color: #E2E5E5">>
                        <td>@lang('Vehicle Image')</td>
                        <td>@lang('Model')</td>
                        <td>@lang('Licence Plate')</td>
                        <td>@lang('Horsepower')</td>
                        <td>@lang('Transmission')</td>
                        <td>@lang('Fuel')</td>
                        <td>@lang('Colour')</td>
                        <td>@lang('Price')</td>
                    </tr>

                        @foreach ($detalles_vehiculos as $detalle)
                            <tr>
                                <td><img class="img-thumbnail"  width="100" height="100" src="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $detalle->image }}"></td>
                                <td>{{ $detalle-> nombre_modelo }}</td>
                                <td>{{ $detalle-> matricula }}</td>
                                <td>{{ $detalle-> caballos }}</td>
                                <td>{{ $detalle-> tipo_cambio  }}</td>
                                <td style="width: 10px">{{ $detalle-> combustible  }}</td>
                                <td>{{ $detalle-> color  }}</td>
                                <td>{{ $detalle-> precio }} €</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: #E2E5E5">
                            <td class="text-right " colspan="7" style="text-align: right"><strong>@lang('Total Price'): </strong></td>
                            <td style="text-align: right"><strong>{{ $detalles_venta[0]->precio_total }} €</strong></td>
                        </tr>
                </table>
            </tr>
        </table>
    <table style="position: absolute; bottom: 0px" width="100%">
        <tr>
            <td style="color: #95999c; text-align: center">Serviauto Spain 2020 &copy; </td>
        </tr>
    </table>
    </body>
</html>
