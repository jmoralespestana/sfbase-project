<?php


namespace App\Service;


use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\MissingTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpFoundation\RequestStack;

class DecodeToken
{

    private RequestStack $requestStack;

    private JWTEncoderInterface $JWTManager;

    /**
     * DecodeToken constructor.
     * @param RequestStack $requestStack
     * @param JWTEncoderInterface $JWTManager
     */
    public function __construct(RequestStack $requestStack, JWTEncoderInterface $JWTManager)
    {
        $this->requestStack = $requestStack;
        $this->JWTManager = $JWTManager;
    }

    /**
     * Method for decode the information of token
     * @return array
     */
    public function getData(): array
    {
        try {
            $extractor = new AuthorizationHeaderTokenExtractor(
                'Bearer',
                'Authorization'
            );
            $token = $extractor->extract($this->requestStack->getCurrentRequest());

            if ($token === null)
                throw new MissingTokenException("Token not found",204);

            return $this->JWTManager->decode($token);
        } catch (Exception $exception) {
            throw new MissingTokenException($exception->getMessage(), 404);
        }
    }

}