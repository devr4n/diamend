<?php

if (!function_exists('getLang')) {
    /**
     * Get the current language of the application.
     */
    function getLang()
    {
        return app()->getLocale();
    }
}
