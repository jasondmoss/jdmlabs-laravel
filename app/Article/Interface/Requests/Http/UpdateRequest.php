<?php

declare(strict_types=1);

namespace App\Article\Interface\Requests\Http;

use App\Article\Infrastructure\Article;
use App\Shared\ValueObjects\Body;
use App\Shared\ValueObjects\Id;
use App\Shared\ValueObjects\Promoted;
use App\Shared\ValueObjects\Status;
use App\Shared\ValueObjects\Summary;
use App\Shared\ValueObjects\Title;
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
        $article = Article::where('id', '=', $this->route('id'))->get()->first();

        return $this->user()->can('update', $article);
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
     * @return \App\Shared\ValueObjects\Title
     */
    public function getTitle(Request $request): Title
    {
        return (new Title($request->input('title')));
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
     * @return \App\Shared\ValueObjects\Body
     */
    public function getBody(Request $request): Body
    {
        return (new Body($request->input('body')));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Shared\ValueObjects\Id
     */
    public function getCategory(Request $request): Id
    {
        return (new Id($request->input('category')));
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
