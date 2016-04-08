<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Entity "User"
 *
 * @property integer                $id                 ID                  Identifier
 * @property integer                $xmlId              XML_ID              External identifier
 * @property \WS\Tools\ORM\DateTime $modificationDate   TIMESTAMP_X         update date
 * @property string                 $login              LOGIN               Login
 * @property string                 $passwordHash       PASSWORD            Password hash
 * @property string                 $cookiePasswordHash STORED_HASH         Password hash stored in cookies
 * @property string                 $checkword          CHECKWORD           Checkword for password change
 * @property boolean                $isActive           ACTIVE              Activity
 * @property string                 $name               NAME                Name
 * @property string                 $lastName           LAST_NAME           Lastname
 * @property string                 $secondName         SECOND_NAME         Second name
 * @property string                 $email              EMAIL
 * @property \WS\Tools\ORM\DateTime $lastLoginDate      LAST_LOGIN          Last auth
 * @property \WS\Tools\ORM\DateTime $lastActivitiDate   LAST_ACTIVITY_DATE  last hit date
 * @property \WS\Tools\ORM\DateTime $registerDate       DATE_REGISTER       register date
 * @property string                 $lid                LID                 Site identifier for notifications
 * @property string                 $adminNotes         ADMIN_NOTES         Admin notes
 * @property string                 $externalAuthId     EXTERNAL_AUTH_ID    External auth id
 *
 * @property \WS\Tools\ORM\BitrixEntity\UserGroup[] $groups GROUPS_ID
 *
 * @property string                 $personalProfesion  PERSONAL_PROFESSION Profession
 * @property string                 $personalWWW        PERSONAL_WWW        WWW-page
 * @property string                 $personalIcq        PERSONAL_ICQ        icq
 * @property string                 $personalGender     PERSONAL_GENDER     Gender
 * @property \WS\Tools\ORM\DateTime $personalBirthday   PERSONAL_BIRTHDATE  Birthday
 * @property \WS\Tools\ORM\BitrixEntity\File $personalPhoto PERSONAL_PHOTO  Photo
 * @property string                 $personalPhone      PERSONAL_PHONE      Phone
 * @property string                 $personalFax        PERSONAL_FAX        Fax
 * @property string                 $personalMobile     PERSONAL_MOBILE     Mobile
 * @property string                 $personalPager      PERSONAL_PAGER      Pager
 * @property string                 $personalStreet     PERSONAL_STREET     Street
 * @property string                 $personalMailBox    PERSONAL_MAILBOX    Mailbox
 * @property string                 $personalCity       PERSONAL_CITY       City
 * @property string                 $personalState      PERSONAL_STATE      State
 * @property string                 $personalZip        PERSONAL_ZIP        Zip
 * @property string                 $personalCountry    PERSONAL_COUNTRY    Country
 * @property string                 $personalNotes      PERSONAL_NOTES      Notes
 * 
 * @property string                 $workCompany        WORK_COMPANY        Work company
 * @property string                 $workDepartment     WORK_DEPARTMENT     Work department
 * @property string                 $workPosition       WORK_POSITION       Position
 * @property string                 $workWWW            WORK_WWW            WWW-page
 * @property string                 $workPhone          WORK_PHONE          Phone
 * @property string                 $workFax            WORK_FAX            Fax
 * @property string                 $workPager          WORK_PAGER          Pager
 * @property string                 $workStreet         WORK_STREET         Street
 * @property string                 $workMailBox        WORK_MAILBOX        Mailbox
 * @property string                 $workCity           WORK_CITY           City
 * @property string                 $workState          WORK_STATE          State
 * @property string                 $workZip            WORK_ZIP            Zip
 * @property string                 $workCountry        WORK_COUNTRY        Country
 * @property string                 $workProfile        WORK_PROFILE        Profile
 * @property \WS\Tools\ORM\BitrixEntity\File $workLogo  WORK_LOGO           Logo
 * @property string                 $workNotes          WORK_NOTES          Notes
 * @property string                 $password           PASSWORD
 * @property string                 $passwordConfirm    CONFIRM_PASSWORD
 * @property string                 $skype              UF_SKYPE
 * @property string                 $hideComments       UF_HIDE_COMMENTS    Hide comments in list
 * @property string                 $hideProjects       UF_HIDE_PROJECTS    Hideproject in list
 * @property string                 $reverseComments    UF_REVERSE_COMMENTS Reverse comments
 * @property \WS\Tools\ORM\BitrixEntity\PropEnumElement role UF_ROLE
 *
 * @gateway user
 * @bitrixClass CUser
 *
 * @author my.sokolovsky@gmail.com
 */
class User extends Entity {

    public function getFullName() {
        $name = trim($this->lastName . " " . $this->name);
        return $name ? : $this->email;
    }
}
