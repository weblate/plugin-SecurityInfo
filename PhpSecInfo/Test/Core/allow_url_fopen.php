<?php

/**
 * Test Class for allow_url_fopen
 *
 * @package PhpSecInfo
 * @author Ed Finkler <coj@funkatron.com>
 */

/**
 * require the PhpSecInfo_Test_Core class
 */
require_once(PHPSECINFO_BASE_DIR . '/Test/Test_Core.php');

/**
 * Test Class for allow_url_fopen
 *
 * @package PhpSecInfo
 *
 *
 */
class PhpSecInfo_Test_Core_Allow_Url_Fopen extends PhpSecInfo_Test_Core
{
    /**
     * This should be a <b>unique</b>, human-readable identifier for this test
     *
     * @var string
     */
    public $test_name = "allow_url_fopen";

    /**
     * The recommended setting value
     *
     * @var mixed
     */
    public $recommended_value = false;


    public function _retrieveCurrentValue()
    {
        $this->current_value = $this->getBooleanIniValue('allow_url_fopen');
    }


    /**
     * Checks to see if allow_url_fopen is enabled
     */
    public function _execTest()
    {
        if (version_compare(PHP_VERSION, '5.2', '<')) { /* this is much more severe if we're running < 5.2 */
            if ($this->current_value == $this->recommended_value) {
                return PHPSECINFO_TEST_RESULT_OK;
            }

            return PHPSECINFO_TEST_RESULT_WARN;
        } else { /* In 5.2, we'll consider allow_url_fopen "safe" */
            $this->recommended_value = true;
            return PHPSECINFO_TEST_RESULT_OK;
        }
    }


    /**
     * Set the messages specific to this test
     */
    public function _setMessages()
    {
        parent::_setMessages();
        if (version_compare(PHP_VERSION, '5.2', '<')) { /* this is much more severe if we're running < 5.2 */
            $link = '<a href="http://php.net/manual/en/ref.curl.php" rel="noreferrer"  target="_blank">PHP cURL functions</a>';
            $this->setMessageForResult(PHPSECINFO_TEST_RESULT_OK, 'en', 'allow_url_fopen is disabled, which is the recommended setting');
            $this->setMessageForResult(
                PHPSECINFO_TEST_RESULT_WARN,
                'en',
                "allow_url_fopen is enabled.  This could be a serious security risk.  You should disable allow_url_fopen and consider using the $link instead."
            );
        } else {
            $this->setMessageForResult(PHPSECINFO_TEST_RESULT_OK, 'en', 'You are running PHP 5.2 or greater, which makes allow_url_fopen significantly safer. Make sure allow_url_include is <em>disabled</em>, though');
        }
    }
}
