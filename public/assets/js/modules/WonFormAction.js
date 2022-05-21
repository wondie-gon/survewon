/**
 * Constructor function WonFormAction to 
 * handles all user actions in form elements
 * 
 * @param {string} form variable for a selected form
 * 
 * param form can be selected using id, or css valid 
 * selectors or using one of the following
 * 
 * let form = document.getElementById('frmId') --- the form with id="frmId"
 * let form = document.querySelector('.frmClass') --- the form with class="frmClass"
 * let form = document.forms.frmName --- the form with name="frmName"
 * let form = document.forms[0]  -- the first form in the document
 */
 function WonFormAction( form ) {
    // const frm = document.querySelector( formSelector );

    this.frmElem = form;
    this.frmFields = this.frmElem.elements;
}

/**
 * prototype constructor
 */
WonFormAction.prototype.constructor = WonFormAction;

/**
 * Method to get form element
 * @returns form element 
 */
WonFormAction.prototype.getFormElem = function() {
    return this.frmElem;
};

/**
 * Method to get input elements in form
 * @returns all form fields
 */
WonFormAction.prototype.getFormElements = function() {
    return this.frmFields;
};

/**
 * Method to get any available element in the named collection 'frmFields'
 * @param {string} elemName Value of name attribute of input element
 * @returns [object HTMLInputElement] field element 
 */
WonFormAction.prototype.getFieldByName = function( elemName ) {
    let elems = this.getFormElements();
    return elems[elemName];
};

/**
 * Method to access fieldset in the form
 * @param {string} field_name name attribute value of fieldset
 * @returns HTMLFieldSetElement
 */
WonFormAction.prototype.getFieldSetByName = function( field_name ) {
    let elems = this.getFormElements();
    return elems[field_name];
};

/**
 * Get field element using css selector
 * @param {string} fieldSelctor field selector
 * @returns element obj or null
 */
 WonFormAction.prototype.getFieldBySelector = function( fieldSelctor ) {
    let form = this.getFormElem();
    return form.querySelector( fieldSelctor );
};

/**
 * Checks if field is valid input element with value attribute
 * @param {string} elemName Value of name attribute of input element
 * @returns {boolean} True if input element is valid
 */
WonFormAction.prototype.isFieldInputElem = function( elemName ) {
    
    let fieldElem = this.getFieldByName( elemName );

    if ( fieldElem !== undefined && fieldElem !== null ) {
        return fieldElem.hasAttribute( 'value' );
    }
};

/**
 * Checks if field is of type checkbox
 * @param {string} elemName Value of name attribute of input element
 * @returns {boolean} true if field is checkbox type
 */
WonFormAction.prototype.isFieldCheckBox = function( elemName ) {
    let fieldElem = this.getFieldByName( elemName );
    return fieldElem.type === 'checkbox';
};

/**
 * Checks if field is of type radio
 * @param {string} elemName Value of name attribute of input element
 * @returns {boolean} true if field is radio type
 */
WonFormAction.prototype.isFieldRadioBox = function( elemName ) {
    let fieldElem = this.getFieldByName( elemName );
    return fieldElem.type === 'radio';
};

/**
 * Checks if field is multiselect
 * @param {string} elemName Value of name attribute of input element
 * @returns {boolean} true if field is multiselect type
 */
WonFormAction.prototype.isFieldMultiSelect = function( elemName ) {
    let fieldElem = this.getFieldByName( elemName );
    return fieldElem.options && fieldElem.multiple;
};

/**
 * Gets array of selected values of multiple select values
 * @param {string} elemName Value of name attribute of input element
 * @returns {array} array of slected values
 */
WonFormAction.prototype.getMultiSelectedValues = function( elemName ) {
    let selectElem = this.getFieldByName( elemName );

    let selectedVals = Array.from( selectElem.options )
        .filter( option => option.selected )
        .map( option => option.value );
    return selectedVals;
};

/**
 * Method to get array of field names
 * @returns {array} form elements that are for user input
 */
WonFormAction.prototype.getAllFieldNames = function() {
    let thisForm = this;
    return Array.from( this.getFormElements() )
        .map( function( elem ) {
            if ( elem.hasAttribute( 'name' ) ) {
                return elem.name;
            }
        } )
        .filter( function( item ) {
            return item !== undefined;
        } );
};

