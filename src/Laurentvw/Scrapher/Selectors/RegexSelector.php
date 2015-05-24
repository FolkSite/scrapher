<?php

namespace Laurentvw\Scrapher\Selectors;

class RegexSelector extends Selector
{
    public function getMatches()
    {
        $matches = [];

        preg_match_all($this->getExpression(), $this->getContent(), $matchLines, PREG_SET_ORDER);

        foreach ($matchLines as $i => $matchLine) {
            foreach ($matchLine as $matchId => $matchValue) {
                $matches[$i][$this->findName($this->getConfig(), $matchId)] = $matchValue;
            }
        }

        return $matches;
    }

    private function findName($haystack, $needle)
    {
        foreach ($haystack as $item) {
            if ($item['id'] === $needle) {
                return $item['name'];
            }
        }

        return $needle;
    }
}
