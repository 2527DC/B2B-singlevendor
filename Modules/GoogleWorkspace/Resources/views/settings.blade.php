@extends('backEnd.master')

@section('mainContent')
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-30">
                        {{ __('google_workspace.google_workspace_settings') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Settings Form -->
            <div class="col-lg-7">
                <div class="white-box">
                    <div class="add-visitor">
                        <form action="{{ route('google-workspace.settings.save') }}" method="POST">
                            @csrf
                            <div class="row mt-15">
                                <div class="col-lg-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="client_id">{{ __('google_workspace.client_id') }} <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" type="text" name="client_id" id="client_id" autocomplete="off" value="{{ old('client_id', $token->client_id ?? '') }}" required>
                                        @error('client_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="client_secret">{{ __('google_workspace.client_secret') }} <span class="text-danger">*</span></label>
                                        <input class="primary_input_field" type="password" name="client_secret" id="client_secret" autocomplete="off" value="{{ old('client_secret', $token->client_secret ?? '') }}" required>
                                        @error('client_secret')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="redirect_uri">{{ __('google_workspace.redirect_uri') }}</label>
                                        <div class="input-group">
                                            <input class="primary_input_field" type="text" id="redirect_uri" value="{{ route('google-workspace.oauth-callback') }}" readonly style="background-color: #f1f2f6; cursor: text;">
                                            <div class="input-group-append">
                                                <button class="primary-btn small fix-gr-bg" type="button" onclick="copyRedirectUri()">Copy</button>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="font-size: 11px; margin-top: 5px; display: block;">
                                            * Copy this URI and paste it in the "Authorized redirect URIs" section of your Google Cloud Console Credentials.
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg">
                                        <span class="ti-check"></span>
                                        {{ __('google_workspace.save_settings') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Connection Status -->
            <div class="col-lg-5">
                <div class="white-box">
                    <div class="main-title">
                        <h4 class="mb-20">Connection</h4>
                    </div>
                    <div style="border-radius: 10px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 30px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <div style="font-size: 40px; color: #4285F4; margin-bottom: 15px;">
                            <i class="fab fa-google"></i>
                        </div>
                        <h4 style="font-weight: 600; margin-bottom: 10px; color: #2C3E50;">Google Account</h4>
                        
                        @if($token && $token->access_token)
                            <div class="mt-15 mb-25">
                                <span class="badge badge-success" style="background-color: #2ECC71; font-size: 14px; padding: 8px 16px; border-radius: 20px;">
                                    <i class="fas fa-check-circle mr-1"></i> {{ __('google_workspace.connected') }}
                                </span>
                            </div>
                            <a href="{{ route('google-workspace.settings.disconnect') }}" class="primary-btn fix-gr-bg" style="background: #E74C3C; border: none; min-width: 180px;">
                                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('google_workspace.disconnect') }}
                            </a>
                        @else
                            <div class="mt-15 mb-25">
                                <span class="badge badge-secondary" style="background-color: #95A5A6; font-size: 14px; padding: 8px 16px; border-radius: 20px;">
                                    <i class="fas fa-times-circle mr-1"></i> {{ __('google_workspace.not_connected') }}
                                </span>
                            </div>
                            @if($token && $token->client_id && $token->client_secret)
                                <a href="{{ route('google-workspace.settings.connect') }}" class="primary-btn fix-gr-bg" style="min-width: 180px; background: linear-gradient(to right, #4285F4, #34A853);">
                                    <i class="fab fa-google mr-2"></i> {{ __('google_workspace.connect') }}
                                </a>
                            @else
                                <button class="primary-btn fix-gr-bg" style="min-width: 180px; opacity: 0.6; cursor: not-allowed;" disabled>
                                    <i class="fab fa-google mr-2"></i> {{ __('google_workspace.connect') }}
                                </button>
                                <span class="text-danger mt-10" style="display: block; font-size: 11px;">
                                    * Please configure Client ID and Secret first to connect.
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function copyRedirectUri() {
    var copyText = document.getElementById("redirect_uri");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    navigator.clipboard.writeText(copyText.value);
    
    // Simple feedback toast
    if (typeof toastr !== 'undefined') {
        toastr.success('Redirect URI copied to clipboard!');
    } else {
        alert('Redirect URI copied to clipboard!');
    }
}
</script>
@endsection
