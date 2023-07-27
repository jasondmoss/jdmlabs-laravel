<?php

declare(strict_types=1);

namespace App\Client\Interface\Http;

use App\Client\Infrastructure\Client;
use App\Core\Shared\ValueObjects\Id;
use App\Core\Shared\ValueObjects\Itemprop;
use App\Core\Shared\ValueObjects\Name;
use App\Core\Shared\ValueObjects\Promoted;
use App\Core\Shared\ValueObjects\Status;
use App\Core\Shared\ValueObjects\Summary;
use App\Core\Shared\ValueObjects\Website;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

final class CreateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Client::class);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Id
     */
    public function getUserId(Request $request): Id
    {
        return (new Id($request->input('user_id')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Name
     */
    public function getName(Request $request): Name
    {
        return (new Name($request->input('name')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Itemprop
     */
    public function getItemprop(Request $request): Itemprop
    {
        return (new Itemprop($request->input('itemprop')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Website
     */
    public function getWebsite(Request $request): Website
    {
        return (new Website($request->input('website')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Summary
     */
    public function getSummary(Request $request): Summary
    {
        return (new Summary($request->input('summary')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Status
     */
    public function getStatus(Request $request): Status
    {
        return (new Status($request->input('status')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Promoted
     */
    public function getPromoted(Request $request): Promoted
    {
        return (new Promoted($request->input('promoted')));
    }

}
