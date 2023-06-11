<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers\API;

use App\Taxonomy\Application\Controllers\TaxonomyController;
use App\Taxonomy\Infrastructure\Term;
use App\Taxonomy\Infrastructure\Vocabulary;
use App\Taxonomy\Interface\TermFormRequest;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiController extends TaxonomyController {

    /**
     * @return mixed
     */
    public function terms(): mixed
    {
        $data = [];

        foreach (Term::all() as $item) {
            $data[] = $item->apiArray();
        }

        return $this->response($data);
    }


    /**
     * @param \App\Taxonomy\Interface\TermFormRequest $request
     *
     * @return mixed
     */
    public function termsCreate(TermFormRequest $request): mixed
    {
        $item = new Term($request->input());

        if ($item->save()) {
            return $this->response($item->apiArray());
        }

        return $this->error('Failed to save new term');
    }


    /**
     * @param \App\Taxonomy\Interface\TermFormRequest $request
     *
     * @return mixed
     */
    public function termsUpdate(TermFormRequest $request): mixed
    {
        if ($request->has('id')) {
            $item = Term::find($request->get('id'));

            if ($item) {
                $item->fill($request->input());

                if ($item->save()) {
                    return $this->response($item->apiArray());
                }

                return $this->error('Failed to save new term');
            }
        }

        return $this->error('Invalid id to update');
    }


    /**
     * @param \App\Taxonomy\Infrastructure\Term $term
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function termUsers(Term $term, Request $request): mixed
    {
        try {
            $term = Term::findOrFail($request->get('id'));

            // Users
            $users = preg_split("/([\r\n|\n|\r|\,|\s]+)/", $request->input('users'));
            $users = array_map('trim', $users);

            //var_dump($term->toArray());
            //return $this->error('bad');

            $term->setUsers($users);

            // Groups
            $groups = preg_split("/(\r\n|\n|\r)/", $request->input('groups'));
            $groups = array_map('trim', $groups);

            $term->setGroups($groups);

            return $this->response($term->apiArray());
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    /**
     * Centralized handling of requests for modal forms.
     */
    public function forms(): View|JsonResponse
    {
        try {
            if ('term' == Request::get('model', '')) {
                return Term::form(Request::all());
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->error($e->getMessage());
        }

        return $this->error('Model name missing or not recognized.');
    }


    /**
     * Centralized handling of requests for ajax delete requests
     *
     * @return mixed
     */
    public function deletions(): mixed
    {
        try {
            if ('term' == Request::get('model', '')) {
                return $this->termsDelete(Request::get('id'));
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->error($e->getMessage());
        }

        return $this->error('Model name missing or not recognized.');
    }


    /**
     * @return mixed
     * @throws \Throwable
     */
    public function termsSort(): mixed
    {
        if (Request::has('parent_id') && Request::has('term_ids')) {
            $weight = 1;

            try {
                $parent_id = Request::get('parent_id');

                if ($parent_id === 0) {
                    $parent_id = '';
                }

                foreach (Request::get('term_ids') as $term_id) {
                    $term = Term::findOrFail($term_id);

                    $term->weight = $weight;
                    $term->parent_id = $parent_id;

                    $term->saveOrFail();

                    $weight++;
                }

                return $this->response('saved');
            } catch (Exception $e) {
                return $this->error($e->getMessage());
            }
        }

        return $this->error('Nothing to sort.');
    }


    /**
     * @param $id
     *
     * @return mixed
     */
    public function termsDelete($id): mixed
    {
        if (Term::destroy($id)) {
            return $this->response('Deleted');
        }

        return $this->error('Failed to delete');
    }


    /**
     * @param $id
     *
     * @return mixed
     */
    public function termsItem($id): mixed
    {
        if ($item = Term::find($id)) {
            return $this->response($item->apiArrayWithRelations());
        }

        return $this->error('Invalid Id');
    }


    /**
     * @return mixed
     */
    public function vocabularies(): mixed
    {
        $data = [];

        foreach (Vocabulary::all() as $item) {
            $data[] = $item->apiArray();
        }

        return $this->response($data);
    }


    /**
     * @param $id
     *
     * @return mixed
     */
    public function vocabulariesItem($id): mixed
    {
        if ($item = Vocabulary::find($id)) {
            return $this->response($item->apiArrayWithRelations());
        }

        return $this->error('Invalid Id');
    }


    /**
     * Returns a json success response.
     *
     * @param $data
     *
     * @return mixed
     */
    public function response($data): mixed
    {
        $struct['status'] = 'ok';
        $struct['data'] = $data;

        $options = 0;

        if (Request::get('pretty')) {
            $options = JSON_PRETTY_PRINT;
        }

        $response = response()->json($struct, 200, [], $options);

        if (Request::has('jsonp')) {
            $response->setCallback(Request::get('jsonp'));
        }

        return $response;
    }


    /**
     * @return mixed
     */
    public function clearCache(): mixed
    {
        Cache::flush();

        return $this->response([]);
    }


    /**
     * Returns a json error response.
     *
     * @param string $msg
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(string $msg, int $code = 404): JsonResponse
    {
        $struct['status'] = 'fail';
        $struct['message'] = $msg;

        $options = 0;

        if (Request::get('pretty')) {
            $options = JSON_PRETTY_PRINT;
        }

        $response = response()->json($struct, $code, [], $options);

        if (Request::has('jsonp')) {
            $response->setCallback(Request::get('jsonp'));
        }

        return $response;
    }

}
