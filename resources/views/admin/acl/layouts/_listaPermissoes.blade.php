<div class="col-md-12">
    <div class="table-responsive">
        <table class="table no-margin" id="lista_permissions" style="width: 100%;">
            <thead>
                <tr>
                    <td width="3%"><b>#</b></td>
                    <td width="15%"><b>Permissão</b></td>
                    <td><b>Descrição</b></td>
                    <td width="30%"><b>Ações</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $item)
                    <tr>
                        <td> {{ $item->id }} </td>
                        <td> {{ $item->name }} </td>
                        <td> {{ str_limit($item->description, 85) }} </td>
                        <td>
                            @foreach($item->slug as $acao => $value)
                                <label class="label @if($value) label-success @else label-default @endif">{{ $acao }}</label>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>