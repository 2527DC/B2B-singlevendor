@push('scripts')
    <script type="text/javascript">
        (function($){
            "use strict";
            var baseUrl = $('#app_base_url').val();
            $(document).ready(function () {

                $(document).on("submit", "#processForm", function (event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                @if(isModuleActive('FrontendMultiLang'))
                    $('#name_create_error_{{auth()->user()->lang_code}}').text('');
                    $('#description_create_error_{{auth()->user()->lang_code}}').text('');
                @else
                    $('#name_create_error').text('');
                    $('#description_create_error').text('');
                @endif
                    let formData = $(this).serializeArray();
                    $.ajax({
                        url: "{{ route('order_manage.process_store') }}",
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        type: "POST",
                        dataType: "JSON",
                        success: function (response) {
                            toastr.success("{{__('common.added_successfully')}}","{{__('common.success')}}")
                            $("#processForm").trigger("reset");
                            refund_process_list();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function (response) {

                        if(response.responseJSON.error){
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                            return false;
                        }
                            if (response) {
                                @if(isModuleActive('FrontendMultiLang'))
                                    $('#name_create_error_{{auth()->user()->lang_code}}').text(response.responseJSON.errors['name.{{auth()->user()->lang_code}}']);
                                    $('#description_create_error_{{auth()->user()->lang_code}}').text(response.responseJSON.errors['description.{{auth()->user()->lang_code}}']);
                                @else
                                    $('#name_create_error').text(response.responseJSON.errors.name);
                                    $('#description_create_error').text(response.responseJSON.errors.description);
                                @endif
                            }
                            toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                            $('#pre-loader').addClass('d-none');
                        }
                    });
                });
                //
                $(document).on("submit", "#processEditForm", function (event) {
                    event.preventDefault();
                    $('#pre-loader').removeClass('d-none');
                    let id = $(".edit_id").val();
                    @if(isModuleActive('FrontendMultiLang'))
                        $('#edit_name_error_{{auth()->user()->lang_code}}').text('');
                        $('#edit_description_error_{{auth()->user()->lang_code}}').text('');
                    @else
                        $('#edit_name_error').text('');
                        $('#edit_description_error').text('');
                    @endif
                    var formElement = $(this).serializeArray()
                    var formData = new FormData();
                    formElement.forEach(element => {
                        formData.append(element.name, element.value);
                    });
                    formData.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url: "{{route('admin.delivery-process.update')}}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {
                            $("#processEditForm").trigger("reset");
                            $('.edit_div').hide();
                            toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}")
                            $('.create_div').show();
                            $('#name_create_error').html('');
                            $('#description_create_error').html('');
                            refund_process_list();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function(response) {
                            $('#pre-loader').addClass('d-none');
                            if(response.responseJSON && response.responseJSON.error){
                                toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                return false;
                            }
                            if (response.responseJSON && response.responseJSON.errors) {
                            @if(isModuleActive('FrontendMultiLang'))
                                let nameError = response.responseJSON.errors['name.{{auth()->user()->lang_code}}'];
                                let descError = response.responseJSON.errors['description.{{auth()->user()->lang_code}}'];
                                if(nameError) $('#edit_name_error_{{auth()->user()->lang_code}}').text(nameError);
                                if(descError) $('#edit_description_error_{{auth()->user()->lang_code}}').text(descError);
                            @else
                                if(response.responseJSON.errors.name) $('#edit_name_error').text(response.responseJSON.errors.name);
                                if(response.responseJSON.errors.description) $('#edit_description_error').text(response.responseJSON.errors.description);
                            @endif
                            } else {
                                toastr.error("{{__('common.error_message')}}" ,"{{__('common.error')}}");
                            }
                        }
                    });
                });


                $("#refund_process_list").on("click", ".edit_reason", function () {
                    let item = $(this).data("value");
                    // Parse JSON if it's a string
                    if (typeof item === 'string') {
                        item = JSON.parse(item);
                    }
                    
                    // Debug log to verify the item data
                    console.log('Edit item:', item);
                    
                    // Ensure we have an ID
                    if (!item.id) {
                        toastr.error("Invalid item data: missing ID", "{{__('common.error')}}");
                        return false;
                    }
                    
                    // Set the ID in the hidden field
                    $(".edit_id").val(item.id);
                    
                    $('.edit_div').show();
                    $('.edit_div').removeClass("d-none");
                    $('.create_div').hide();
                    @if(isModuleActive('FrontendMultiLang'))
                    if (item.name != null && typeof item.name === 'object') {
                        $.each(item.name, function( key, value ) {
                            $("#name"+key).val(value);
                        });
                    }else{
                        $("#name{{auth()->user()->lang_code}}").val(item.translateName || item.name);
                    }
                    if (item.description != null && typeof item.description === 'object') {
                        $.each(item.description, function( key, value ) {
                            $("#description"+key).val(value);
                        });
                    }else{
                        $("#description{{auth()->user()->lang_code}}").val(item.TranslateDescription || item.description);
                    }
                    @else

                    if(typeof item.name === 'object' && item.name !== null)
                    {
                        $(".name").val(item.name.en || item.name);
                    }else{
                        $(".name").val(item.name);
                    }

                    if(typeof item.description === 'object' && item.description !== null)
                    {
                        $(".description").val(item.description.en || item.description);
                    }else{
                        $(".description").val(item.description);
                    }

                    @endif
                });

                $(document).on('click', '.delete_item', function(event){
                    event.preventDefault();
                    let url = $(this).data('value');
                    confirm_modal(url);
                });

                function refund_process_list() {
                    $('#pre-loader').removeClass('d-none');
                    $.ajax({
                        url: "{{route("order_manage.process_list")}}",
                        type: "GET",
                        dataType: "HTML",
                        success: function (response) {
                            $("#refund_process_list").html(response);
                            CRMTableThreeReactive();
                            $('#pre-loader').addClass('d-none');
                        },
                        error: function (error) {

                        }
                    });
                }
            });
        })(jQuery);
    </script>
@endpush
