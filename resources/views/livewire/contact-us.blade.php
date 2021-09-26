<div class="flex items-center justify-center">
    <form wire:submit.prevent="store" class="bg-white px-8 pt-6 pb-8 mb-4 lg:w-1/3 sm:max-w-full">
        {{--            <div><img src="img/logo-ghooa.png" width="40%"></div>--}}
        @if(session('message'))
            <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">{{ $project->mail_query_success_title }}</h1>
            <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @else
            @if($errors->any())
                <div class="relative px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                        <span class="absolute inset-y-0 left-0 flex items-center ml-4">
                        </span>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <h1 class="block text-gray-700 font-bold mb-2 text-xl text-center">{{ $project->query_title }}</h1>
            <span>{{ $project->query_message }}</span>
            <div class="mb-4 mt-2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    {{ __('Name') }}
                </label>
                <input wire:model="name" type="text" id="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    {{ __('Email') }}
                </label>
                <input wire:model="email" id="email" value="{{ old('email') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                    {{ __('Phone') }}
                </label>
                <input wire:model="phone" id="phone" value="{{ old('phone') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                    {{ __('Message') }}
                </label>
                <textarea wire:model="message" id="message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('message') }}</textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Send') }}
                </button>
            </div>
        @endif
    </form>
</div>
