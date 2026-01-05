<div class="single_role_blocks">

    @php
        // SAFE module name (avoid array issues)
        $moduleName = is_array(__($Module->translation ?? $Module->name))
            ? ($Module->name ?? '')
            : __($Module->translation ?? $Module->name);
    @endphp

    <div class="single_permission" id="{{ $Module->id }}">
        <div class="permission_header d-flex align-items-center justify-content-between">
            <div>
                <input
                    type="checkbox"
                    name="module_id[]"
                    value="{{ $Module->id }}"
                    id="Main_Module_{{ $key }}"
                    class="common-radio permission-checkAll main_module_id_{{ $Module->id }}"
                    {{ $role->permissions->contains('id', $Module->id) ? 'checked' : '' }}
                >
                <label for="Main_Module_{{ $key }}">
                    {{ $moduleName }}
                </label>
            </div>

            <div class="arrow collapsed"
                 data-toggle="collapse"
                 data-target="#Role{{ $Module->id }}">
            </div>
        </div>

        <div id="Role{{ $Module->id }}" class="collapse">
            <div class="permission_body">
                <ul>

                    @foreach ($SubMenuList->where('parent_id', $Module->id) as $SubMenu)

                        {{-- Module specific skips --}}
                        @if(isModuleActive('MultiVendor') && $SubMenu->name === 'Company Reviews')
                            @continue
                        @endif

                        @if(app('theme')->folder_path === 'amazy')
                            @if($SubMenu->route === 'frontendcms.features.index')
                                @continue
                            @endif
                        @elseif(app('theme')->folder_path === 'default')
                            @if(
                                $SubMenu->route === 'frontendcms.ads_bar.index' ||
                                $SubMenu->route === 'frontendcms.promotionbar.index' ||
                                $SubMenu->route === 'frontendcms.login_page'
                            )
                                @continue
                            @endif
                        @endif

                        @if(!$SubMenu->module || isModuleActive($SubMenu->module))

                            @php
                                // SAFE submenu label
                                $subMenuLabel = is_array(__($SubMenu->translation ?? $SubMenu->name))
                                    ? ($SubMenu->name ?? '')
                                    : __($SubMenu->translation ?? $SubMenu->name);
                            @endphp

                            <li>
                                <div class="submodule">
                                    <input
                                        id="Sub_Module_{{ $SubMenu->id }}"
                                        name="module_id[]"
                                        value="{{ $SubMenu->id }}"
                                        class="infix_csk common-radio module_id_{{ $Module->id }} module_link"
                                        {{ $role->permissions->contains('id', $SubMenu->id) ? 'checked' : '' }}
                                        type="checkbox"
                                    >

                                    <label for="Sub_Module_{{ $SubMenu->id }}">
                                        @if($SubMenu->name === 'Seller Reviews')
                                            {{ isModuleActive('MultiVendor')
                                                ? __('Seller Reviews')
                                                : __('review.company_reviews') }}
                                        @elseif($SubMenu->name === 'Inhouse Product Sale')
                                            {{ isModuleActive('MultiVendor')
                                                ? $subMenuLabel
                                                : __('product.product_sale') }}
                                        @else
                                            {{ $subMenuLabel }}
                                        @endif
                                    </label>
                                    <br>
                                </div>

                                <ul class="option">
                                    @foreach ($ActionList->where('parent_id', $SubMenu->id) as $action)

                                        @if(!$action->module || isModuleActive($action->module))

                                            @php
                                                // SAFE action name
                                                $actionName = is_array(__($action->translation ?? $action->name))
                                                    ? ($action->name ?? '')
                                                    : __($action->translation ?? $action->name);
                                            @endphp

                                            <li>
                                                <div class="module_link_option_div" id="{{ $SubMenu->id }}">
                                                    <input
                                                        id="Option_{{ $action->id }}"
                                                        name="module_id[]"
                                                        value="{{ $action->id }}"
                                                        class="infix_csk common-radio
                                                               module_id_{{ $Module->id }}
                                                               module_option_{{ $Module->id }}_{{ $SubMenu->id }}
                                                               module_link_option"
                                                        {{ $role->permissions->contains('id', $action->id) ? 'checked' : '' }}
                                                        type="checkbox"
                                                    >

                                                    <label for="Option_{{ $action->id }}">
                                                        {{ $actionName }}
                                                    </label>
                                                    <br>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>

                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
