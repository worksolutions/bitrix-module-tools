<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

if(!check_bitrix_sessid()) {return;}

echo CAdminMessage::ShowNote("Модуль ws-tools установлен");