<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:29
 */

namespace WS\Tools\Cache;


class ContentCache extends Cache {

    /**
     * Start buffering data
     */
    public function record() {
        ob_start();
        return $this;
    }

    /**
     * @return $this
     */
    public function abort() {
        ob_end_flush();
        return $this;

    }

    /**
     * @param bool $output It will need to use by print output in a flow
     * @return string
     */
    public function save($output = true) {
        $content = ob_get_clean();
        $this->write($content);
        $output && print $content;
        return $content;
    }

    /**
     * @return string
     */
    public function content() {
        return (string) $this->read();
    }
}