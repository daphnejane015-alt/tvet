@props(['status'])

@if ($status)
    <div class="mb-4 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-xs text-emerald-800">
        <div class="flex items-start gap-2">
            <span class="text-lg">✓</span>
            <div>
                <strong class="font-bold block mb-1">Berjaya</strong>
                {{ $status }}
            </div>
        </div>
    </div>
@endif
