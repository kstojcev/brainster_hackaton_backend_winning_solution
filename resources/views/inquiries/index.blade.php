@extends('layouts.app')

@section('title', 'VA Dashboard | Inquiries')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 table-responsive">
                <b>Total inquiries: <span id="inquiriesCount">{{ $inquiriesCount }}</span></b>

                <table id="expensesTable" class="table table-hover text-center mt-4">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Message</th>
                        <th>Scheme</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="tbodyTable">
                        @foreach ($inquiries as $inquiry)
                            <tr class="@if(!$inquiry->active) ? ' ' : custom-grey text-gray-200 @endif">
                                <td>{{ $inquiry->first_name . " " . $inquiry->last_name }}</td>
                                <td>{{ $inquiry->company }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->phone }}</td>
                                <td>{{ $inquiry->location }}</td>
                                <td>{{ $inquiry->message }}</td>
                                <td>
                                    @if($inquiry->scheme)
                                    <a href="{{ route('inquiry.download', $inquiry->id) }}" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Download</a>
                                    @else 
                                    <span>No scheme</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button>
                                        <ion-icon name="trash-outline" class="mx-2 text-red-600 delete" data-id="{{ $inquiry->id }}"></ion-icon>
                                    </button>
                                    <div class="relative inline-block w-10 mx-2 align-middle select-none transition duration-200 ease-in">
                                        <input type="checkbox" name="toggle" id="toggle{{$inquiry->id}}" data-id="{{ $inquiry->id }}" @if($inquiry->active) ? checked='true' : '' @endif class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer inquiry-switch"/>
                                        <label for="toggle{{$inquiry->id}}" class="toggle-label block overflow-hidden h-5 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {!! $inquiries->onEachSide(3)->links() !!}

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
<script>
    $(document).ready(function(){
        $(document).on('click', '.delete', function(e) {
        let id = $(e.target).data('id');
        console.log(id)
                $.confirm({
                    title: 'Are you sure',
                    content: 'you want to delete this project?',
                    buttons: {
                        confirm: function () {
                          $.ajax({
                              url: '/api/inquiry/delete/'+id,
                              type: 'DELETE',
                              headers: {
                                  'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                              },
                              success: function() {
                              $(e.target).parent().parent().parent().remove();
                              toastr.success('Success!', 'Inquiry Deleted')
                              let inquiriesCount = $('#inquiriesCount').text()
                              inquiriesCount -= 1
                              $('#inquiriesCount').text(inquiriesCount)
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
        });

        $(document).on('click', '.inquiry-switch', function(e) {
            let id = ''
            id = $(e.target).data('id');
            let switch_value = $('.inquiry-switch').prop('checked');
            let url = ''
            if(switch_value == true){
                url = ''
                url = 'activate'
            } else {
                url = ''
                url = 'deactivate'
            }
            let route = 
            $.ajax({
                url: '/api/inquiry/'+url+'/'+id,
                type: 'POST',
                data: {'switch_value': switch_value},
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    if(switch_value == true){
                        toastr.success('Inquiry Activated')
                        $(e.target).parent().parent().parent().removeClass('custom-grey text-gray-200')
                    }else if(switch_value == false) {
                        toastr.success('Inquiry Deactivated')
                        $(e.target).parent().parent().parent().addClass('custom-grey text-gray-200')

                    }
                },
                error: function(){
                    toastr.error('Whoops!', 'Something went wrong.');
                }  
            });
        })
    })
</script>
@endsection
    