<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'admin', 'permission'])->prefix('google-workspace')->group(function () {
    // Settings
    Route::get('/settings', 'GoogleWorkspaceSettingsController@index')->name('google-workspace.settings');
    Route::post('/settings/save', 'GoogleWorkspaceSettingsController@save')->name('google-workspace.settings.save');
    Route::get('/settings/connect', 'GoogleWorkspaceSettingsController@connect')->name('google-workspace.settings.connect');
    Route::get('/settings/disconnect', 'GoogleWorkspaceSettingsController@disconnect')->name('google-workspace.settings.disconnect');

    // Drive
    Route::get('/drive', 'GoogleWorkspaceDriveController@index')->name('google-workspace.drive');
    Route::post('/drive/create', 'GoogleWorkspaceDriveController@create')->name('google-workspace.drive.create');
    Route::delete('/drive/delete/{id}', 'GoogleWorkspaceDriveController@delete')->name('google-workspace.drive.delete');

    // Sheets
    Route::get('/sheets', 'GoogleWorkspaceSheetsController@index')->name('google-workspace.sheets');
    Route::post('/sheets/create', 'GoogleWorkspaceSheetsController@create')->name('google-workspace.sheets.create');
    Route::get('/sheets/view/{id}', 'GoogleWorkspaceSheetsController@view')->name('google-workspace.sheets.view');
    Route::post('/sheets/append/{id}', 'GoogleWorkspaceSheetsController@appendRow')->name('google-workspace.sheets.append');
});

// OAuth Callback
Route::middleware(['auth'])->group(function() {
    Route::get('/google-workspace/oauth-callback', 'GoogleWorkspaceSettingsController@callback')->name('google-workspace.oauth-callback');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::post('/google-workspace/sheets/export-table-data', 'GoogleWorkspaceSheetsController@exportTableData')->name('google-workspace.sheets.export-table-data');
});

