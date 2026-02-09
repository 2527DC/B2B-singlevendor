<div class="modal fade admin-query" id="manageHistoryModal">
    <div class="modal-dialog modal_1200px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('product.product_history') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-20">
                    <div class="col-lg-12">
                        <div class="box_header common_table_header">
                            <h4 class="mb-0">{{ __('common.filter_by_date') }}</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="primary_input">
                            <label class="primary_input_label" for="history_from_date">{{ __('common.from_date') }}</label>
                            <input class="primary_input_field" type="date" id="history_from_date" name="history_from_date">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="primary_input">
                            <label class="primary_input_label" for="history_to_date">{{ __('common.to_date') }}</label>
                            <input class="primary_input_field" type="date" id="history_to_date" name="history_to_date">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="primary_input">
                            <button type="button" class="primary-btn radius_30px fix-gr-bg mt-20" id="filter_history_btn">
                                {{ __('common.filter') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="primary_input">
                            <button type="button" class="primary-btn radius_30px fix-gr-bg mt-20" id="reset_history_btn">
                                {{ __('common.reset') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table shadow_none" id="history_table">
                                <thead>
                                    <tr>
                                        <th>{{ __('common.date') }}</th>
                                        <th>{{ __('common.user') }}</th>
                                        <th>{{ __('common.action') }}</th>
                                        <th>{{ __('product.stock') }}</th>
                                        <th>{{ __('common.old_value') }}</th>
                                        <th>{{ __('common.new_value') }}</th>
                                        <th>{{ __('common.note') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="history_tbody">
                                    <tr>
                                        <td colspan="7" class="text-center">{{ __('common.loading') }}...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Store product ID for history modal
    let current_product_id = null;

    // Handle manage history button click
    $(document).on('click', '.manage_history', function(e) {
        e.preventDefault();
        current_product_id = $(this).data('id');
        $('#manageHistoryModal').modal('show');
        loadProductHistory(current_product_id);
    });

    // Load product history
    function loadProductHistory(productId, fromDate = null, toDate = null) {
        let url = "{{ route('product.history.get') }}?product_id=" + productId;
        
        if (fromDate) {
            url += "&from_date=" + fromDate;
        }
        if (toDate) {
            url += "&to_date=" + toDate;
        }

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                if (response.status) {
                    displayHistoryData(response.data);
                } else {
                    $('#history_tbody').html('<tr><td colspan="7" class="text-center text-danger">' + response.message + '</td></tr>');
                }
            },
            error: function(xhr) {
                let errorMsg = 'Error loading history';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $('#history_tbody').html('<tr><td colspan="7" class="text-center text-danger">' + errorMsg + '</td></tr>');
            }
        });
    }

    // Display history data in table
    function displayHistoryData(data) {
        if (data.length === 0) {
            $('#history_tbody').html('<tr><td colspan="7" class="text-center">{{ __("common.no_data_found") }}</td></tr>');
            return;
        }

        let html = '';
        $.each(data, function(index, item) {
            html += '<tr>';
            html += '<td>' + formatDate(item.created_at) + '</td>';
            html += '<td>' + item.user_name + '</td>';
            html += '<td><span class="badge badge-primary">' + item.action + '</span></td>';
            html += '<td><small>' + item.field_name + '</small></td>';
            html += '<td>' + item.old_value + '</td>';
            html += '<td>' + item.new_value + '</td>';
            html += '<td><small>' + item.note + '</small></td>';
            html += '</tr>';
        });

        $('#history_tbody').html(html);
    }

    // Format date
    function formatDate(dateString) {
        let date = new Date(dateString);
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }

    // Filter history button
    $('#filter_history_btn').click(function() {
        let fromDate = $('#history_from_date').val();
        let toDate = $('#history_to_date').val();
        
        if (fromDate && toDate && fromDate > toDate) {
            alert('{{ __("common.from_date_must_be_before_to_date") }}');
            return;
        }

        loadProductHistory(current_product_id, fromDate, toDate);
    });

    // Reset filter button
    $('#reset_history_btn').click(function() {
        $('#history_from_date').val('');
        $('#history_to_date').val('');
        loadProductHistory(current_product_id);
    });
});
</script>
@endpush
