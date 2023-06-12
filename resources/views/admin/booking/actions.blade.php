@isset($row->id)
    <div class="d-flex flex-row">
        <a href="{{ route('admin.booking.delete', $row->id) }}" onClick="return confirm('Are you sure to accept booking application?')" class="link-danger"><i class="tim-icons icon-trash-simple actions-buttons delete-word"></i></a>
        <a href="{{ route('admin.booking.delete', $row->id) }}" onClick="return confirm('Are you sure to delete this booking application?')" class="link-danger"><i class="tim-icons icon-trash-simple actions-buttons delete-word"></i></a>
    </div>
@endisset
