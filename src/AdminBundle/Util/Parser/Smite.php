<?php

namespace AdminBundle\Util\Parser;

use AdminBundle\Util\Exception\BadParameterException;
use AdminBundle\Util\ParserInterface;


class Smite implements ParserInterface
{
    /**
     * @{inheritdoc}
     */
    public function toStandardFormat($data)
    {
        $data = json_decode($data, true);

        if (!is_array($data)) {
            throw new BadParameterException('Unable to parse character data. Expected: array.');
        }

        $output = [];

        foreach ($data as $character) {
            $output[] = [
                'id' => $character['id'],
                'name' => $character['Name'],
            ];
        }

        var_dump($output);

        return $output;
    }
}