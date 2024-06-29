<?php
/*
Plugin Name: Contact Form 7 - override maxlength
Description: Contact Form 7 v5.9.6 added very low maxlength values (80/400) - this will override defaults with 300/2000 (no changes to explicitly set values).
Version:     1.0.1
Author:      megamurmulis
License:     GPL v3
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'init', function(){
	add_filter( 'wpcf7_form_tag', function($scanned_tag, $replace){
		if ( in_array($scanned_tag['basetype'], array( 'text', 'email', 'url' ) ) ){
			$found = false;
			foreach($scanned_tag['options'] as $value){
				if ( strpos( $value, 'maxlength:' ) ){
					$found = true;
					break;
				}
			}
			if ( !$found ){
				$scanned_tag['options'][] = 'maxlength:300';
			}
		}
		else if ( in_array($scanned_tag['basetype'], array( 'textarea' ) ) ){
			$found = false;
			foreach($scanned_tag['options'] as $value){
				if ( strpos( $value, 'maxlength:' ) ){
					$found = true;
					break;
				}
			}
			if ( !$found ){
				$scanned_tag['options'][] = 'maxlength:2000';
			}
		}
		
		return $scanned_tag;
	}, 10, 2 );
});
