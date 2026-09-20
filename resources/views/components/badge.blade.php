@php
    $map = [
        'active' => 'success',
        'inactive' => 'secondary',
        'admin' => 'primary',
        'staff' => 'info',
    ];
    $color = $map[$status] ?? 'secondary';
@endphp
<span class="badge bg-{{ $color }} text-capitalize">{{ $status }}</span>
