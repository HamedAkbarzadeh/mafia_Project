@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-500 float-right">{{ __('اوه ! تعدادی خطا دارید ') }}</div>
        <br>
        <ul class="mt-3 list-inside text-sm text-red-600 float-right">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <br>
        <br>
    </div>
@endif
