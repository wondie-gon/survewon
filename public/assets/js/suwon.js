const nxt_btns = document.querySelectorAll( ".nxt_step_btn" );
const fieldBlocks = document.querySelectorAll( ".main" );
const progressLists = document.querySelectorAll( ".progress-bar li" );
let num = document.querySelector( ".step-number" );
let formnumber = 0;

// next btn event handling
Array.from( nxt_btns ).forEach( function( btnElm ) {
    btnElm.addEventListener( 'click', function( e ) {
        e.preventDefault();
        // if( ! validate_active_form_elems() ) {
        //     return false
        // }
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

console.log(validate_active_fields( frm ));

function validate_active_fields( form ) {
    validate = true;
    let frm_elems;
    let active_fields;
    let active_main = document.querySelector( ".main.active" );
    // get form elements
    if ( is_form_elem( form ) ) {
        frm_elems = form.elements;
    }
    // console.log(frm_elems);
    if ( frm_elems !== undefined ) {
        active_fields = Array.from( frm_elems ).filter( elem => active_main.contains( elem ) === true && elem.hasAttribute( 'name' ) );

        // names
        // active_fields = Array.from( frm_elems ).filter( elem => active_main.contains( elem ) === true && elem.hasAttribute( 'name' ) ).map( item => item.name );
    }

    if ( active_fields.some( elem => elem.value.length == 0 ) ) {
        validate = false;
    }



    return validate;

}
 
 
function validate_active_form_elems() {
    validate = true;
    let validate_inputs = document.querySelectorAll( ".main.active input" );
    validate_inputs.forEach( function( vaildate_input ) {
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