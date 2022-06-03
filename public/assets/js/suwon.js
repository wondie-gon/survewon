const nxt_btns = document.querySelectorAll( ".nxt_step_btn" );
const fieldBlocks = document.querySelectorAll( ".main" );
let step_num_content = document.querySelectorAll( ".step-number-content" );
const progressLists = document.querySelectorAll( ".progress-bar li" );
let num = document.querySelector( ".step-number" );
let formnumber = 0;

// radio input field groups in active main block
let activeRadBoxGrps = document.querySelectorAll( '.main.active .radiobox-grp' );
// checkbox groups in active main block
let activeCBoxGrps = document.querySelectorAll( '.main.active .checkbox-grp' );

/**
 * Adding event listener for click event on checkbox group blocks
 */
let cboxGrps = document.querySelectorAll( '.checkbox-grp' );
Array.from(cboxGrps).forEach(grp => {
    grp.addEventListener('click', (event) => {
        let cboxes = grp.querySelectorAll( 'input[type="checkbox"]' );
        let cBoxesArr = Array.from(cboxes);
        cBoxesArr.forEach( cb => {
            if ( event.currentTarget === cb ) {
                cb.checked = true;
            }
            // console.log( cb.checked );
        });
    });
    // console.log(atLeastOneCbChecked);
});

// next btn event handling
Array.from( nxt_btns ).forEach( function( btnElm ) {
    
    btnElm.addEventListener( 'click', function( e ) {
        e.preventDefault();

        // get the active block of the form 
        // let currentFormBlock = fieldBlocks[formnumber];
        // get blocks cntaining radio fields
		let radGrpBlocks = fieldBlocks[formnumber].getElementsByClassName( 'radiobox-grp' );
        // get blocks cntaining checkbox fields
		let checkboxGrpBlocks = fieldBlocks[formnumber].getElementsByClassName( 'checkbox-grp' );

        // text field wrappers
        let txtFrmGroups = fieldBlocks[formnumber].getElementsByClassName( 'form-grp-text' );

        // number field wrappers
        let numFrmGroups = fieldBlocks[formnumber].getElementsByClassName( 'form-grp-number' );

        // if invalid text field blocks
        if ( [...txtFrmGroups].length > 0 && ! validInputTextFields( fieldBlocks[formnumber] ) ) {
            return false;
        }

        // if invalid number field blocks
        if ( [...numFrmGroups].length > 0 && ! validInputNumberFields( fieldBlocks[formnumber] ) ) {
            return false;
        }

        // if invalid checkbox blocks
        if ( ( [...checkboxGrpBlocks].length > 0 && validateCBoxesBlock( [...checkboxGrpBlocks], areCBGrpsValid ) === false ) ) {
            return false;
        }

        // validating radio fields
        if ( [...radGrpBlocks].length > 0 && ! validateRadioBoxBlocks( [...radGrpBlocks], validRadioGroup ) ) {
            return false;
        }
        formnumber++;
        updateFieldsBlock();
        progress_forward();
        contentchange();
    } );
} ); 

// back btn event handling
const prev_btns = document.querySelectorAll( ".prev_step_btn" );
Array.from( prev_btns ).forEach( function( btnElm ) {
    btnElm.addEventListener( 'click', function( e ) {
        e.preventDefault();
        formnumber--;
        updateFieldsBlock();
        progress_backward();
        contentchange();
    } );
} );

// updating input block
function updateFieldsBlock() {
    let frmGroupArr = Array.from( fieldBlocks );
    frmGroupArr.forEach( function( frmBlock ) {
        frmBlock.classList.remove( 'active' );
    });
    // add active class on current
    frmGroupArr[formnumber].classList.add( 'active' );
}

// ---------------------Hidden fields functionalities------------------------
// animating field appearance
const unhideFieldAnimation = [
    { transform: 'scaleY(1)' },
    { transform: 'scaleY(0)' }
];
  
const unhideFieldAnimationTiming = {
    duration: 2000,
    iterations: 1,
}
/**
 * Adding class for hidden fields blocks to not display before
 * the acivator field is checked
 */ 
const hiddenFields = document.querySelectorAll( '.form-group.hidden-fields' );
hiddenFields.forEach( el => {
     el.classList.add( 'd-none' );
     let inpField = el.querySelector( 'input.form-control' );
     inpField.classList.add( 'hidden' );
     inpField.value = '';
} );

/**
 * Adding event listener for check/radio fields that enables display of 
 * the next hidden fields
 */
const otherCheckFields = document.querySelectorAll( '.unhide-check' );
otherCheckFields.forEach( input => {
    input.addEventListener( 'change', () => {
        let idAttr = input.getAttribute( 'id' );
        // console.log(idAttr);
        if ( input.checked ) {
            displaysNextHiddenField( idAttr, true );
        } else {
            displaysNextHiddenField( idAttr, false );
        }
    } );
} );

