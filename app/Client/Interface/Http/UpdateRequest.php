<?php

declare(strict_types=1);

namespace App\Client\Interface\Http;

use App\Client\Infrastructure\Client;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Itemprop;
use App\Shared\ValueObjects\Name;
use App\Shared\ValueObjects\Promoted;
use App\Shared\ValueObjects\Status;
use App\Shared\ValueObjects\Summary;
use App\Shared\ValueObjects\Website;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
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
     * @return \App\Shared\ValueObjects\Id
     */
    public function getId(Request $request): Id
    {
        return (new Id($request->input('id')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Id
     */
    public function getUserId(Request $request): Id
    {
        return (new Id($request->input('user_id')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Name
     */
    public function getName(Request $request): Name
    {
        return (new Name($request->input('name')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Itemprop
     */
    public function getItemprop(Request $request): Itemprop
    {
        return (new Itemprop($request->input('itemprop')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Website
     */
    public function getWebsite(Request $request): Website
    {
        return (new Website($request->input('website')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Summary
     */
    public function getSummary(Request $request): Summary
    {
        return (new Summary($request->input('summary')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Status
     */
    public function getStatus(Request $request): Status
    {
        return (new Status($request->input('status')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Promoted
     */
    public function getPromoted(Request $request): Promoted
    {
        return (new Promoted($request->input('promoted')));
    }

}
