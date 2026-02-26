<div class="modal fade" id="stockHistoryModal" tabindex="-1" role="dialog" aria-labelledby="stockHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="max-width: 1400px;">
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

                <!-- Filter by Date Section -->
                <div class="row mb-4 p-3 bg-light rounded">
                    <div class="col-md-12">
                        <h6 class="mb-3">{{ __('product.filter_by_date') }}</h6>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="from_date">{{ __('product.from_date') }}</label>
                            <input type="text" class="form-control" id="from_date" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="to_date">{{ __('product.to_date') }}</label>
                            <input type="text" class="form-control" id="to_date" placeholder="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm w-100 mb-2" id="filterBtn">{{ __('common.filter') }}</button>
                                <button type="button" class="btn btn-secondary btn-sm w-100" id="resetBtn">{{ __('common.reset') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="stockHistoryTable">
                        <thead>
                            <tr>
                                <th>{{ __('common.date') }}</th>
                                <th>{{ __('common.user') }}</th>
                                <th>{{ __('common.action') }}</th>
                                <th>{{ __('product.stock') }}</th>
                                <th>{{ __('product.old_value') }}</th>
                                <th>{{ __('product.new_value') }}</th>
                                <th>{{ __('product.note') }}</th>
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