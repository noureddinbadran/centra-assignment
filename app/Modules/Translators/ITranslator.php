<?php

namespace App\Modules\Translators;

interface ITranslator
{
    /**
     * Each translator should implement the suitable way to output its data externally
     * @return array
     */
    public function translate() : array;
}