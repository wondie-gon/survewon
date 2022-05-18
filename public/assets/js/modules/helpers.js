/**
 * Get full url together with query string arguments
 * @param {string} url url path
 * @param {obj} qry_obj query strings to be passed with url
 * @returns Full url alongwith query strings encoded
 */
 function getUrlWithQueryStr( url, qry_obj = {} ) {
    let obj2arr;
    // check for object
    if ( typeof qry_obj === 'object' ) {
        obj2arr = Object.entries( qry_obj );
    }
    // get length
    let arrLen = ( obj2arr !== undefined && typeof obj2arr.length === 'number' ) ? obj2arr.length : 0;
    // when there are qry args
    if ( arrLen > 0 ) {
        // url to add qry strings
        url = url + '?';
        url += obj2arr.map( ( item ) => `${item[0]}=${item[1]}` )
                .reduce( ( prev, curr ) => {
                    curr = '&' + curr;
                    return prev + curr;
                } );
    }
    // console.log(encodeURI(url));
    return url;
}
/**
 * Checks if element is DOM element
 * @param {string} elem DOM element
 * @returns {boolean} true if elem is DOM element 
 */
function isDomElement( elem ) {
    return !!( elem && elem.nodeType === 1 );
}

// exports
export { getUrlWithQueryStr, isDomElement };
