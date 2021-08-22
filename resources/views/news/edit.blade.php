@extends('layouts.app')

@section('title', 'Projects')

@section('content')
{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Total news: <b><span id="vehiclesCount"></span></b>
                <x-button class="float-right ml-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('Create News') }}
                </x-button>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> --}}
<div>
    <div class="max-w-7xl mt-12 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('news.update', $newsTemp->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-label for="title" :value="__('Title')" />

                        <x-input id="title" class="block mt-1 w-full @error('title') is-invalid @enderror" type="text" name="title" value="{{ $newsTemp->title }}" />
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4">
                      <x-label for="description" :value="__('Description')" />
              
                      <textarea id="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('description') is-invalid @enderror" type="text" name="description">{{ old('description', $newsTemp->description) }}</textarea>
                      @error('description')
                          <div class="invalid-feedback">
                              {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <x-label for="images" :value="__('Images')" class="mt-4 mb-2"/>
                                              <div class="bg-white rounded w-full mx-auto">
                                                <div x-data="dataFileDnD()" class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                                                    <div x-ref="dnd"
                                                        class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                                                        <input accept="*" type="file" name="image"
                                                            class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                                            @change="addFiles($event)"
                                                            @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                                            @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                                            @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                                            title="" />
                                                
                                                        <div class="flex flex-col items-center justify-center py-10 text-center">
                                                            <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            <p class="m-0">Drag your image here or click on the area to upload.</p>
                                                        </div>
                                                    </div>
                                                
                                                    <template x-if="files.length > 0">
                                                        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6" @drop.prevent="drop($event)"
                                                            @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                                            <template x-for="(_, index) in Array.from({ length: files.length })">
                                                                <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                                                    style="padding-top: 100%;" @dragstart="dragstart($event)" @dragend="fileDragging = null"
                                                                    :class="{'border-blue-600': fileDragging == index}" draggable="true" :data-index="index">
                                                                    <button class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button" @click="remove(index)">
                                                                        <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </button>
                                                                    <template x-if="files[index].type.includes('audio/')">
                                                                        <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                                        </svg>
                                                                    </template>
                                                                    <template x-if="files[index].type.includes('application/') || files[index].type === ''">
                                                                        <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                                        </svg>
                                                                    </template>
                                                                    <template x-if="files[index].type.includes('image/')">
                                                                        <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                                            x-bind:src="loadFile(files[index])" />
                                                                    </template>
                                                                    <template x-if="files[index].type.includes('video/')">
                                                                        <video
                                                                            class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                                                            <fileDragging x-bind:src="loadFile(files[index])" type="video/mp4">
                                                                        </video>
                                                                    </template>
                                                
                                                                    {{-- <div class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                                                        <span class="w-full font-bold text-gray-900 truncate"
                                                                            x-text="files[index].name">Loading</span>
                                                                        <span class="text-xs text-gray-900" x-text="humanFileSize(files[index].size)">...</span>
                                                                    </div> --}}
                                                
                                                                    <div class="absolute inset-0 z-40 transition-colors duration-300" @dragenter="dragenter($event)"
                                                                        @dragleave="fileDropping = null"
                                                                        :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </template>
                                                </div>
                                              </div>
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                </div>
                                @enderror
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Save') }}
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
@error('description')
  <script>
      $('#description').addClass('border-red-500');
  </script>
@enderror
@endsection