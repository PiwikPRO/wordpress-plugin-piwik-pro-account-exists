<?php

/*
 * Plugin Name: Piwik PRO Account Exists
 */

defined( 'ABSPATH' ) or exit;

add_action( 'wp_ajax_nopriv_piwik_pro_account_exists', function() {
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