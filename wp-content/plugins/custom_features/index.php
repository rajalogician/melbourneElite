<?php

/**
 * Plugin Name: Custom Features
 * Description: This is for custom features implementataion
 * Version: 1.0
 * Author: Weblifecykle
 */
add_action('wp_head', 'cp_ajaxurl');

function cp_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

add_action('wp_ajax_get_term_posts', 'get_term_posts');
add_action('wp_ajax_nopriv_get_term_posts', 'get_term_posts');

function get_term_posts() {
    try {

        $term_id = $_POST['term_id'];
        $posts_array = get_posts(
                array(
                    'posts_per_page' => -1,
                    'post_type' => 'vehicles',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'vehicle_categories',
                            'field' => 'term_id',
                            'terms' => $term_id,
                        )
                    )
                )
        );
        if (count($posts_array) <= 0) {
            print json_encode(array('status' => 0, 'response' => array(), 'message' => 'No vehicle found.'));
            die();
        }
        $response = array();
        foreach ($posts_array as $post) {

            $response[] = array(
                'id' => $post->ID,
                'title' => $post->post_title
            );
        }
        print json_encode(array('status' => 1, 'response' => $response));
        die();
    } catch (\Exception $ex) {
        print json_encode(array('status' => 0, 'response' => $ex->getMessage() . ' - ' . $ex->getLine()));
        die();
    }
}

add_action('wp_ajax_get_price', 'get_price');
add_action('wp_ajax_nopriv_get_price', 'get_price');

function get_price() {
    try {

        $pickup_address_lat = $_POST['pickup_address_lat'];
        $pickup_address_lng = $_POST['pickup_address_lng'];
        $destination_address_lat = $_POST['destination_address_lat'];
        $destination_address_lng = $_POST['destination_address_lng'];
        $vehicle = $_POST['vehicle'];
        $distance = distance($pickup_address_lat, $pickup_address_lng, $destination_address_lat, $destination_address_lng, 'K');
        $price = calculate_price($distance, $vehicle);
        if (!$price) {
            print json_encode(array('status' => 0, 'message' => 'Some thing went wrong. Please contact administrator.'));
            die();
        }
        print json_encode(array('status' => 1, 'distance' => round($distance, 3) . ' KM', 'price' => $price));
        die();
    } catch (\Exception $ex) {
        print json_encode(array('status' => 0, 'response' => $ex->getMessage() . ' - ' . $ex->getLine()));
        die();
    }
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

function calculate_price($distance, $vehicle, $duration = FALSE) {
    $vehicle_details = get_post($vehicle);
    $price_per_km = get_post_meta($vehicle, 'price_per_km', TRUE);
    if (!$price_per_km) {
        return FALSE;
    }
    if ($duration) {
        $price_per_hour = get_post_meta($vehicle, 'price_per_hour', TRUE);
        if (!$price_per_hour) {
            return FALSE;
        }
    }
    $price = $price_per_km * $distance;
    $price = round($price, 2);
    return $price;
}
