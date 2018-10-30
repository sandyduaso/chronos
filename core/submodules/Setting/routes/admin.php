<?php

Route::middleware(['breadcrumbs:\Setting\Models\Setting'])->prefix('settings')->group(function () {
    # Settings Redirect
    Route::get('/', function () {
        return redirect()->route('settings.display');
    })->name('settings');

    # Save Settings
    Route::post('store', 'SettingController@store')->name('settings.store');

    # General
    Route::group(['prefix' => 'general'], function () {
        // Display
        Route::get('display', 'DisplaySettingController@index')->name('settings:display.index');
        Route::post('display', 'DisplaySettingController@store')->name('settings:display.store');

        // Date Time
        Route::get('datetime', 'DateTimeSettingController@index')->name('settings.datetime');
        Route::post('datetime', 'DateTimeSettingController@store')->name('settings.datetime.store');
    });

    // Branding
    Route::get('branding', 'BrandingSettingController@index')->name('settings.branding');
    Route::post('branding', 'BrandingSettingController@store')->name('settings.branding.store');

    // Email
    Route::get('branding/email', 'EmailSettingController@index')->name('settings.email');
    Route::post('branding/email', 'EmailSettingController@store')->name('settings.email.store');

    // Social
    Route::get('branding/social', 'SettingController@getSocialForm')->name('settings.social');

    // Theming
    // Route::get('theming', 'ThemingSettingController@index')->name('settings.theming');
    // Route::post('theming', 'ThemingSettingController@store')->name('settings.theming.store');

    // System
    Route::get('system', 'SystemSettingController@index')->name('settings.system');
    Route::post('system', 'SystemSettingController@store')->name('settings.system.store');

    Route::get('system/configuration', 'SystemConfigurationSettingController@index')->name('settings.system.configuration');
    Route::post('system/configuration', 'SystemConfigurationSettingController@store')->name('settings.system.configuration.store');

    // Configuration
    Route::post('system/configuration/cache', 'SystemConfigurationSettingController@cache')
         ->name('configuration.cache');
});
