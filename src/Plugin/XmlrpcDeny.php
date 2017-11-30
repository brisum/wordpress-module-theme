<?php

namespace Brisum\Wordpress\Theme\Plugin;

class XmlrpcDeny
{
    public function __construct()
    {
        add_filter('xmlrpc_enabled', '__return_false');
        add_filter('wp_headers', [$this, 'filterWpHeaders']);
        add_filter('xmlrpc_methods', [$this, 'filterXmlrpcMethods']);
    }

    public function filterXmlrpcMethods ($methods) {
        unset($methods['pingback.ping']);
        return $methods;
    }

    public function filterWpHeaders($headers)
    {
        unset($headers['X-Pingback']);
        return $headers;
    }
}