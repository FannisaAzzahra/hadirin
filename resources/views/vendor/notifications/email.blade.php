<x-mail::message>
{{-- Salam Pembuka --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Mohon Maaf!
@else
# Halo!
@endif
@endif

{{-- Kalimat Pembuka --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Tombol Aksi --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success' => 'success',
        'error' => 'error', 
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Kalimat Penutup --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salam Penutup --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Hormat kami,<br>
Tim {{ config('app.name') }}
@endif

{{-- Teks Tambahan --}}
@isset($actionText)
<x-slot:subcopy>
Jika Anda mengalami kesulitan dalam mengklik tombol "{{ $actionText }}", silakan salin dan tempelkan 
tautan berikut ini ke dalam browser web Anda:
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>