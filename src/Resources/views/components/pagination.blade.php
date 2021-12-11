@if (isset($object) && $object instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $object->links() }}
@endif
