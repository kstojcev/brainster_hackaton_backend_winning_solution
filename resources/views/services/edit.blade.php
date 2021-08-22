

@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Form -->
                <form method="POST" action="{{ route('dashboard.services.update', $service) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-label for="title" :value="__('Title')" />

                        <x-input id="title" class="block mt-1 w-full " type="text" name="title" value="{{ old('title', $service->title) }}"/>
                        @error('title')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4" id='update'>
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    @error('title')
        <script>
            $('#title').addClass('border-red-500');
        </script>
    @enderror
@endsection