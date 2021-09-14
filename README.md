# Zaap
Zaap makes it super easy for you to write a PHP REST API.  
`v1.1`: `2021-09-13`

Here's what you do:

Put a copy of the API template file (`ZaapReceiver.php`) on your server. Make changes to it according to this README.

------------

### Variables

Here's a list of the different variables in the file and what they contain.  
Example request: `GET http://example.com/ZaapReceiver.php/getUser/byID/?id=1234&file=temp`

variable | what it's for
---------|--------------
`$method`  | Contains the HTTP method by which the request was received (`GET`, `POST`, `DELETE`, `PUT`, etc). <br> In the example, it contains the string "`GET`".
`$endpoint`| Contains the entire request endpoint as a string. <br> In the example, that's "`getUser/byID`".
`$endpointArray`| Contains the endpoint in an array, with each value of the array corresponding to a segment of the endpoint. <br> In the example, that's `["getUser","byID"]`.
`$params` | Contains the parameters and values from the query string in an array. The same as `$_GET`. <br> In the example, that's `{"id":"1234","file":"temp"}`.
`$input` | An array that contains the JSON-decoded input received in the request body. Mostly useful for POST and PUT, although they can be used with GET and DELETE too.
`$input` | An array that contains the data that is to be returned to whoever is making the request. 



### Writing your API
`ZaapReceiver.php` accepts four kinds of HTTP requests: `GET`, `POST`, `PUT` and `DELETE`. It accepts JSON-encoded payloads in the request's body.  
You can rename the file if you wish, of course.

Right off the bat, you can leave the first few lines of the script as is, and jump to the switch satatement. 

There's a case for each request method, and within each there's a second switch statement for the first endpoint. Use this to map endpoints to functions. For example, the endpoint `getUser` can be mapped to `readUser()`, or whatever. 

If you're not planning on supporting certain HTTP methods (such as PUT or DELETE), simply delete them from the switch statement to simplify your code.

`getOne()` is a simple example that demonstrates how you should write your functions.

1. Use the data in `$input`, `$params`, `$endpoint` and `$endpointData` to do whatever it is that the function needs to do.
2. If you find that the request is invalid, then simply call `errorInvalidRequest()`, otherwise: 
3. Store whatever data needs to be returned to the client in `$output`.
4. If an error occurs, then change `$output["error"]` to `1` to inform the client that an error occured, and store an error message in `$output["errorMessage"]`.
5. If no error occurs, then store a success return code in `$output["returnCode"]` to inform the client of the same.
6. Call `printOutput()`, while passing an appropriate HTTP status code as an argument. If none is passed, then `200` (OK) is used by default.  
   This function will JSON-encode `$output` and print it for the client.
7. You can now exit the script.
8. Congrats, your REST API is now ready!


--------

Documentation updated: `2021-09-13`.
