@if($items->count() > 0)
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Badges</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr id="item-{{ $item->id }}">
                        <td>
                            @if($item->photo)
                                <img src="{{ asset('storage/' . $item->photo) }}" width="40" height="40"
                                    class="rounded me-2 object-fit-cover" alt="">
                            @endif
                            <strong>{{ $item->name }}</strong>
                            @if($item->is_featured)
                                <span title="Featured">⭐</span>
                            @endif
                            @if($item->is_new)
                                <span title="New">🆕</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ Str::limit($item->description, 50) }}</td>
                        <td>{{ number_format($item->price, 2) }} MAD</td>
                        <td>
                            @foreach($item->dietary_badges as $badge)
                                <span class="badge me-1" style="background:{{ $badge['color'] }}">{{ $badge['label'] }}</span>
                            @endforeach
                        </td>
                        <td>
                                <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger btn-delete-item"
                                data-id="{{ $item->id }}"
                                title="Delete">
                                <x-icon_trash />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-muted text-center py-3">No items in this section.</p>
@endif
