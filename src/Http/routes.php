<?php

Route::get(
    '/elements/layout-builder/{id}',
    'ElementsFramework\Layout\Http\Controller\LayoutEditorController@getEditorForLayout'
)->name('elements.layout-builder');
Route::post(
    '/elements/layout-builder/{id}',
    'ElementsFramework\Layout\Http\Controller\LayoutEditorController@saveLayout'
)->name('elements.layout-builder.save');