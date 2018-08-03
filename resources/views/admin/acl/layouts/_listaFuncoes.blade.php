<div class="col-md-12">
    <div class="table-responsive">
        <table class="table no-margin" id="lista_roles" style="width: 100%;">
            <thead>
                <tr>
                    <td width="3%"><b>#</b></td>
                    <td width="15%"><b>Função</b></td>
                    <td width="15%"><b>alias</b></td>
                    <td><b>Descrição</b></td>
                    <td width="10%"> &nbsp; </td>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $item)
                    <tr>
                        <td> {{ $item->id }} </td>
                        <td> {{ $item->name }} </td>
                        <td> {{ $item->slug }} </td>
                        <td> {{ str_limit($item->description, 85) }} </td>
                        <td>
                            <a href="{{ route('acl.show-role', $item->id) }}" class="btn btn-primary btn-sm btn-flat">
                                <i class="fa fa-eye"></i> CONSULTAR
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>