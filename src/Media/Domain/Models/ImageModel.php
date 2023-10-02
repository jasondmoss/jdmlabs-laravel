<?php

declare(strict_types=1);

namespace Aenginus\Media\Domain\Models;

use Aenginus\Media\Infrastructure\EloquentModels\ImageEloquentModel;
use Aenginus\Shared\Scopes\FindBySlugScope;
use Aenginus\Shared\Scopes\WherePromotedScope;
use Aenginus\Shared\Scopes\WherePublishedScope;
use Aenginus\Shared\Scopes\WhereRelatedScope;
use Aenginus\Shared\Traits\MediaExtended;
use Aenginus\Shared\Traits\ModelExtended;
use Aenginus\Shared\Traits\Observable;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class ImageModel extends ImageEloquentModel
{
    use HasEvents;
    use HasUlids;
    use Observable;

    /** -- Global Helpers */
    use MediaExtended;
    use ModelExtended;

    /** -- Global Scopes */
    use FindBySlugScope;
    use WherePromotedScope;
    use WherePublishedScope;
    use WhereRelatedScope;
}
