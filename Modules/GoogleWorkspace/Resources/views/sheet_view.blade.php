@extends('backEnd.master')

@section('mainContent')
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <!-- Breadcrumb / Header -->
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title d-md-flex justify-content-between align-items-center mb-30">
                    <div>
                        <span class="text-success" style="font-size: 24px; margin-right: 10px;">
                            <i class="fas fa-file-excel"></i>
                        </span>
                        <h3 class="d-inline-block">{{ $spreadsheetTitle }}</h3>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="https://docs.google.com/spreadsheets/d/{{ $spreadsheetId }}/edit" target="_blank" class="primary-btn radius_30px small fix-gr-bg mr-10" style="background: #27ae60; border: none;">
                            <i class="fas fa-external-link-alt mr-1"></i> Open in Sheets
                        </a>
                        <a href="{{ route('google-workspace.sheets') }}" class="primary-btn radius_30px small fix-gr-bg">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Sheets
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sheet Selector Tabs -->
        <div class="row mb-25">
            <div class="col-lg-12">
                <div class="white-box" style="padding: 15px 20px;">
                    <span class="mr-15" style="font-weight: 500; color: #7f8c8d;">{{ __('google_workspace.worksheet') }}:</span>
                    @foreach($worksheets as $sheetName)
                        <a href="{{ route('google-workspace.sheets.view', ['id' => $spreadsheetId, 'sheet' => $sheetName]) }}" 
                           class="primary-btn radius_30px small @if($activeSheet === $sheetName) fix-gr-bg @else bg-secondary text-white @endif mr-10 mb-5" 
                           style="padding: 5px 15px; font-size: 12px; display: inline-block;">
                            {{ $sheetName }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Data Grid Table -->
            <div class="col-lg-8">
                <div class="white-box">
                    <div class="main-title mb-20">
                        <h4>Data Grid ({{ $activeSheet }})</h4>
                    </div>
                    <div class="QA_section check_box_table">
                        <div class="QA_table">
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-bordered">
                                    <tbody>
                                        @forelse($rows as $rowIndex => $row)
                                            <tr>
                                                @if($rowIndex === 0)
                                                    <!-- Use first row as headers -->
                                                    @foreach($row as $colValue)
                                                        <th style="background-color: #f1f2f6; font-weight: 600; color: #2c3e50;">{{ $colValue }}</th>
                                                    @endforeach
                                                @else
                                                    <!-- Regular Data Rows -->
                                                    @foreach($row as $colValue)
                                                        <td>{{ $colValue }}</td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center p-5">
                                                    <span class="text-muted">No rows found in this worksheet.</span>
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

            <!-- Append Row Form -->
            <div class="col-lg-4">
                <div class="white-box">
                    <div class="main-title mb-20">
                        <h4>{{ __('google_workspace.add_row') }}</h4>
                    </div>
                    <form action="{{ route('google-workspace.sheets.append', $spreadsheetId) }}" method="POST">
                        @csrf
                        <input type="hidden" name="sheet_name" value="{{ $activeSheet }}">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="row_data">Row Data <span class="text-danger">*</span></label>
                                    <textarea class="primary_input_field" name="row_data" id="row_data" placeholder="Name, Email, Phone" style="height: 120px; padding: 10px;" required>{{ old('row_data') }}</textarea>
                                    <span class="text-muted" style="font-size: 11px; margin-top: 5px; display: block; line-height: 1.4;">
                                        Enter comma-separated values (e.g. <code>John Doe, john@example.com, Admin</code>) or a JSON array (e.g. <code>["John Doe", "john@example.com", "Admin"]</code>).
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-15">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg w-100">
                                    <i class="fas fa-plus mr-1"></i> Append Row
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
