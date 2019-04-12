<?php

/*
 * Code from https://r.je/http2-push-cache-css-reload
 */

namespace HTTP2Push;

class CacheAware {
    private $htdocs;
    private $files;

    public function __construct(string $htdocs, array $files = []) {
        $this->htdocs = rtrim($htdocs, \DIRECTORY_SEPARATOR);
        $this->files = $files;
    }

    private function assetsChangedSince(int $time): array {
        $changed = [];
        foreach ($this->files as $file => $type) {
            if (filemtime($this->htdocs . \DIRECTORY_SEPARATOR . $file) > $time) {
                $changed[$file] = $type;
            }
        }
        return $changed;
    }

    public function getHeader($time): string {
        $changedFiles = $this->assetsChangedSince($time);

        return count($changedFiles) === 0 ? '' : $this->createHeaderString();
    }

    private function createHeaderString() {
        $parts = [];
        foreach ($this->files as $file => $type) {
            $parts[] = '</' . $file . '>; as=' . $type . '; rel=preload';
        }

        return 'Link: ' . implode(', ', $parts);
    }
}
