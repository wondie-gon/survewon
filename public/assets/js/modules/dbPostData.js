/**
 * Module to prepare, and send form input data as json
 */
// importing WonHttpRequest
import { WonHttpRequest } from "./WonHttpRequest";

// importing WonFormAction
import { WonFormAction } from "./WonFormAction";

export const formDataToJson = ( form ) => ( ( formCopy ) => {
    // making some variables private
    let form = formCopy;
    
    /**
     * Based on 'underscore.js' isElement(obj) ---> TO DO
     * 
     * Checks if elemObj is a DOM Element
     * 
     * @param {obj} formElem 
     * @returns {boolean} true if formElem is a DOM Element
     */
    const isFormDomElement = ( formElem ) => { 
        return !!( formElem && formElem.nodeType === 1 ); 
    };

    /**
     * Instantiate WonFormaction
     * @returns new instance of WonFormaction
     */
    const initWonFormObj = () => {
        // if ( formElm && formElm.nodeType === 1 ) { return new WonFormAction( formElm ); }
        if ( isFormDomElement( form ) ) {
            return new WonFormAction( form );
        }
    };
    // new WonFormaction instance
    const newFormObj = initWonFormObj();
    /**
     * To get field inputs data in json format
     * @returns Json formatted data of form fields 
     */
    const json_data = () => newFormObj.dataToJson();

    // returning json data
    return json_data();

} )( form );

// sendJsonFormData
export const sendJsonFormData = ( data, url, msg_block ) => {
    const xhttp = new WonHttpRequest();

    // post data
    xhttp.postHandler( data, url, msg_block );
};
/*
document.addEventListener( 'DOMContentLoaded', () => {
    // accessing form using form name
    let data_form = document.forms.module_100_form;
    // get register btn
    let saveBtn = document.getElementById( 'saveMod1Btn' );
    // posting data event
    saveBtn.addEventListener( 'click', postDataToDb );
    // posting to db
    function postDataToDb( e ) {
        e.preventDefault();
        let mod_100_data = formDataToJson( data_form );

        let api_url = './src/controller/phq_mod_100/create.php';

        let text_box = document.querySelector('.main.active');

        sendJsonFormData( mod_100_data, api_url, text_box );
    }
} );
*/