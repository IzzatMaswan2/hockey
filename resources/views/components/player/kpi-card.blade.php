@props(['title', 'value', 'color' => 'purple'])

<div class="bg-white rounded-xl shadow p-5">
    <p class="text-sm text-gray-500">{{ $title }}</p>
    <p class="text-3xl font-bold text-{{ $color }}-700">{{ $value }}</p>
</div>
