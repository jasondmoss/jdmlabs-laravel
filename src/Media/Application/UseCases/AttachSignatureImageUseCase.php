<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Repositories\Eloquent\SignatureImageRepository;
use Aenginus\Media\Infrastructure\Entities\ImageEntity;
use Illuminate\Database\Eloquent\Model;

final readonly class AttachSignatureImageUseCase
{

    private SignatureImageRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Repositories\Eloquent\SignatureImageRepository $repository
     */
    public function __construct(SignatureImageRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Aenginus\Media\Infrastructure\Entities\ImageEntity $entity
     * @param string $mediaCollection
     */
    public function attach(Model $model, ImageEntity $entity, string $mediaCollection = 'signatures'): void
    {
        $this->repository->attach($model, $entity, $mediaCollection);
    }

}
