@extends('backEnd.master')

@section('mainContent')
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title d-md-flex justify-content-between align-items-center mb-30">
                    <h3 class="mb-0">
                        {{ __('google_workspace.drive_files') }}
                    </h3>
                    @if($connected)
                        <div class="d-flex align-items-center">
                            <button class="primary-btn radius_30px mr-10 fix-gr-bg" data-toggle="modal" data-target="#createFolderModal">
                                <i class="fas fa-folder-plus mr-2"></i>{{ __('google_workspace.create_folder') }}
                            </button>
                            <button class="primary-btn radius_30px fix-gr-bg" data-toggle="modal" data-target="#createFileModal">
                                <i class="fas fa-file-plus mr-2"></i>{{ __('google_workspace.create_file') }}
                            </button>
                        </div>
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
            <!-- Files List Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table">
                                <div class="table-responsive">
                                    <table class="table Crm_table_active3">
                                        <thead>
                                            <tr>
                                                <th width="50%">{{ __('google_workspace.file_name') }}</th>
                                                <th width="15%">{{ __('google_workspace.file_type') }}</th>
                                                <th width="20%">{{ __('google_workspace.last_modified') }}</th>
                                                <th width="10%">{{ __('google_workspace.size') }}</th>
                                                <th width="5%">{{ __('google_workspace.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($files as $file)
                                                @php
                                                    $mime = $file->getMimeType();
                                                    $icon = 'fas fa-file';
                                                    $iconColor = '#7f8c8d';
                                                    $typeLabel = 'File';
                                                    
                                                    if ($mime === 'application/vnd.google-apps.folder') {
                                                        $icon = 'fas fa-folder';
                                                        $iconColor = '#f39c12';
                                                        $typeLabel = 'Folder';
                                                    } elseif ($mime === 'application/vnd.google-apps.spreadsheet') {
                                                        $icon = 'fas fa-file-excel';
                                                        $iconColor = '#27ae60';
                                                        $typeLabel = 'Spreadsheet';
                                                    } elseif ($mime === 'application/vnd.google-apps.document') {
                                                        $icon = 'fas fa-file-word';
                                                        $iconColor = '#2980b9';
                                                        $typeLabel = 'Document';
                                                    } elseif ($mime === 'text/plain') {
                                                        $icon = 'fas fa-file-alt';
                                                        $iconColor = '#16a085';
                                                        $typeLabel = 'Text File';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <span style="font-size: 16px; color: {{ $iconColor }}; margin-right: 10px;">
                                                            <i class="{{ $icon }}"></i>
                                                        </span>
                                                        @if ($mime === 'application/vnd.google-apps.spreadsheet')
                                                            <a href="{{ route('google-workspace.sheets.view', $file->getId()) }}" style="font-weight: 500; color: #2C3E50;">
                                                                {{ $file->getName() }}
                                                            </a>
                                                        @else
                                                            <span style="font-weight: 500; color: #2C3E50;">{{ $file->getName() }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light" style="font-size: 11px; padding: 4px 8px; border-radius: 4px;">{{ $typeLabel }}</span>
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($file->getModifiedTime())->timezone(Session::get('time_zone', 'UTC'))->format('Y-m-d h:i A') }}
                                                    </td>
                                                    <td>
                                                        @if($file->getSize())
                                                            {{ round($file->getSize() / 1024, 2) }} KB
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $file->getId() }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 2px 10px; background: transparent; border: none; color: #7f8c8d;">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $file->getId() }}">
                                                                @if ($mime === 'application/vnd.google-apps.spreadsheet')
                                                                    <a class="dropdown-item" href="{{ route('google-workspace.sheets.view', $file->getId()) }}">
                                                                        <i class="fas fa-eye mr-2 text-info"></i> {{ __('google_workspace.view') }}
                                                                    </a>
                                                                @endif
                                                                <form action="{{ route('google-workspace.drive.delete', $file->getId()) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-trash-alt mr-2 text-danger"></i> {{ __('google_workspace.delete') }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center p-5">
                                                        <span class="text-muted">No files found.</span>
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

            <!-- Create Folder Modal -->
            <div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createFolderModalLabel">{{ __('google_workspace.create_folder') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('google-workspace.drive.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="folder">
                            <div class="modal-body">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="folder_name">Folder Name <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" type="text" name="name" id="folder_name" placeholder="Enter folder name" required>
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

            <!-- Create File Modal -->
            <div class="modal fade" id="createFileModal" tabindex="-1" role="dialog" aria-labelledby="createFileModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createFileModalLabel">{{ __('google_workspace.create_file') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('google-workspace.drive.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="file">
                            <div class="modal-body">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="file_name">File Name <span class="text-danger">*</span></label>
                                    <input class="primary_input_field" type="text" name="name" id="file_name" placeholder="example.txt" required>
                                </div>
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="content">File Content</label>
                                    <textarea class="primary_input_field" name="content" id="content" placeholder="Enter text content here..." style="height: 150px; padding: 10px;"></textarea>
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
