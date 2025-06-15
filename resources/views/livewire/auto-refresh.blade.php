<div x-data="{ key: @entangle('refreshKey') }" x-init="$watch('key', () => { $wire.$refresh() })"></div>
