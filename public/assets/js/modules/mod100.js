/**
 * Module to carry out functionalities in relation to users data
 */
// importing helpers module
import { getUrlWithQueryStr } from "./helpers.js";

import { formDataToJson, sendJsonFormData } from "./dbPostData.js";

// accessing form using form name
let data_form = document.forms.module_100_form;
// get register btn
let saveBtn = document.getElementById( 'saveMod1Btn' );
// posting data event
saveBtn.addEventListener( 'submit', function(e) {
    e.preventDefault();
    let mod_100_data = formDataToJson( data_form );

    let api_url = './src/controller/phq_mod_100/create.php';

    let text_box = document.querySelector('.main.active');

    sendJsonFormData( mod_100_data, api_url, text_box );
} );