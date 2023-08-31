<?php

namespace App\Commons;

class HttpStatusCodes
{
    // 1xx Informational
    const HTTP_CONTINUE = 100; // Continue
    const HTTP_SWITCHING_PROTOCOLS = 101; // Switching Protocols

    // 2xx Success
    const HTTP_OK = 200; // OK
    const HTTP_CREATED = 201; // Created
    const HTTP_ACCEPTED = 202; // Accepted
    const HTTP_NO_CONTENT = 204; // No Content

    // 3xx Redirection
    const HTTP_MOVED_PERMANENTLY = 301; // Moved Permanently
    const HTTP_FOUND = 302; // Found
    const HTTP_NOT_MODIFIED = 304; // Not Modified
    const HTTP_TEMPORARY_REDIRECT = 307; // Temporary Redirect
    const HTTP_PERMANENT_REDIRECT = 308; // Permanent Redirect

    // 4xx Client Errors
    const HTTP_BAD_REQUEST = 400; // Bad Request
    const HTTP_UNAUTHORIZED = 401; // Unauthorized
    const HTTP_FORBIDDEN = 403; // Forbidden
    const HTTP_NOT_FOUND = 404; // Not Found
    const HTTP_METHOD_NOT_ALLOWED = 405; // Method Not Allowed
    const HTTP_REQUEST_TIMEOUT = 408; // Request Timeout
    const HTTP_CONFLICT = 409; // Conflict
    const HTTP_GONE = 410; // Gone
    const HTTP_UNPROCESSABLE_ENTITY = 422; // Unprocessable Entity
    const HTTP_TOO_MANY_REQUESTS = 429; // Too Many Requests

    // 5xx Server Errors
    const HTTP_INTERNAL_SERVER_ERROR = 500; // Internal Server Error
    const HTTP_NOT_IMPLEMENTED = 501; // Not Implemented
    const HTTP_BAD_GATEWAY = 502; // Bad Gateway
    const HTTP_SERVICE_UNAVAILABLE = 503; // Service Unavailable
    const HTTP_GATEWAY_TIMEOUT = 504; // Gateway Timeout
    const HTTP_HTTP_VERSION_NOT_SUPPORTED = 505; // HTTP Version Not Supported
}
