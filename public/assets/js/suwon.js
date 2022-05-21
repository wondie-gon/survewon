const nxt_btns = document.querySelectorAll( ".nxt_step_btn" );
const fieldBlocks = document.querySelectorAll( ".main" );
const progressLists = document.querySelectorAll( ".progress-bar li" );
let num = document.querySelector( ".step-number" );
let formnumber = 0;

// active radioboxes
let activeRadBoxGrps = document.querySelectorAll( '.main.active .radiobox-grp' );
let activeCBoxGrps = document.querySelectorAll( '.main.active .checkbox-grp' );

setRadioboxGrpRequired();

// next btn event handling
Array.from( nxt_btns ).forEach( function( btnElm ) {
    btnElm.addEventListener( 'click', function( e ) {
        e.preventDefault();
        // if( ! validate_active_form_elems() ) {
        //     return false
        // }

        if ( ! validate_active_fields(fieldBlocks[formnumber]) ) {
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
 
function progress_forward() {
    // progressLists.forEach(list => {
        
    //     list.classList.remove('active');
         
    // }); 
    
     
    num.innerHTML = formnumber+1;
    progressLists[formnumber].classList.add( 'active' );
}  

function progress_backward() {
    let form_num = formnumber+1;
    progressLists[form_num].classList.remove( 'active' );
    num.innerHTML = form_num;
} 
 
let step_num_content=document.querySelectorAll(".step-number-content");

function contentchange() {
     step_num_content.forEach( function( content ) {
        content.classList.remove( 'active' ); 
        content.classList.add( 'd-none' );
     } ); 
     step_num_content[formnumber].classList.add( 'active' );
}

function is_form_elem( formElem ) {
    return !!( formElem && formElem.nodeType === 1 ); 
}

const frm = document.getElementById( 'module_100' );

// console.log(validate_active_fields( frm ));

function validate_active_fields( active_main ) {
    validate = true;

    let radioGrp = document.querySelector( '.radiobox-grp' );
    let cBoxGrp = document.querySelector( '.checkbox-grp' );

    if ( active_main.contains( radioGrp ) && validRadioGroup() !== true )  {
        validate = false;
    }
    if ( active_main.contains( cBoxGrp ) && validateCheckBoxGrp() !== true )  {
        validate = false;
    }
    return validate;
}

function validate_active_main() {
    validate = true;

    let radioGrp = document.querySelectorAll( '.main.active .radiobox-grp' );
    let cBoxGrp = document.querySelectorAll( '.main.active .checkbox-grp' );

    radioGrp.forEach( el => {
        if ( validRadioGroup() !== true ) {
            validate = false;
        }
    } );

    cBoxGrp.forEach( el => {
        if ( validateCheckBoxGrp() !== true ) {
            validate = false;
        }
    } );
    return validate;
}

/**
 * Set required on first radioboxes
 * in a group
 */
function setRadioboxGrpRequired() {
    // get radioboxes
    Array.from( activeRadBoxGrps )
        .forEach( grp => {
            let checkboxes = grp.querySelector( 'input[type="radio"]' );
            // console.log(checkboxes);
            checkboxes.setAttribute( 'required', 'required' );
        } );
}

function getAllradioBoxes( form ) {
    return Array.from( form.elements )
            .filter( el => el.nodeName === 'INPUT' && el.type === 'radio' );
}

function validateRadio( el ) {
    let activeRadios = el.querySelectorAll( 'input[type="radio"]' );
    return [...activeRadios].some(e => e.checked);
}

function validRadioGroup() {
    let grps = Array.from( activeRadBoxGrps );
    return [...grps].every( validateRadio );
}

function validateRadioGrps() {
    let atleastOneChecked = false;
    activeRadBoxGrps.addEventListener( "click", e => {
        if ( validRadioGroup() ) {
            atleastOneChecked = true;
        }
    });
    return atleastOneChecked;
}

// validate checkboxes-------------testing-----------------

function validateCheckBox( el ) {
    let visibleCheckBoxes = el.querySelectorAll( 'input[type="checkbox"]' );
    return [...visibleCheckBoxes].some(e => e.checked);
}

function checkBoxGrpIsValid() {
    let grps = Array.from( activeCBoxGrps );
    return [...grps].every( validateCheckBox );
}

function validateCheckBoxGrp() {
    let atleastOneChecked = false;
    // let activeCBoxGrps = document.querySelectorAll( '.main.active .checkbox-grp' );
    activeCBoxGrps.forEach( el => {
        activeCBoxGrps.addEventListener( "click", e => {
            if ( checkBoxGrpIsValid() ) {
                atleastOneChecked = true;
            }
        })
    } );
    return atleastOneChecked;
}
// validate checkboxes-------------testing-----------------


// validate text inputs -----------------------
function validateTextInput( el ) {
    if ( el.nodeName === 'INPUT' && el.type !== 'text' ) {
        return;
    }
    // space at start and end regex
    // let startEndSpaceReg = /^(\s+)|(\s+)$/gm;
    // let result = hello.replace(startEndSpaceReg, '');

    // text input regex
    const txtReg = /[a-zA-Z0-9_\-\.\?]*/g;

    let valid_txt_input = true;
    if ( el.value.length == 0 || txtReg.test( el.value ) !== true ) {
        valid_txt_input = false;
    }
    return valid_txt_input;
}

/**
 * Validate number
 * @param {HTMLElement} input input field selector
 * @returns {boolean} true if valid number value
 */
function validateNumberInput( input ) {
    let valid_txt_input = true;
    const numReg = /\d+/;
    if ( input.value.length == 0 || numReg.test( input.value ) !== true ) {
        valid_txt_input = false;
    }
    return valid_txt_input;
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

// ------Some other validation for use
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