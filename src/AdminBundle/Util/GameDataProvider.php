<?php

namespace AdminBundle\Util;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class GameDataProvider
{
    const GAME_ID = [
      'smite'
    ];

    const PROVIDER_CLASS = [
        'smite' => GameData\Smite::class
    ];

    const PARSER_CLASS = [
        'smite' => Parser\Smite::class
    ];


    protected $_container;

    public function __construct(Container $serviceContainer)
    {
        $this->_container = $serviceContainer;
    }


    /**
     * Get a particular API provider.
     *
     * @param $gameId
     * @return ApiInterface
     * @throws Exception\BadParameterException
     */
    public function getProvider($gameId)
    {
        if (in_array($gameId, $this::GAME_ID) && $classname = self::PROVIDER_CLASS[$gameId]) {
            return new $classname($this->_container);
        }
        throw new Exception\BadParameterException(sprintf('No supported provider for game id: "%s"', $gameId));
    }


    /**
     * Get a particular API response parser.
     *
     * @param $gameId
     * @return ApiInterface
     * @throws Exception\BadParameterException
     */
    public function getParser($gameId)
    {
        if (in_array($gameId, $this::GAME_ID) && $classname = self::PARSER_CLASS[$gameId]) {
            return new $classname($this->_container);
        }
        throw new Exception\BadParameterException(sprintf('No supported parser for game id: "%s"', $gameId));
    }
}