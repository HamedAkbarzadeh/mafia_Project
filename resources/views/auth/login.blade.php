<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('customer.home') }}"><img src="{{ asset($logoURL) }}" alt=""></a>
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-1">
                <x-jet-label for="email" class="float-right mb-3" value="{{ __('ایمیل') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" class="float-right mb-3" value="{{ __('پسورد') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center float-right">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('بخاطر بسپار') }}</span>
                </label>
            </div>
            <br>
            <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('هنوز اکانت نساختی ؟') }}
                    </a>


                <x-jet-button class="ml-4">
                    {{ __('ورود') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
