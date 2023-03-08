<?php

/*
 * Plugin Name: Piwik PRO Account Exists
 */

defined( 'ABSPATH' ) or exit;

foreach( [ 'wp_ajax_nopriv', 'wp_ajax' ] as $prefix )
    add_action( $prefix . '_piwik_pro_account_exists', function() {
        ! empty( $_POST[ 'account' ] ) or wp_die( 0, 400 );

        $url = esc_url(
            'https://' .
            trim( preg_replace('(^https?://)', '', $_POST[ 'account' ] ), '/' ) .
            '.piwik.pro'
        );

        $response = wp_remote_get( $url );
        $code = (int)( 200 === wp_remote_retrieve_response_code( $response ) );

        wp_die( $code, $code ? 200 : 404 );
    } );