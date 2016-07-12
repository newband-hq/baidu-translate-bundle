<?php

namespace Newband\Baidu\Translate;

/**
 * Interface TranslatorInterface
 * @package Newband\Baidu\Translate
 * @author Zafar <zafar@newband.com>
 */
interface TranslatorInterface
{
    /**
     * @param string $query
     * @param string $from
     * @param string $to
     * @return string
     */
    public function translate($query, $from, $to);
}