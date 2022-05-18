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
    return this.field.hasAttribute( 'value' );
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