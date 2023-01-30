<?php

namespace wcf\action;

use SystemException;
use wcf\util\JSON;

/**
 * Abstract Minecraft action class
 *
 * @author   xXSchrandXx
 * @license  Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @package  WoltLabSuite\Core\Action
 */
abstract class AbstractMinecraftAction extends AbstractMinecraftGETAction
{
    /**
     * @inheritDoc
     */
    protected $supportetMethod = 'POST';

    /**
     * @inheritDoc
     */
    public function validateHeader($request, &$response): void
    {
        parent::validateHeader($request, $response);

        // validate Content-Type
        if (!$request->hasHeader('content-type')) {
            if (ENABLE_DEBUG_MODE) {
                $response = $this->send('Bad Request. Missing \'Content-Type\' in headers.', 400);
            } else {
                $response = $this->send('Bad Request.', 400);
            }
            return;
        }
        if ($request->getHeaderLine('content-type') !== 'application/json') {
            if (ENABLE_DEBUG_MODE) {
                $response = $this->send('Bad Request. Wrong \'Content-Type\'.', 400);
            } else {
                $response = $this->send('Bad Request.', 400);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function readParameters($request, &$parameters, &$response): void
    {
        try {
            $parameters += JSON::decode((string) $request->getBody());
        } catch (SystemException $e) {
            if (ENABLE_DEBUG_MODE) {
                $response = $this->send('Bad Request. Could not decode json.', 400);
            } else {
                $response = $this->send('Bad Request.', 400);
            }
            return;
        }
    }
}
