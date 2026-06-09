@extends('backEnd.master')

@section('mainContent')
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title d-md-flex justify-content-between align-items-center mb-30">
                    <h3 class="mb-0">
                        {{ __('google_workspace.sheets_files') }}
                    </h3>
                    @if($connected)
                        <button class="primary-btn radius_30px fix-gr-bg" data-toggle="modal" data-target="#createSpreadsheetModal">
                            <i class="fas fa-file-excel mr-2"></i>{{ __('google_workspace.create_spreadsheet') }}
                        </button>
                    @endif
                </div>
            </div>
        </div>

        @if(!$connected)
            <!-- Disconnected State -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box text-center p-5">
                        <div style="font-size: 60px; color: #E74C3C; margin-bottom: 20px;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h3 class="mb-20">{{ __('google_workspace.connection_required') }}</h3>
                        <a href="{{ route('google-workspace.settings') }}" class="primary-btn fix-gr-bg">
                            {{ __('google_workspace.google_workspace') }}
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Spreadsheets List -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table">
                                <div class="table-responsive">
                                    <table class="table Crm_table_active3">
                                        <thead>
                                            <tr>
                                                <th width="50%">Spreadsheet Name</th>
                                                <th width="25%">{{ __('google_workspace.last_modified') }}</th>
                                                <th width="25%">{{ __('google_workspace.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($spreadsheets as $sheet)
                                                <tr>
                                                    <td>
                                                        <span style="font-size: 16px; color: #27ae60; margin-right: 10px;">
                                                            <i class="fas fa-file-excel"></i>
                                                        </span>
                                                        <a href="{{ route('google-workspace.sheets.view', $sheet->getId()) }}" style="font-weight: 500; color: #2C3E50;">
                                                            {{ $sheet->getName() }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($sheet->getModifiedTime())->timezone(Session::get('time_zone', 'UTC'))->format('Y-m-d h:i A') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('google-workspace.sheets.view', $sheet->getId()) }}" class="primary-btn radius_30px small fix-gr-bg">
                                                            <i class="fas fa-eye mr-1"></i> {{ __('google_workspace.view') }}
                                                        </a>
                                                        <a href="https://docs.google.com/spreadsheets/d/{{ $sheet->getId() }}/edit" target="_blank" class="primary-btn radius_30px small fix-gr-bg" style="background: #27ae60; border: none; margin-left: 5px;">
                                                            <i class="fas fa-external-link-alt mr-1"></i> Open in Sheets
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center p-5">
                                                        <span class="text-muted">No spreadsheets found.</span>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Spreadsheet Modal -->
            <div class="modal fade" id="createSpreadsheetModal" tabindex="-1" role="dialog" aria-labelledby="createSpreadsheetModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createSpreadsheetModalLabel">{{ __('google_workspace.create_spreadsheet') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('google-workspace.sheets.create') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="sheet_title">Spreadsheet Title <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" type="text" name="title" id="sheet_title" placeholder="Enter spreadsheet title" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="primary-btn radius_30px bg-secondary text-white" data-dismiss="modal">Close</button>
                                <button type="submit" class="primary-btn radius_30px fix-gr-bg">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
