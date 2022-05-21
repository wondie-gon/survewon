function WonValidateField( field ) {
    if ( field !== undefined && field !== null ) {
        this.field = field;
    }
}

/**
 * prototype constructor
 */
WonValidateField.prototype.constructor = WonValidateField;

 /**
  * check if element is a valid field
  */
WonValidateField.prototype.isAnInputField = function() {
    return this.field.hasAttribute( 'value' ) && this.field.hasAttribute( 'name' );
};

/**
 * Gets name attribute of field
 * @returns {string} name attribute of field
 */
WonValidateField.prototype.getNameAttr = function() {
    if ( this.isAnInputField() ) {
        return this.field.name;
    }
};

/**
 * Checks for checkbox
 * @returns boolean true if checkbox
 */
WonValidateField.prototype.isCheckBox = function() {
    return this.field.nodeName === 'INPUT' && this.field.type === 'checkbox';
};

/**
 * Checks for radiobox
 * @returns boolean true if radiobox
 */
WonValidateField.prototype.isRadioBox = function() {
    return this.field.nodeName === 'INPUT' && this.field.type === 'radio';
};

/**
 * Checks for input type text
 * @returns boolean true if input type text
 */
WonValidateField.prototype.isInputText = function() {
    return this.field.nodeName === 'INPUT' && this.field.type === 'text';
};

/**
 * Checks for select type
 * @returns boolean true if select type
 */
WonValidateField.prototype.isSelectField = function() {
    return this.field.nodeName === 'SELECT' && this.field.options;
};

/**
 * 
 * Checks if field is multiple select
 * @returns boolean true if select type and has multiple attribute
 */
WonValidateField.prototype.isMultiSelect = function() {
    if ( this.isSelectField() ) {
        return this.field.options && this.field.multiple;
    }
    return false;
};

/**
 * Gets array of selected values of multiple select values
 * @returns {array} array of slected values
 */
WonValidateField.prototype.getMultiSelectedValues = function() {
    if ( ! this.isMultiSelect() ) {
        return false;
    }
    return Array.from( this.field.options )
        .filter( option => option.selected )
        .map( option => option.value );
};


/**
 * ---------------------Validation inspired by Validate.js---------------
 * Some validation rules are inspired by Validate.js
 * ----------------------------------------------------------------------
 */
/**
 * Checks required field
 * @returns {boolean} True if field is required
 */
WonValidateField.prototype.isRequiredField = function() {
    // TODO: for radioboxes


    if ( this.isAnInputField() && this.hasAttribute( 'required' ) ) {
        return true;
    }
    return false;
};

/**
 * Gets value of field
 * @returns value of field
 */
WonValidateField.prototype.getFieldValue = function() {
    if ( this.isAnInputField() && this.hasAttribute( 'value' ) ) {
        if ( this.isMultiSelect() ) {
            return this.getMultiSelectedValues();
        } else {
            return this.value;
        }
    }
};

/**
 * Validates required field
 * @returns true if field has value
 */
WonValidateField.prototype.validateRequired = function() {
    if ( ! this.isRequiredField() ) {
        return;
    }
    if ( this.isCheckBox() || this.isRadioBox() ) {
        return ( this.checked === true );
    }
    return ( this.getFieldValue() !== null && this.getFieldValue() !== '' );
};

/**
 * Checks fields value with passed field's value
 * @param {HTMLElement} matchField Selector of field to check its value with the field
 * @returns true if field value matches with passed field's value
 */
WonValidateField.prototype.validateIfFieldMatch = function( matchField ) {
    let matchFieldVal = '';
    // check if field exists and has value attribute
    if ( !!( matchField && matchField.nodeType === 1 ) && matchField.hasAttribute( 'value' ) ) {
        return this.getFieldValue === matchField.value;
    }
    return false;
};

/**
 * Checks if field has valid email 
 * @returns {boolean} true if valid email
 */
WonValidateField.prototype.validateEmailField = function() {
    const emailRegx = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if ( this.isAnInputField() && this.type === 'email' ) {
        return emailRegx.test( this.getFieldValue() );
    }
};

/**
 * Checks if field value contains only alphanumeric, 
 * underscores, and dashes
 * @returns {boolean} true if field's value is valid alphanumeric
 *                    with underscore and dash
 */
WonValidateField.prototype.validateAlphaNumDashes = function() {
    const alphaNumDashes = /^[a-zA-Z0-9_\-]+$/;
    if ( this.isAnInputField() ) {
        return alphaNumDashes.test( this.getFieldValue() );
    }
};

/**
 * Checks if field value contains only text
 * @returns {boolean} true if field's value is only text
 */
WonValidateField.prototype.validateTextOnly = function() {
    const textAndSpaceOnlyRegex = /[a-zA-Z\s]+$/;
    if ( this.isAnInputField() && this.isInputText() ) {
        return textAndSpaceOnlyRegex.test( this.getFieldValue() );
    }
};