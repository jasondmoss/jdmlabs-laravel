<?php

declare(strict_types=1);

namespace Aenginus\Media\Application\UseCases;

use Aenginus\Media\Application\Repositories\Eloquent\ShowcaseImagesRepository;
use Illuminate\Database\Eloquent\Model;

final readonly class AttachShowcaseImagesUseCase
{

    private ShowcaseImagesRepository $repository;


    /**
     * @param \Aenginus\Media\Application\Repositories\Eloquent\ShowcaseImagesRepository $repository
     */
    public function __construct (ShowcaseImagesRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $showcaseImages
     * @param string $mediaCollection
     */
    public function attach (
        Model $model,
        array $showcaseImages,
        string $mediaCollection = ''
    ): void
    {
        $this->repository->attach($model, $showcaseImages, $mediaCollection);
    }

}
