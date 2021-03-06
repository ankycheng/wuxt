<?php

    /**
     * Adds a front-page endpoint for generell front-page settings in the
     * Front-end
     */
    add_action('rest_api_init', 'wuxt_custom_field');


    function wuxt_custom_field() {
        register_rest_route('wuxt', '/v1/custom_fields/(?P<slug>\S+)', array(
            'methods'  => 'GET',
            'callback' => 'wuxt_get_custom_field'
        ));
    }


    function wuxt_get_custom_field( $object ) {

        $slug = $object->get_param('slug');

        $request = new WP_REST_Request('GET', '/wp/v2/posts');
        $request->set_param('slug', $slug);

        $response = rest_do_request($request);

        if (!$response->data) {

            $request = new WP_REST_Request('GET', '/wp/v2/pages');
            $request->set_param('slug', $slug);

            $response = rest_do_request($request);
        }

        if (!$response->data) {
            return new WP_Error('wuxt_no_such_slug', __('Slug does not exist'), array('status' => 404));
        }

        $embed = $object->get_param('_embed') !== NULL;
        $data = rest_get_server()->response_to_data($response, $embed);

        return $data[0];

    }
