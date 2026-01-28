<div class="modal fade" id="manageStockModal" tabindex="-1" role="dialog" aria-labelledby="manageStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageStockModalLabel">{{ __('product.manage_stock') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="manageStockForm">
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" id="product_type" name="product_type">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="product_name">{{ __('product.product_name') }}</label>
                                <input type="text" class="form-control" id="product_name" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sku">{{ __('product.sku') }}</label>
                                <input type="text" class="form-control" id="sku" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_stock">{{ __('product.current_stock') }}</label>
                                <input type="text" class="form-control" id="current_stock" readonly>
                            </div>
                        </div>
                        
                        <!-- For Simple Products -->
                        <div id="simple_stock_section" class="col-md-12" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock_type">{{ __('product.stock_type') }}</label>
                                        <select class="form-control" id="stock_type" name="stock_type">
                                            <option value="add">{{ __('product.add_stock') }}</option>
                                            <option value="subtract">{{ __('product.subtract_stock') }}</option>
                                            <option value="set">{{ __('product.set_stock') }}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">{{ __('product.quantity') }} *</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_stock">{{ __('product.new_stock') }}</label>
                                        <input type="text" class="form-control" id="new_stock" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- For Variable Products (will show SKU list) -->
                        <div id="variable_stock_section" class="col-md-12" style="display: none;">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="skuStockTable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('product.sku') }}</th>
                                            <th>{{ __('product.variation') }}</th>
                                            <th>{{ __('product.current_stock') }}</th>
                                            <th>{{ __('product.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Will be populated by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note">{{ __('product.note') }}</label>
                                <textarea class="form-control" id="note" name="note" rows="3" placeholder="{{ __('product.enter_note') }}"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- SKU Stock Update Modal (for variable products) -->
                <div class="modal fade" id="skuStockModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('product.update_sku_stock') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="skuStockForm">
                                    <input type="hidden" id="sku_id" name="sku_id">
                                    <input type="hidden" id="sku_product_id" name="product_id">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku_name">{{ __('product.sku') }}</label>
                                                <input type="text" class="form-control" id="sku_name" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku_current_stock">{{ __('product.current_stock') }}</label>
                                                <input type="text" class="form-control" id="sku_current_stock" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sku_stock_type">{{ __('product.stock_type') }}</label>
                                                <select class="form-control" id="sku_stock_type" name="stock_type">
                                                    <option value="add">{{ __('product.add_stock') }}</option>
                                                    <option value="subtract">{{ __('product.subtract_stock') }}</option>
                                                    <option value="set">{{ __('product.set_stock') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sku_quantity">{{ __('product.quantity') }} *</label>
                                                <input type="number" class="form-control" id="sku_quantity" name="quantity" min="1" value="1">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sku_new_stock">{{ __('product.new_stock') }}</label>
                                                <input type="text" class="form-control" id="sku_new_stock" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sku_note">{{ __('product.note') }}</label>
                                                <textarea class="form-control" id="sku_note" name="note" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('common.cancel') }}</button>
                                <button type="button" class="btn btn-primary" id="updateSkuStockBtn">{{ __('common.update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('common.close') }}</button>
                <button type="button" class="btn btn-primary" id="updateStockBtn">{{ __('common.update_stock') }}</button>
            </div>
        </div>
    </div>
</div>