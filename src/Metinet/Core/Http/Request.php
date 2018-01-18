<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
namespace Metinet\Core\Http;

class Request
{
    private $headers;
    private $path;
    private $method;
    private $query;
    private $request;
    private $body;

    private const ALLOWED_METHODS = ['GET', 'POST', 'PUT', 'DELETE'];

    public function __construct(string $path, string $method, array $headers, array $query, array $request, ?string $body = null)
    {
        if (!\in_array(strtoupper($method), self::ALLOWED_METHODS, true)) {

            throw new \Exception(
                sprintf('Method "%s" is not a valid method, allowed methods are: %s', $method, implode(', ', self::ALLOWED_METHODS))
            );
        }

        $this->headers = $headers;
        $this->path = $path;
        $this->method = $method;
        $this->query = $query;
        $this->request = $request;
        $this->body = $body;
    }

    public static function createFromGlobals(): Request
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (0 === strpos($key, 'HTTP_')) {
                $name = strtolower(str_replace('_', '-', substr($key, 5)));
                $headers[$name] = $value;
            }
        }

        $bodyContent = file_get_contents('php://input');
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        parse_str($_SERVER['QUERY_STRING'] ?? '', $query);

        $requestParameters = [];
        if (0 === strpos($headers['content-type'] ?? '', 'application/x-www-form-urlencoded')
            && \in_array(strtoupper($httpMethod), ['POST', 'PUT', 'DELETE', 'PATCH'], true)
        ) {
            parse_str($bodyContent, $requestParameters);
        }

        $uriComponents = parse_url($_SERVER['REQUEST_URI']);

        $request = new self(
            $uriComponents['path'],
            $httpMethod,
            $headers,
            $query,
            $requestParameters,
            $bodyContent
    );

        return $request;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function isPost(): bool
    {
        return 'POST' === strtoupper($this->method);
    }

    public function getQuery(): QueryParameters
    {
        return new QueryParameters($this->query);
    }

    public function getRequest(): RequestParameters
    {
        return new RequestParameters($this->request);
    }

    public function getBody(): ?string
    {
        return $this->body;
    }
}
