<?php

declare(strict_types=1);

namespace App\Shared\Interface;

use App\Shared\Domain\ValueObjects\Body;
use App\Shared\Domain\ValueObjects\Id;
use App\Shared\Domain\ValueObjects\Pinned;
use App\Shared\Domain\ValueObjects\Promoted;
use App\Shared\Domain\ValueObjects\Status;
use App\Shared\Domain\ValueObjects\Summary;
use App\Shared\Domain\ValueObjects\Title;
use Illuminate\Foundation\Http\FormRequest;

class EntryFormRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        dd($this->user());

        return true;
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Id
     */
    public function getId(): Id
    {
        return (new Id($this->id));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Title
     */
    public function getTitle(): Title
    {
        return (new Title($this->title));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Summary
     */
    public function getSummary(): Summary
    {
        return (new Summary($this->summary));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Body
     */
    public function getBody(): Body
    {
        return (new Body($this->body));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Pinned
     */
    public function getPinned(): Pinned
    {
        return (new Pinned($this->pinned));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Promoted
     */
    public function getPromoted(): Promoted
    {
        return (new Promoted($this->promoted));
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Status
     */
    public function getStatus(): Status
    {
        return (new Status($this->status));
    }


    /*'categories' => ['exists:categories,id'],*/
    /*'image[file]' => ['nullable', 'image', 'mimes:jpg,png,svg'],
    'image[label]' => ['nullable', 'string'],
    'image[alt]' => ['nullable', 'string'],
    'image[caption]' => ['nullable', 'string']*/

}
