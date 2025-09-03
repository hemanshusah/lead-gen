<?php

/** ----------------------------------------------------------------------------------------------------------------------
 * [REFERENCE]
 * This is a comprehensive list of DOM manipulation that can be sent back to the
 * ajax request from inside the Response Class. 
 * 
 * These manipulations are handled by the existing JavaScript frontend
 * class. This JS makes the initial ajax call to the controller and then processes the repsonse from the backend
 *
 * Selectors can be element ID or Classes
 *  - 'selector' => '#fooBar',
 *  - 'selector' => '.fooBar',
 *  - 'selector' => "#fooBar-$id",
 *----------------------------------------------------------------------------------------------------------------------*/

//add content to the DOM (e.g. add a form for creating or editing a resource) inside a modal
$html = view('pages/tasks/add-edit-inc', compact('page', 'task'))->render();
$jsondata['dom_html'][] = [
    'selector' => '#commonModalBody',
    'action' => 'replace', //replace | replace-with | append | prepend
    'value' => $html,
];

//manipulate the data-foo-bar attributes of a dom element
$jsondata['dom_attributes'][] = [
    'selector' => '#js-sorting-id',
    'attr' => 'data-url',
    'value' => 'fooobar',
];

//maipulate the class of a dom resouce
$jsondata['dom_classes'][] = [
    'selector' => '#main-table',
    'action' => 'add', //add | remove
    'value' => 'some-class-name',
];

//manipulate an attribute for a dom element
$jsondata['dom_property'][] = [
    'selector' => '#some-form-field',
    'prop' => 'checked',
    'value' => true,
];

//manipulate the property of a dom element
$jsondata['dom_property'][] = [
    'selector' => '#some-form-field',
    'prop' => 'checked',
    'value' => true,
];

//manipulate the value of a dom element
$jsondata['dom_val'][] = [
    'selector' => '#file_name',
    'value' => 'foo',
];

//manipulate the visibility of a dom element
$jsondata['dom_visibility'][] = [
    'selector' => '#some-item',
    'action' => 'show', // show | hide | fadein| fadeout
];

//show a noty popup error meesage
$jsondata['notification'] = [
    'type' => 'error',
    'value' => __('lang.request_could_not_be_completed'),
];

//show a noty popup success meesage
$jsondata['notification'] = [
    'type' => 'error',
    'value' => __('lang.request_could_not_be_completed'),
];

//execute a javascript function in the frontend
$jsondata['postrun_functions'][] = [
    'value' => 'nxSomeFunction',
];

//redirect to a url
$jsondata['redirect_url'] = url('/foo/bar');

//reset tinymce editors by id
$jsondata['tinymce_reset'][] = [
    'selector' => 'some-editor', //do not use a #hash sign
];

//trigger a click event on a dom element
$jsondata['dom_action'][] = [
    'selector' => '#some-item',
    'action' => 'trigger',
    'value' => 'click',
];

//trigger a value to change to a select2 dropdown
$jsondata['dom_action'][] = [
    'selector' => '#some-select2-form',
    'action' => 'trigger-select-change',
    'value' => 'foobar',
];

//close the moadl window
$jsondata['dom_visibility'][] = [
    'selector' => '#commonModal', 'action' => 'close-modal',
];

//show or hide the modal footer where the buttons are
$jsondata['dom_visibility'][] = [
    'selector' => '#commonModalFoooter', 
    'action' => 'show', //show | hide
];