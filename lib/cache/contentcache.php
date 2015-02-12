<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:29
 */

namespace WS\Tools;


class ContentCache extends Cache {

    /**
     * Start buffering data
     */
    public function record() {
        $this->init();
        $this->getOriginal()->startDataCache();
        return $this;
    }

    /**
     * @return $this
     */
    public function abort() {
        $this->getOriginal()->abortDataCache();
        return $this;

    }

    /**
     * @param bool $output It will need to use by print output in a flow
     * @return string
     */
    public function save($output = true) {
        $this->getOriginal()->endDataCache();
        $output && $this->getOriginal()->output();
        return $this->content();
    }

    /**
     * @return string
     */
    public function content() {
        $this->init();
        ob_start();
        $this->getOriginal()->output();
        return ob_get_clean();
    }
}