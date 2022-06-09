<?php

namespace App\Modules\Traits;

trait GithubTrait
{
    private function labels_match($issue, $needles)
    {
        if ($this->hasValue($issue, 'labels')) {
            foreach ($issue['labels'] as $label) {
                if (in_array($label['name'], $needles)) {
                    return array($label['name']);
                }
            }
        }
        return array();

    }

    private function _percent($complete, $remaining)
    {
        $total = $complete + $remaining;
        if ($total > 0) {
            $percent = ($complete OR $remaining) ? round($complete / $total * 100) : 0;
            return array(
                'total' => $total,
                'complete' => $complete,
                'remaining' => $remaining,
                'percent' => $percent
            );
        }
        return array();
    }

    private function hasValue($array, $key)
    {
        return is_array($array) && array_key_exists($key, $array) && !empty($array[$key]);
    }
}