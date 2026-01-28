<div class="modal fade" id="stockHistoryModal" tabindex="-1" role="dialog" aria-labelledby="stockHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockHistoryModalLabel">{{ __('product.stock_history') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h6 id="history_product_name"></h6>
                        <p class="mb-1"><strong>{{ __('product.sku') }}:</strong> <span id="history_sku"></span></p>
                        <p class="mb-0"><strong>{{ __('product.current_stock') }}:</strong> <span id="history_current_stock" class="badge badge-primary"></span></p>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="stockHistoryTable">
                        <thead>
                            <tr>
                                <th>{{ __('common.date') }}</th>
                                <th>{{ __('product.type') }}</th>
                                <th>{{ __('product.quantity') }}</th>
                                <th>{{ __('product.previous_stock') }}</th>
                                <th>{{ __('product.new_stock') }}</th>
                                <th>{{ __('product.note') }}</th>
                                <th>{{ __('common.user') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('common.close') }}</button>
            </div>
        </div>
    </div>
</div>