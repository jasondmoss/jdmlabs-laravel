<?php

declare(strict_types=1);

namespace App\Project\Interface\Http;

use App\Core\Shared\ValueObjects\Body;
use App\Core\Shared\ValueObjects\Id;
use App\Core\Shared\ValueObjects\Pinned;
use App\Core\Shared\ValueObjects\Promoted;
use App\Core\Shared\ValueObjects\Status;
use App\Core\Shared\ValueObjects\SubTitle;
use App\Core\Shared\ValueObjects\Summary;
use App\Core\Shared\ValueObjects\Title;
use App\Core\Shared\ValueObjects\Website;
use App\Project\Infrastructure\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

final class UpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $project = Project::where('id', '=', $this->route('id'))->get()->first();

        return $this->user()->can('update', $project);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Id
     */
    public function getId(Request $request): Id
    {
        return (new Id($request->input('id')));
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
     * @return \App\Core\Shared\ValueObjects\Title
     */
    public function getTitle(Request $request): Title
    {
        return (new Title($request->input('title')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\SubTitle
     */
    public function getSubTitle(Request $request): SubTitle
    {
        return (new SubTitle($request->input('subtitle')));
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
     * @return \App\Core\Shared\ValueObjects\Body
     */
    public function getBody(Request $request): Body
    {
        return (new Body($request->input('body')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Id
     */
    public function getClientId(Request $request): Id
    {
        return (new Id($request->input('client_id')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Id
     */
//    public function getCategory(Request $request): Id
//    {
//        return (new Id($request->input('category')));
//    }


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


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Core\Shared\ValueObjects\Pinned
     */
    public function getPinned(Request $request): Pinned
    {
        return (new Pinned($request->input('pinned')));
    }

}
