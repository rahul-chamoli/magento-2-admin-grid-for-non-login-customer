<?php
/**
 * Module AdminGrid module registration
 * @package Subscriber/Notlogin
 */
declare(strict_types=1);

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Subscriber_Notlogin',
    __DIR__
);
