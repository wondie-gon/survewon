/**
 * Module to get/read data from server
 */
// importing http request module WonHttpRequest
import { WonHttpRequest } from "./WonHttpRequest.js";

// import 'WonJsonData.js' module
// import { WonJsonData } from "./WonJsonData.js";

/**
 * Get data from db
 * @param {string} url url path to read api
 * @returns 
 */
export function getDbData( url ) {
    // instantiate request obj
    const newRqst = new WonHttpRequest();
    let reqstPromise = newRqst.getData( url );
    // console.log(reqstPromise); // Promise {<pending>}
    reqstPromise.then(resp => {
            // console.log(resp); // {data_arr: Array(3)}
            return resp;
        })
        .then( json => {
            console.log(json.data_arr); // [{…}, {…}, {…}]
            return json.data_arr;
        } )
        .catch((error) => {
            console.log(error);
        });
}