/**
 * Event handler function that toggles display of hidden fields when other 
 * option checks are checked
 * @param {string} activator_id id attribute of the check/radio field that
 * displays hidden fields when checked
 * @param {*} is_other_checked true if other check field is checked
 */
function displaysNextHiddenField( activator_id, is_other_checked = false ) {
    // let hiddenFormGrps = document.querySelectorAll( '.form-group.hidden-fields' );
    hiddenFields.forEach( fGroup => {
        if ( fGroup.hasAttribute( 'data-activatedby' ) && fGroup.getAttribute( 'data-activatedby' ) === activator_id ) {
            let inpField = fGroup.querySelector( 'input.form-control' );
            if ( is_other_checked ) {
                fGroup.classList.remove( 'd-none' );
                inpField.classList
                                .remove( 'hidden' )
                                .animate( unhideFieldAnimation, unhideFieldAnimationTiming );
                inpField.focus();
            } else {
                fGroup.classList.add( 'd-none' );
                inpField.classList.add( 'hidden' );
                inpField.blur();
                inpField.value = '';
            }
        }
    } );
}
// ---------------------Hidden fields functionalities------------------------

/**
 * Fnction to display next form active block 
 * when next buttn is clicked
 */
function progress_forward() {
    num.innerHTML = formnumber + 1;
    progressLists[formnumber].classList.add( 'active' );
}  

/**
 * Function that enables to return back at 
 * any step when the 'Back' button is clicked
 */
function progress_backward() {
    let form_num = formnumber+1;
    progressLists[form_num].classList.remove( 'active' );
    num.innerHTML = form_num;
}
/**
 * Function to change sidebar progress bar contents
 */
function contentchange() {
     step_num_content.forEach( function( content ) {
        content.classList.remove( 'active' ); 
        content.classList.add( 'd-none' );
     } ); 
     step_num_content[formnumber].classList.add( 'active' );
}

/**
 * 
 * @param {string} formElem selector for form element
 * @returns true if element is a form element
 */
function is_form_elem( formElem ) {
    return !!( formElem && formElem.nodeType === 1 ); 
}

/**
 * Function to filter input fields and access all radio input fields
 * @param {*} form selector for form element
 * @returns {array} array of radio input fields
 */
function getAllradioBoxes( form ) {
    return Array.from( form.elements )
            .filter( el => el.nodeName === 'INPUT' && el.type === 'radio' );
}

/**
 * Checks radio input fields in a block
 * @param {HTMLElement} el selector containing group of radio input fields 
 * @returns true if one or more are checked
 */
function validateRadio( el ) {
    let activeRadios = el.querySelectorAll( 'input[type="radio"]:not(.hidden)' );
    return [...activeRadios].some( rb => rb.checked );
}

/**
 * Event handler for validation of radio field groups 
 * are valid in the active block of the form
 * @returns true if every radio field group have 
 *          checked radio fields
 */
function validRadioGroup( rad_blocks ) {
    // let grps = Array.from( activeRadBoxGrps );
    rad_blocks = document.querySelectorAll( '.main.active .radiobox-grp' );
    return [...rad_blocks].every( radGrp =>  validateRadio( radGrp ) );
}

/**
 * Validates radio containing blocks on visible part of form 
 * when next button is clicked
 * @param {HTMLElement} blocks Selectors of html blocks in active part of form 
 * containing radio groups
 * @param {*} validityCallback A callback function to validate array of 
 * blocks containing radio fields. 
 * @returns true if all groups in the active part of form are valid
 */
function validateRadioBoxBlocks( blocks, validityCallback ) {
    if ( validityCallback( blocks ) ) {
        return true;
    }
    return false;
}

/**
 * 
 * @returns true if valid radio field
 */
function validateRadioGrps() {
    let atleastOneChecked = false;
    activeRadBoxGrps.addEventListener( "click", e => {
        if ( validRadioGroup() ) {
            atleastOneChecked = true;
        }
    });
    return atleastOneChecked;
}

// -----------validate checkboxes-------------------------
/**
 * Validates checkbox containing blocks on visible part of form 
 * when next button is clicked
 * @param {HTMLElement} blocks Selectors of html blocks in active part of form 
 * containing checkbox groups
 * @param {*} validityCallback A callback function to validate array of 
 * blocks containing checkbox fields. 
 * @returns true if all groups in the active part of form are valid
 */
function validateCBoxesBlock( blocks, validityCallback ) {
    if ( validityCallback( blocks ) ) {
        return true;
    }
    return false;
}

/**
 * Checks if some checkboxes are checked in a specific block
 * @param {HTMLElement} el selector of a block containing checkbox fields
 * @returns true if one or more than one are checked
 */
