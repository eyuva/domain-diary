
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Loading Vendor Files
 */

require('./../vendor/ouical/build/ouical.js');


/**
 * Modified Select input with multiple options to use select2
 * and pre-select options using data attribute
 */

$('select[multiple]').select2();

$('select').each(function(){
    var optionValue = $(this).data('value');
    $(this).val(optionValue).change();
});