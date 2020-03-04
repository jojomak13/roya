<a href="{{ route('admin.orders.show', $id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
@if($status == 'shipping')
@php 
    $data = DNS1D::getBarcodePNG($barcode, 'C39')
    @endphp
<button class="btn btn-success" onclick="printBarCode('{{ $data }}')"><i class="fa fa-print"></i></button>
@endif

@if($status == 'completed')
<a href="{{ route('admin.orders.print', $id) }}" class="btn btn-success"><i class="fa fa-print"></i></a>
@endif

@if($status != 'completed')
    <a href="{{ route('admin.orders.edit', $id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
@endif
<a href="javascript:void(0)" class="delete-btn btn btn-danger">
    <i class="fa fa-trash"></i>
    <form action="{{ route('admin.orders.destroy', $id) }}" method="POST">
        @csrf
        @method('delete')
    </form>
</a>