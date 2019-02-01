<?php

Route::middleware(['breadcrumbs:\Setting\Models\Setting'])->prefix('settings')->group(function () {
    # Settings Redirect
    Route::get('/', function () {
        return redirect()->route('settings:display.index');
    })->name('settings');

    # Save Settings
    Route::post('store', 'SettingController@store')->name('settings.store');

    # General
    Route::group(['prefix' => 'general'], function () {
        // General
        Route::get('/', function () {
            return redirect()->route('settings:display.index');
        })->name('settings:general.index');

        // Display
        Route::get('display', 'DisplaySettingController@index')->name('settings:display.index');
        Route::post('display', 'DisplaySettingController@store')->name('settings:display.store');

        // Date Time
        Route::get('datetime', 'DateTimeSettingController@index')->name('settings:datetime.index');
        Route::post('datetime', 'DateTimeSettingController@store')->name('settings:datetime.store');
    });

    // Branding
    Route::prefix('branding')->group(function () {
        Route::get('/', function () {
            return redirect()->route('settings:branding.index');
        })->name('group:settings.branding');
        Route::get('general', 'BrandingSettingController@index')->name('settings:branding.index');
        Route::post('branding', 'BrandingSettingController@store')->name('settings.branding.store');

        // Email
        Route::get('email', 'EmailSettingController@index')->name('settings:email.index');

        // Social
        Route::get('social', 'SettingController@getSocialForm')->name('settings.social');
    });


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
