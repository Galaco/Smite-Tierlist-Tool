<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\AbstractController;


/**
 * Class ApiController
 * @package AdminBundle\Controller
 */
class ApiController extends AbstractController
{
    const FETCH_CHARACTERS = 'fetch';

    const REQUEST_NAMES = [
        'fetch'
    ];

    /** @var array */
    protected $_messages = [];


    /**
     * Main API endpoint.
     *
     * @param string  $_gameId
     * @param string  $_request
     * @return JsonResponse
     */
    public function indexAction($_gameId, $_request)
    {
        try {
            if (!in_array($_request, $this::REQUEST_NAMES)) {
                throw new \Exception(sprintf('Invalid request parameter: "%s"', $_request));
            }
            /** @var \AdminBundle\Util\GameDataProvider $provider */
            $provider = $this->get('api.gamedataprovider');

            /** @var \AdminBundle\Util\ApiInterface $apiService */
            $apiService = $provider->getProvider(strtolower($_gameId));
            $apiService->setParser($provider->getParser(strtolower($_gameId)));

            if ($_request == $this::FETCH_CHARACTERS) {
                $apiResponse = $apiService->getCharacters();
                $this->_messages[] = $apiResponse;
            }
        } catch (\Exception $e) {
            $this->_messages[] = $e->getMessage();
        }

        return $this->_createJsonResponse();
    }


    /**
     * Create Json Response for API.
     *
     * @return JsonResponse
     */
    private function _createJsonResponse()
    {
        $data = [
            'status' => (count($this->_messages) > 0) ? 'failure' : 'success',
            'messages' => $this->_messages
        ];

        return new JsonResponse($data);
    }
}
