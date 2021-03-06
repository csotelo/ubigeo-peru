<?php


function get_from_cache( $key ) {
    $m = new Memcache();
    $m->connect('tunnel.pagodabox.com',11211);
    if ( $_SERVER['COMPRESS_CACHE'] === true ) {
        $res = $m->get($key, MEMCACHE_COMPRESSED);
    } else {
        $res = $m->get($key);
    }
    $m->close();
    return $res;
}

function save_to_cache( $key, $res ) {
    $m = new Memcache();
    $m->connect('tunnel.pagodabox.com',11211);
    if ( $_SERVER['COMPRESS_CACHE'] === true ) {
        $op = $m->set($key, $res, MEMCACHE_COMPRESSED);
    } else {
        $op = $m->set($key, $res);
    }
    $m->close();
    return $op;
}
