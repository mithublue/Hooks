<?php
/**
 * @param $hook
 * @param array ...$arg
 */
function do_action( $hook, ...$arg ) {
    global $nixmo_filters;
    $args = func_get_args();
    call_user_func_array( 'apply_filters', $args );
}

/**
 * @param $hook
 * @param array ...$arg
 * @return mixed
 */
function apply_filters( $hook, ...$arg ) {
    global $nixmo_filters;
    $args = func_get_args();
    unset($args[0]);
    $return = null;

    if( isset( $args[1] ) ) {
        $return = $args[1];
    }


    if( isset( $nixmo_filters[$hook] ) ) {
        foreach ( $nixmo_filters[$hook] as $priority => $action_set ) {
            $action = $action_set[0];
            $arg_count = $action_set[1];
            $args = array_splice( $args, 0, $arg_count );
            $return = call_user_func_array( $action, $args );
        }
    }
    return $return;
}

/**
 * @param $hook
 * @param $action
 * @param int $prioity
 * @param $arg_count
 */
function add_action( $hook, $action, $prioity = 10, $arg_count ) {
    global $nixmo_filters;
    if( !isset( $nixmo_filters[$hook] ) ) $nixmo_filters[$hook] = [];
    array_splice( $nixmo_filters[$hook], $prioity, 0, [ [ $action, $arg_count ] ] );
}


/**
 * @param $hook
 * @param $action
 * @param int $prioity
 * @param $arg_count
 */
function add_filter( $hook, $action, $prioity = 10, $arg_count ) {
    global $nixmo_filters;
    if( !isset( $nixmo_filters[$hook] ) ) $nixmo_filters[$hook] = [];
    array_splice( $nixmo_filters[$hook], $prioity, 0, [ [ $action, $arg_count ] ] );
}