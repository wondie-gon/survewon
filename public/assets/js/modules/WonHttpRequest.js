/**
 * Http requests constructor function
 * 
 * Support: https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
 * Support 2: 
 * https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest#monitoring_progress
 */
 function WonHttpRequest() {
    this.initRequest = function() {
        return new XMLHttpRequest();
    };
}

/**
 * Method for get request
 * @param {string} url link to api to get the resource from
 * @returns the required response from given url
 */
WonHttpRequest.prototype.getData = function( url ) {
    let self = this;
    return new Promise( function( resolve, reject ) {
        const _rqst = self.initRequest();
       _rqst.open( 'GET', url );
       _rqst.responseType = 'json';

       _rqst.onload = function() {
        if ( _rqst.status === 200 ) {
        // If successful, resolve the promise by passing back the request response
          resolve( _rqst.response );
        } else {
        // If it fails, reject the promise with a error message
          reject( Error( 'Data didn\'t load successfully; error code:' + _rqst.status ) );
        }
      };
      _rqst.onerror = function() {
            // deal with network problem during request
            reject( Error( 'There was a network error.' ) );
      };
      // Send the request
      _rqst.send();
    } );
};

/**
 * Method for http request to read data
 * @param {string} url url to api for reading data
 */
WonHttpRequest.prototype.get = function( url ) {
  /**
   * assigning self to this,
   * to have its scope inside 
   * callback function
   */
  let self = this;

  return new Promise( function( resolve, reject ) {
    const _rqst = self.initRequest();
    _rqst.open( 'GET', url );

    // setting request header 
    _rqst.setRequestHeader( 'Accept', 'application/json' );
    _rqst.setRequestHeader( 'Content-Type', 'application/json' );

    _rqst.onreadystatechange = function() {
      if ( _rqst.readyState === 4 && _rqst.status == 200 ) {
        resolve( this.response );
      } else {
        reject( this.status );
      }
    };

    // send request
    _rqst.send();
  } );

};

/**
 * Method for http request to post data
 * @param {string} data Data to be posted in json format
 * @param {string} url url to api for posting data
 */
WonHttpRequest.prototype.post = function( data, url ) {
  /**
   * assigning self to this,
   * to have its scope inside 
   * callback function
   */
  let self = this;

  return new Promise( function( resolve, reject ) {
    const _rqst = self.initRequest();
    _rqst.open( 'POST', url );

    // setting request header 
    _rqst.setRequestHeader( 'Accept', 'application/json' );
    _rqst.setRequestHeader( 'Content-Type', 'application/json' );

    _rqst.onreadystatechange = function() {
      if ( _rqst.readyState === 4 && _rqst.status == 200 ) {
        // console.log(_rqst.status);
        resolve( this.response )
      } else {
        reject( this.status );
      }
    };

    // send data
    _rqst.send( data );
  } );

};

/**
 * Method for http request to modify data
 * @param {string} url url to api for updating data
 * @param {string} data Data to be updated in json format
 * @return a new promise object
 */
WonHttpRequest.prototype.patch = function( url, data ) {
  // assigning to self
  let self = this;

  return new Promise( function( resolve, reject ) {
    const _rqst = self.initRequest();
    _rqst.open( 'PATCH', url );

    // setting request header 
    _rqst.setRequestHeader( 'Accept', 'application/json' );
    _rqst.setRequestHeader( 'Content-Type', 'application/json' );

    _rqst.onreadystatechange = function() {
      if ( _rqst.readyState === 4 && _rqst.status == 200 ) {
        // console.log(_rqst.status);
        resolve( this.response )
      } else {
        reject( this.status );
      }
    };

    // send data
    _rqst.send( data );
  } );
};

/**
 * Method for http request to update data by replacing
 * @param {string} url url to api for updating data
 * @param {string} data Data to be updated in json format
 * @return a new promise object
 */
WonHttpRequest.prototype.put = function( url, data ) {
  let self = this;

  return new Promise( function( resolve, reject ) {
    const _rqst = self.initRequest();
    _rqst.open( 'PUT', url );

    // setting request header 
    _rqst.setRequestHeader( 'Content-Type', 'application/json' );

    _rqst.onreadystatechange = function() {
      if ( _rqst.readyState === 4 && _rqst.status == 200 ) {
        resolve( this.response )
      } else {
        reject( this.status );
      }
    };

    // send data
    _rqst.send( data );
  } );
};

/**
 * Method for http request to delete data
 * @param {string} url url to api for updating data
 */
WonHttpRequest.prototype.delete = function( url ) {
  /**
   * assigning self to this,
   * to have its scope inside 
   * callback function
   */
  let self = this;

  return new Promise( function( resolve, reject ) {
    const _rqst = self.initRequest();
    _rqst.open( 'DELETE', url );

    // setting request header 
    _rqst.setRequestHeader( 'Accept', 'application/json' );
    _rqst.setRequestHeader( 'Content-Type', 'application/json' );
    // _rqst.setRequestHeader("Authorization", "Bearer mt0dgHmLJMVQhvjpNXDyA83vA_PxH23Y");
    _rqst.setRequestHeader( 'Authorization', `Bearer ${token}` );

    _rqst.onreadystatechange = function() {
      if ( _rqst.readyState === 4 && _rqst.status == 200 ) {
        resolve( this.response )
      } else {
        reject( this.status );
      }
    };

    // send data
    _rqst.send();
  } );
};

/**
 * Method to retrieve data after get request
 * @param {string} url url to api for posting data
 * @return {json} Json data from read api
 */
 WonHttpRequest.prototype.readDataHandler = function( url ) {
  this.get( url )
  .then( ( response ) => {
    const jsondata = JSON.parse( response );
    return jsondata;
  } )
  .catch( ( error ) => {
    console.log(`Error getting data, HTTP status: ${error}`);
  } );
};

/**
 * Method to handle data posting event
 * @param {string} data Data to be posted in json format
 * @param {string} url url to api for posting data
 * @param {*} msg_block Html element to display response
 */
WonHttpRequest.prototype.postHandler = function( data, url, msg_block ) {
  this.post( data, url )
  .then( ( response ) => {
    const result = JSON.parse( response );
    msg_block.innerHTML = result.message;
  } )
  .catch( ( error ) => {
    msg_block.innerHTML = `Error getting response message, HTTP status: ${error}`;
  } );
};

// exporting
export { WonHttpRequest };