function someCbChecked( el ) {
    let cboxes = el.querySelectorAll( 'input[type="checkbox"]:not(.hidden)' );
    return Array.from( cboxes ).some( cb => cb.checked );
}

/**
 * Callaback function that takes active blocks that contain checkboxes
 * @param {HTMLElement} blocks Selectors of html blocks in active part of form 
 * containing checkbox groups
 * @returns returns true if all checkbox groups are valid
 */
function areCBGrpsValid( blocks ) {
    blocks = document.querySelectorAll( '.main.active .checkbox-grp' );
    return Array.from( blocks ).every( b => someCbChecked( b ) );
}


// -----------validate checkboxes--------------------------



/**
 * Checks if input field is of the specified type
 * @param {HTMLElement} field selector for input element
 * @param {string} fieldType input type to check
 * @returns {boolean} true if the field is of the stated type
 */
const fieldIsInputType = ( field, fieldType ) => {
    if ( field.nodeName === 'INPUT' && field.type === fieldType ) {
        return true;
    }
    return false;
};
// ------------validates text fields-----------------------------------------
/**
 * Validates text input fields in active main block
 * @param {HTMLElement} active_block Selector for active form block
 * 
 * @returns true if all text fields in the active main block
 */
function validInputTextFields( active_block ) {
    let validTxtFields = true;
    let txtFieldsActive = active_block.querySelectorAll( 'input[type="text"]:not(.hidden)' );
    if ( ! Array.from( txtFieldsActive ).every( field => validTextInput( field ) ) ) {
        validTxtFields = false;
    }
    return validTxtFields;
}

/**
 * validates input text fields
 * @param {HTMLElement} el selector for input fields of type text
 * @returns true if valid text and not empty
 */
function validTextInput( el ) {
    if ( ! fieldIsInputType( el, 'text' ) ) {
        return;
    }
    // text input regex
    const txtReg = /[a-zA-Z0-9_\-\.\?]*/g;

    // let valid_txt_input = true;
    if ( el.value.length == 0 || txtReg.test( el.value ) !== true ) {
        return false;
    }
    return true;
}
// ------------validates text fields-----------------------------------------

/**
 * Validates number input fields in active main block
 * @param {HTMLElement} active_block Selector for active form block
 * 
 * @returns true if all number fields in the active main block
 */
function validInputNumberFields( active_block ) {
    let validNumber = true;
    let numFieldsActive = active_block.querySelectorAll( 'input[type="number"]:not(.hidden)' );
    if ( ! Array.from( numFieldsActive ).every( field => validNumberInput( field ) ) ) {
        validNumber = false;
    }
    return validNumber;
}
/**
 * Validate number
 * @param {HTMLElement} input input field selector
 * @returns {boolean} true if valid number value
 */
function validNumberInput( input ) {
    // if ( ! fieldIsInputType( input, 'number' ) ) {
    //     return;
    // }
    // number regex
    const numReg = /\d+/;
    if ( input.value.length == 0 || numReg.test( input.value ) !== true ) {
        return false;
    }
    return true;
}
 
function validate_active_form_elems() {
    validate = true;
    let fieldInputs = document.querySelectorAll( ".main.active input" );

    fieldInputs.forEach( function( vaildate_input ) {
        vaildate_input.classList.remove( 'warning' );
        if( vaildate_input.hasAttribute( 'require' ) ) {
            if( vaildate_input.value.length == 0 ) {
                validate = false;
                vaildate_input.classList.add( 'warning' );
            }
        }
    });
    return validate;
    
}

// ------Some other validation for use-------------------------------------
/**
 * Validates username
 * 
 * Usernames can only use alpha-numeric characters. The only numbers in the username have to be at 
 * the end. There can be zero or more of them at the end. Username cannot start with the number. 
 * Username letters can be lowercase and uppercase. Usernames have to be at least two characters 
 * long. A two-character username can only use alphabet letters as characters.
 * 
 * @param {HTMLElement} input Selector for input for username
 * @returns {boolean} true if it passes the test
 */
function validate_username( input ) {
    const username = input.value;
    let unameRegEx = /^[a-zA-Z]+[a-zA-Z]+\d*$|^[a-zA-Z]+\d\d+$/;
    // space at start and end regex

    // first replace if any space at start and end
    // let startEndSpaceReg = /^(\s+)|(\s+)$/g;
    // username = username.replace(startEndSpaceReg, '');
    return unameRegEx.test( username );
}

/**
 * Test passwords that are greater than 8 characters long, 
 * and have atleast 1 digits.
 * @param {*} input 
 * @returns 
 */
function validate_password( input ) {
    let password = '';
    if ( input.type === 'password' ) {
        password = input.value;
    }
    const pwRegex = /(?=\w{9,})(?=\D*\d+)/;
    return pwRegex.test( password );
}

// function validate_phonenum( input ) {}