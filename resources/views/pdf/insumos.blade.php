<div class="container">
    @if (count($insumos) == 0)
        <div style="text-align: center"><p>No hay insumos</p></div>
    @else
    @php
        $cont = 1;
        $total = 0;
    @endphp
        <table class="general" border="1">
            <tr>
                <td style="width: 25%">Paciente: </td>
                <td style="width: 75%" colspan="5">{{$command->patient}}</td>
            </tr>
            <tr>
                <td style="width: 25%">Dirección: </td>
                <td style="width: 75%" colspan="5">{{$command->address}}</td>
            </tr>
            <tr>
                <td style="width: 25%">Diagnóstico: </td>
                <td style="width: 75%" colspan="5">{{$command->diagnostic}}</td>
            </tr>
            <tr>
                <td style="width: 25%">Doctor: </td>
                <td style="width: 75%" colspan="5" >{{$command->doctor}}</td>
            </tr>
            <tr>
                <td style="width: 25%">Enfermer@: </td>
                <td style="width: 75%" colspan="5">{{$command->nurse}}</td>
            </tr>
            <tr>
                <td style="width: 25%">Doctor en turno: </td>
                <td style="width: 75%" colspan="5">{{$command->doctor_shift}}</td>
            </tr>
            <tr>
                <td style="width: 18%">Fecha de ingreso: </td>
                <td style="width: 20%">{{date('d/m/Y h:i a',strtotime($command->date_admission))}}</td>
                <td style="width: 18%">Fecha de egreso: </td>
                <td style="width: 20%">{{$command->date_agress ? date('d/m/Y h:i a',strtotime($command->date_agress)) : ''}}</td>
                <td style="width: 13%">Habitación: </td>
                <td style="width: 11%">{{$command->room->name}}</td>
            </tr>
        </table>
        <br />
        <table class="data" border="1">
            <tr class="tr-head">
                <td style="width: 10%; font-weight: bold">#</td>
                <td style="width: 45%; font-weight: bold">Nombre</td>
                {{-- <td style="width: 20%; font-weight: bold">Descripción</td> --}}
                <td style="width: 15%; font-weight: bold">P. Unitario</td>
                <td style="width: 15%; font-weight: bold">Cantidad</td>
                <td style="width: 15%; font-weight: bold">Importe</td>
            </tr>
            @foreach ($insumos as $insumo)
                <tr>
                    <td>{{$cont}}</td>
                    <td>{{$insumo->name}}</td>
                    {{-- <td>{{$insumo->description}}</td> --}}
                    <td>$ {{number_format($insumo->price, 2, '.', ',')}}</td>
                    <td>{{$insumo->quantity}}</td>
                    <td>$ {{number_format($insumo->total, 2, '.', ',')}}</td>
                </tr>
                @php
                    $cont++;
                    $total += $insumo->total;
                @endphp
            @endforeach
            <tr>
                <td colspan="4">Total: </td>
                <td>$ {{number_format($total, 2, '.', ',')}}</td>
            </tr>
        </table>
    @endif
</div>
<style>
    .container{
        padding: 0;
        margin-right: -22px;
        margin-left: -7px;
    }
    table{
        width: 100%;
    }
    .data, .general{
        font-size: 10pt;
        border-collapse: collapse;
        line-height: 1.4;
    }
    .data tr td{
        padding: 3px 2px;
        text-align: center;
    }
    .tr-head td{
        background-color: rgb(209, 209, 209);
    }

    .general tr td{
        padding: 4px;
        font-size: 10pt;
    }

</style>