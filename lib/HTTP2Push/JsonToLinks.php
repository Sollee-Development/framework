<?php

namespace HTTP2Push;


class JsonToLinks {
    public function convert($path) {
        if (!file_exists($path)) return [];
        $json = json_decode(file_get_contents($path), true);

        return array_merge(
            array_fill_keys($json['css'], 'stylesheet'),
            array_fill_keys($json['js'], 'script')
        );
    }
}