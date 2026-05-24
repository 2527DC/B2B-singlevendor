<div class="modal fade" id="manage_warehouses_modal" tabindex="-1" role="dialog" aria-labelledby="manageWarehousesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageWarehousesLabel">{{ __('common.assign_warehouses') ?? 'Assign Warehouses' }} (<span id="mw_product_name"></span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="QA_section QA_section_heading_custom check_box_table">
                    <div class="QA_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('common.warehouse') }}</th>
                                    <th>{{ __('common.status') }}</th>
                                </tr>
                            </thead>
                            <tbody id="mw_table_body">
                                <!-- Ajax loaded content -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('common.close') }}</button>
            </div>
        </div>
    </div>
</div>
