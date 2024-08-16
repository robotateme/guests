<?php

namespace App\Http\ApiResponses\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class ApiResponse extends JsonResponse implements ApiResponseInterface
{

    protected ?array $dataArray = [];
    protected ?bool $success = false;
    protected ?string $message = null;

    /**
     * @param  array|string  $data
     * @param  int  $status
     * @param  string|null  $message
     */
    private function __construct(array|string $data = [], int $status = 200, ?string $message = null)
    {
        parent::__construct();
        $this->setStatusCode($status, $message);
        $this->setDataBody($data);
    }

    public static function make(array|string $data = [], int $status = 200, string $message = null): ApiResponse
    {
        return new static($data, $status);
    }

    /**
     * @inheritDoc
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $response = [
            'status' => $this->statusText,
            'success' => $this->success,
            'message' => $this->statusText
        ];

        if (!empty ($this->getDataBody())) {
            if ($this->success){
                $response['data'] = $this->getDataBody();
            } else {
                $response['error'] = $this->getDataBody();
            }
        }

        $this->setData($response);

        return $this;
    }

    /**
     * Устанавливает данные в ответ
     *
     * @param  array|string  $data
     * @return self
     */
    public function setDataBody(array|string $data): self
    {
        if (is_string($data)) $data = [$data];
        $this->dataArray = $data;
        return $this;
    }

    /**
     * Устанавливает статус выполнения задачи
     *
     * @param boolean $success
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->success = $success;

        return $this;
    }
    /**
     * Возвращает данные из ответа
     *
     * @return array|null
     */
    public function getDataBody(): ?array
    {
        return $this->dataArray;
    }

    /**
     * Возвращает сообщение из ответа
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Возвращает статус успешности выполнения задачи
     *
     * @return boolean|null
     */
    public function getSuccess(): ?bool
    {
        return $this->success;
    }
}