/**
 * Get data object
 * @returns Data object collected from valid data fields
 */
WonFormAction.prototype.getFieldsDataObj = function() {
    // get field names
    let fieldNames = this.getAllFieldNames();

    let thisForm = this;

    // collect values into object 
    let fieldsData = fieldNames.reduce( function( data, name ) {
        let elem = thisForm.getFieldByName( name );
        if ( thisForm.isFieldCheckBox( name ) || thisForm.isFieldRadioBox( name ) ) {
            data[name] = ( data[name] || [] ).concat( elem.value );
        } else if ( thisForm.isFieldMultiSelect( name ) ) {
            data[name] = thisForm.getMultiSelectedValues( name );
        } else {
            data[name] = elem.value;
        }
        return data;
    }, {} );

    return fieldsData;
};

/**
 * Method to convert fields data obj to json
 * @returns Json data format
 */
WonFormAction.prototype.dataToJson = function() {
    let dataObj = this.getFieldsDataObj();
    return JSON.stringify( dataObj, null, " " );
};

// ---------------------Validation methods-----------------------------
/**
 * Validating checkboxes to make sure that atleast one checkbox is checked
 * 
 * Since HTML5 does not support 'required' attribute for checkboxes, this 
 * method adds 'required' is added on all, and validates atleast one is checked
 * 
 * @returns {boolean} True if atleast one is checked, and removes 'required' on all
 */
 WonFormAction.prototype.checkBoxRequired = function() {
    // get field names
    let fieldNames = this.getAllFieldNames();
    let thisForm = this;

    // atleast one checked
    let atLeastOneChecked = false;

    // get checkboxes group
    let checkBoxGrp = fieldNames.filter( function( fldName ) {
        let elem = thisForm.getFieldByName( fldName );
        if ( thisForm.isFieldCheckBox( fldName ) && elem.name === fldName ) {
            return elem;
        }
    } );

    // loop through a checkbox group
    for ( let i = 0; i < checkBoxGrp.length; i++ ) {
        if ( checkBoxGrp[i].checked === true ) {
            atLeastOneChecked = true;
        }
    }

    // required attribute
    if ( atLeastOneChecked === true ) {
        for ( let i = 0; i < checkBoxGrp.length; i++ ) {
            checkBoxGrp[i].required = false;  
        }
    } else {
        for ( let i = 0; i < checkBoxGrp.length; i++ ) {
            checkBoxGrp[i].required = true;  
        }
    }
};

WonFormAction.prototype.validateCheckBox = function() {
    // get field names
    let fieldNames = this.getAllFieldNames();
    let thisForm = this;

    // set 'required' checkboxes
    let checkBoxes = fieldNames.filter( function( fldName ) {
        let elem = thisForm.getFieldByName( fldName );
        if ( thisForm.isFieldCheckBox( fldName ) ) {
            return elem;
        }
    } );

    return [...checkBoxes].some( function( el ) {
        return el.checked;
    } );
};

// TODO
WonFormAction.prototype.validateCheckBoxGrp = function() {
    let cbGroups = this.getCheckBoxGrp();
    let thisForm = this;
    cbGroups.forEach( function( el ) {
        el.addEventListener( "click", thisForm.validateCheckBox() );
    } );
}

/**
 * sets 'required' attribute to checkboxes
 */
WonFormAction.prototype.getCheckBoxGrp = function() {
    // get field names
    let fieldNames = this.getAllFieldNames();
    let thisForm = this;

    let checkBoxGrp = fieldNames.filter( function( fldName ) {
        let elem = thisForm.getFieldByName( fldName );
        if ( thisForm.isFieldCheckBox( fldName ) && fldName === elem.name ) {
            return elem;
        }
    } );

    return checkBoxGrp;
};

// exporting module
export { WonFormAction };

//------------------------------------------------------
/*
// implementation
document.addEventListener('DOMContentLoaded', () => {
    let frm = document.forms.users_registration_form;

    const newFrm = new WonFormAction(frm);
    console.log(newFrm.getAllFieldNames());

    let btnDay = document.getElementById( 'submitbtn' );

    btnDay.addEventListener('click', processForm);

    function processForm( e ) {
        e.preventDefault();

        let data = newFrm.getFormData();

        console.log(newFrm.getFieldsDataObj());

        console.log(newFrm.dataToJson());
    }
});

*/