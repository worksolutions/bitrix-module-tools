<?php

namespace WS\Tools\Mail;

/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

class MailService {

    /**
     * @param $eventName
     * @return MailPackage
     */
    public function createPackage($eventName) {
        return new MailPackage($eventName);
    }

    /**
     * @param MailPackage $package
     * @param bool $duplicate
     * @return int
     */
    public function send(MailPackage $package, $duplicate = false) {
        $rsSites = \CSite::GetList($by="sort", $order="desc", Array());
        $siteIds = array();
        while ($arSite = $rsSites->Fetch()) {
            $siteIds[] = $arSite['ID'];
        }

        return \CEvent::Send(
            $package->getEventName(),
            $siteIds,
            $package->getFields(),
            $duplicate ? 'Y' : 'N',
            $package->getMessageId()
        );
    }
}