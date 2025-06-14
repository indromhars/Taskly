<div>
    @if($this->unreadCount > 0)
        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
            {{ $this->unreadCount }}
        </span>
    @endif
</div>
