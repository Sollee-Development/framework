<?php
namespace Config;
class Environment {
    private $name;
    private $isRemoteServer;
    private $debug;

    public function __construct(\Utils\Request $request, $name) {
        $this->name = $name;
        // If the document root is not windows then it must be remote
        $this->isRemoteServer = strpos($request->server('DOCUMENT_ROOT'), 'C:') !== 0;
        // If it is local or a test site then debug
        $this->debug = (strpos($request->server('SERVER_NAME'), 'test') === 0 || !$this->isRemoteServer);
    }

    public function getName() {
        return $this->name;
    }

    public function getIsOnline() {
        return $this->isRemoteServer;
    }

    public function getDebug() {
        return $this->debug;
    }

    public function getRoot() {
        if (!$this->isRemoteServer) return '/' . $this->name . '/';
        else return DIRECTORY_SEPARATOR;
    }
}
