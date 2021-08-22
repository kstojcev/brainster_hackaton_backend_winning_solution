@extends('layouts.app')

@section('title', 'VA Dashboard | Services')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="d-flex align-items-center justify-content-between">
                    <b>Total services: <span id="servicesCount">{{ $servicesCount }}</span></b>
                    <x-button class="ml-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ __('Create Service') }}
                    </x-button>
                </div>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="POST" action="{{ route('dashboard.services.add') }}">
                                    @csrf
                                
                                    <div>
                                        <x-label for="title" :value="__('Title')" />
                                
                                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"/>
                                    </div>
                                    @error('title')
                                        <div class="text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                
                                    <div class="flex items-center justify-end mt-4">
                                        <x-button class="ml-4" id='create'>
                                            {{ __('Create') }}
                                        </x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>        
    </div>
    @if($servicesCount > 0)
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 table-responsive">
                    <table id="expensesTable" class="table table-hover text-center">
                        <thead class="thead-light">
                          <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody id="tbodyTable">
                            @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->title }}</td>
                                <td>
                                    <ion-icon name="trash-outline" class="mx-2 text-red-600 delete" data-id="{{ $service->id }}"></ion-icon>
                                    <a href="{{ route('dashboard.services.edit', $service) }}">
                                        <ion-icon name="create-outline"class="mx-2"></ion-icon>
                                    </a>
                                </td>  
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else

@endif
@endsection
@section('scripts')
@if(Session::has('errors'))
        <script>
            $(document).ready(function(){
                $('#exampleModal').modal('show');
            })
        </script>
    @endif
    <script>
        $(document).ready(function(e){
            $(document).on('click', '.delete', function(e){
                let id = $(e.target).data('id');
                
                $.confirm({
                    title: 'Are you sure',
                    content: 'you want to delete this service?',
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                url: '/api/services/'+id,
                                type: 'DELETE',
                                success: function(){
                                    $(e.target).parent().parent().remove();
                                    toastr.success('Success!', 'Service Deleted');
                                    let servicesCount = $('#servicesCount').text()
                                    servicesCount -= 1
                                    $('#servicesCount').text(servicesCount)
                                },
                                error: function(){
                                    toastr.error('Whoops!', 'Something went wrong.');
                                }                      
                            });                            
                        },
                        cancel: function () {
                        }
                    }
                });
            })            
        });
    </script>
    @if (Session::has('created'))
        <script>
            toastr.success('Success!', 'New Service Created!');
        </script>
    @endif
    @if (Session::has('edited'))
        <script>
            toastr.success('Success!', 'Service Edited!');
        </script>
    @endif
    @error('title')
        <script>
            $('#title').addClass('border-red-500');
        </script>
    @enderror
@endsection